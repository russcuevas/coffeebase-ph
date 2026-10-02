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
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty. Please select matcha items to proceed to checkout.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = 0.00;
        $total = $subtotal;

        $user = auth()->user();

        return view('frontend.checkout.index', compact('cart', 'subtotal', 'shippingFee', 'total', 'user'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

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
            'payment_method' => 'required|string',
            'customer_notes' => 'nullable|string|max:1000',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

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
                'status' => 'pending', // Default always pending
                'customer_notes' => $validated['customer_notes'] ?? null,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_variant_id' => $item['variant_id'] ?? null,
                    'product_name' => $item['name'],
                    'variant_weight' => $item['weight'] ?? null,
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
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
