<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('frontend.cart.index', compact('cart', 'subtotal'));
    }

    public function data()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'cart_count' => count($cart),
            'subtotal' => $subtotal,
            'formatted_subtotal' => '₱' . number_format($subtotal, 2),
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
            $cart[$key]['quantity'] += $request->quantity;
        } else {
            $cart[$key] = [
                'variant_id' => $variant->id,
                'product_id' => $variant->product_id,
                'name' => $variant->product->name,
                'slug' => $variant->product->slug,
                'weight' => $variant->weight,
                'price' => (float)$variant->price,
                'quantity' => (int)$request->quantity,
                'image' => $variant->product->primary_image ?: '/uploads/products/samidori.jpg',
            ];
        }

        session()->put('cart', $cart);

        $totalCount = count($cart);
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Added {$variant->product->name} ({$variant->weight}) to bag!",
                'cart' => array_values($cart),
                'cart_count' => $totalCount,
                'subtotal' => $subtotal,
                'formatted_subtotal' => '₱' . number_format($subtotal, 2),
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

        $totalCount = count($cart);
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'cart' => array_values($cart),
                'cart_count' => $totalCount,
                'subtotal' => $subtotal,
                'formatted_subtotal' => '₱' . number_format($subtotal, 2),
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

        $totalCount = count($cart);
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'cart' => array_values($cart),
                'cart_count' => $totalCount,
                'subtotal' => $subtotal,
                'formatted_subtotal' => '₱' . number_format($subtotal, 2),
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
