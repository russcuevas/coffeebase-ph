<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
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
                'cart_count' => 0,
                'subtotal' => 0,
                'total_savings' => 0,
                'original_subtotal' => 0,
                'formatted_subtotal' => '₱0.00',
                'formatted_savings' => '₱0.00',
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

            $processedItem = [
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
                'bulk_tiers' => $variant && $variant->product ? $variant->product->sorted_bulk_discounts : [],
            ];

            $processed[$key] = $processedItem;
            $subtotal += $lineTotal;
            $originalSubtotal += $origLineTotal;
            $totalSavings += $lineSavings;
        }

        return [
            'items' => $processed,
            'cart_count' => count($processed),
            'subtotal' => $subtotal,
            'total_savings' => $totalSavings,
            'original_subtotal' => $originalSubtotal,
            'formatted_subtotal' => '₱' . number_format($subtotal, 2),
            'formatted_savings' => '₱' . number_format($totalSavings, 2),
        ];
    }

    public function index()
    {
        $rawCart = session()->get('cart', []);
        $cartData = $this->processCart($rawCart);
        $cart = $cartData['items'];
        $subtotal = $cartData['subtotal'];
        $totalSavings = $cartData['total_savings'];
        $originalSubtotal = $cartData['original_subtotal'];

        return view('frontend.cart.index', compact('cart', 'subtotal', 'totalSavings', 'originalSubtotal'));
    }

    public function data()
    {
        $rawCart = session()->get('cart', []);
        $cartData = $this->processCart($rawCart);

        return response()->json([
            'success' => true,
            'cart' => array_values($cartData['items']),
            'cart_count' => $cartData['cart_count'],
            'subtotal' => $cartData['subtotal'],
            'total_savings' => $cartData['total_savings'],
            'formatted_subtotal' => $cartData['formatted_subtotal'],
            'formatted_savings' => $cartData['formatted_savings'],
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::with('product')->findOrFail($request->variant_id);

        if ($variant->is_sold_out || $variant->stock_quantity <= 0) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Sorry, this option is currently sold out.'], 422);
            }
            return back()->with('error', 'Sorry, this option is currently sold out.');
        }

        $cart = session()->get('cart', []);
        $key = $variant->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += (int)$request->quantity;
        } else {
            $cart[$key] = [
                'variant_id' => $variant->id,
                'product_id' => $variant->product_id,
                'name' => $variant->product->name,
                'slug' => $variant->product->slug,
                'weight' => $variant->weight,
                'original_price' => (float)$variant->price,
                'price' => (float)$variant->price,
                'quantity' => (int)$request->quantity,
                'image' => $variant->product->primary_image ?: '/uploads/products/samidori.jpg',
            ];
        }

        session()->put('cart', $cart);

        $cartData = $this->processCart($cart);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Added {$variant->product->name} ({$variant->weight}) to bag!",
                'cart' => array_values($cartData['items']),
                'cart_count' => $cartData['cart_count'],
                'subtotal' => $cartData['subtotal'],
                'total_savings' => $cartData['total_savings'],
                'formatted_subtotal' => $cartData['formatted_subtotal'],
                'formatted_savings' => $cartData['formatted_savings'],
            ]);
        }

        return back()->with('success', "Added {$variant->product->name} ({$variant->weight}) to cart!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'variant_id' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);
        $key = $request->variant_id;

        if (isset($cart[$key])) {
            if ((int)$request->quantity <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['quantity'] = (int)$request->quantity;
            }
            session()->put('cart', $cart);
        }

        $cartData = $this->processCart($cart);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'cart' => array_values($cartData['items']),
                'cart_count' => $cartData['cart_count'],
                'subtotal' => $cartData['subtotal'],
                'total_savings' => $cartData['total_savings'],
                'formatted_subtotal' => $cartData['formatted_subtotal'],
                'formatted_savings' => $cartData['formatted_savings'],
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'variant_id' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $key = $request->variant_id;

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        $cartData = $this->processCart($cart);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'cart' => array_values($cartData['items']),
                'cart_count' => $cartData['cart_count'],
                'subtotal' => $cartData['subtotal'],
                'total_savings' => $cartData['total_savings'],
                'formatted_subtotal' => $cartData['formatted_subtotal'],
                'formatted_savings' => $cartData['formatted_savings'],
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}

