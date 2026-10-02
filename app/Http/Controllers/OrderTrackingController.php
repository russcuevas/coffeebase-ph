<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('frontend.orders.track');
    }

    public function search(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
        ]);

        $orderNumber = trim($request->order_number);
        $order = Order::with(['items.product', 'items.variant'])
            ->where('order_number', $orderNumber)
            ->first();

        if (!$order) {
            return back()->with('error', "No order found with reference number \"{$orderNumber}\". Please double check your order number.")->withInput();
        }

        return redirect()->route('orders.show', $order->order_number);
    }

    public function show($order_number)
    {
        $order = Order::with(['items.product', 'items.variant'])
            ->where('order_number', $order_number)
            ->firstOrFail();

        return view('frontend.orders.show', compact('order'));
    }

    public function myOrders()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to view your orders.');
        }

        $orders = Order::with(['items'])
            ->where(function ($q) {
                $q->where('user_id', auth()->id())
                  ->orWhere('customer_email', auth()->user()->email);
            })
            ->latest()
            ->get();

        return view('frontend.orders.my_orders', compact('orders'));
    }
}
