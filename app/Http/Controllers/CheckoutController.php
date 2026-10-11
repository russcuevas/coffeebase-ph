<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;

class CheckoutController extends Controller
{
    private function processCart($cart)
    {
        $processed = [];
        $subtotal = 0;
        $totalSavings = 0;
        $originalSubtotal = 0;

        if (empty($cart)) {
            return [
                'items' => [],
                'subtotal' => 0,
                'total_savings' => 0,
                'original_subtotal' => 0,
            ];
        }

        $variantIds = array_keys($cart);
        $variants = ProductVariant::with('product')->whereIn('id', $variantIds)->get()->keyBy('id');

        foreach ($cart as $key => $item) {
            $variant = $variants->get($key);
            $qty = (int)($item['quantity'] ?? 1);
            $origPrice = (float)($variant ? $variant->price : ($item['original_price'] ?? $item['price']));

            $discountPercent = 0;
            $discountLabel = null;

            if ($variant && $variant->product) {
                $tier = $variant->product->getBulkDiscountForQty($qty);
                if ($tier) {
                    $discountPercent = (float)$tier['discount_percent'];
                    $discountLabel = !empty($tier['label']) ? $tier['label'] : "{$discountPercent}% Bulk Tier ({$tier['min_qty']}+ units)";
                }
            }

            $discountedPrice = $discountPercent > 0 ? round($origPrice * (1 - ($discountPercent / 100)), 2) : $origPrice;
            $lineTotal = $discountedPrice * $qty;
            $origLineTotal = $origPrice * $qty;
            $lineSavings = $origLineTotal - $lineTotal;

            $processed[$key] = [
                'variant_id' => $item['variant_id'] ?? $key,
                'product_id' => $variant ? $variant->product_id : ($item['product_id'] ?? null),
                'name' => $variant && $variant->product ? $variant->product->name : ($item['name'] ?? ''),
                'slug' => $variant && $variant->product ? $variant->product->slug : ($item['slug'] ?? ''),
                'weight' => $variant ? $variant->weight : ($item['weight'] ?? ''),
                'original_price' => $origPrice,
                'price' => $discountedPrice,
                'discount_percent' => $discountPercent,
                'discount_label' => $discountLabel,
                'quantity' => $qty,
                'line_total' => $lineTotal,
                'line_savings' => $lineSavings,
                'image' => $variant && $variant->product && $variant->product->primary_image ? $variant->product->primary_image : ($item['image'] ?? '/uploads/products/samidori.jpg'),
            ];

            $subtotal += $lineTotal;
            $originalSubtotal += $origLineTotal;
            $totalSavings += $lineSavings;
        }

        return [
            'items' => $processed,
            'subtotal' => $subtotal,
            'total_savings' => $totalSavings,
            'original_subtotal' => $originalSubtotal,
        ];
    }

    public function index()
    {
        if (!auth()->check()) {
            return redirect()->guest(route('login'))->with('error', 'Please login first before ordering.');
        }

        $rawCart = session()->get('cart', []);
        
        if (empty($rawCart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty. Please select matcha items to proceed to checkout.');
        }

        $cartData = $this->processCart($rawCart);
        $cart = $cartData['items'];
        $subtotal = $cartData['subtotal'];
        $totalSavings = $cartData['total_savings'];
        $originalSubtotal = $cartData['original_subtotal'];

        $shippingFee = 0.00;
        $total = $subtotal;

        $user = auth()->user();

        return view('frontend.checkout.index', compact('cart', 'subtotal', 'shippingFee', 'total', 'totalSavings', 'originalSubtotal', 'user'));
    }

    public function process(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->guest(route('login'))->with('error', 'Please login first before ordering.');
        }

        $rawCart = session()->get('cart', []);
        
        if (empty($rawCart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $cartData = $this->processCart($rawCart);
        $cart = $cartData['items'];

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:50',
            'company' => 'nullable|string|max:150',
            'country' => 'required|string|max:50', // automatic Philippines
            'address' => 'required|string|max:300',
            'apartment' => 'nullable|string|max:100',
            'barangay' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'region' => 'required|string|max:100',
            'payment_method' => 'required|string|in:Cash on Delivery,E-Payment',
            'payment_reference' => 'nullable|required_if:payment_method,E-Payment|string|max:100',
            'customer_notes' => 'nullable|string|max:1000',
        ], [
            'payment_reference.required_if' => 'Please enter the transaction reference number from your payment receipt.',
        ]);

        $subtotal = $cartData['subtotal'];
        $shippingFee = 0.00;
        $totalAmount = $subtotal;

        // Generate unique order number: CB-YYYYMMDD-XXXX
        $orderNumber = 'CB-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        DB::beginTransaction();
        try {
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => auth()->id() ?? null,
                'customer_first_name' => $validated['first_name'],
                'customer_last_name' => $validated['last_name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'company' => $validated['company'] ?? null,
                'country' => $validated['country'] ?? 'Philippines',
                'address' => $validated['address'],
                'apartment' => $validated['apartment'] ?? null,
                'barangay' => $validated['barangay'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'region' => $validated['region'],
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'total_amount' => $totalAmount,
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'payment_reference' => $validated['payment_reference'] ?? null,
                'status' => 'pending', // Default always pending
                'customer_notes' => $validated['customer_notes'] ?? null,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_variant_id' => $item['variant_id'] ?? null,
                    'product_name' => $item['name'] . ($item['discount_percent'] > 0 ? " ({$item['discount_percent']}% Bulk Discount)" : ''),
                    'variant_weight' => $item['weight'] ?? null,
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['line_total'],
                ]);
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            return redirect()->route('orders.show', $order->order_number)
                ->with('success', 'Order placed successfully! Please wait for the confirmation of the admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'There was an error processing your order: ' . $e->getMessage())->withInput();
        }
    }
}

