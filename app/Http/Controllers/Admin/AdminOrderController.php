<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['items', 'user'])->latest()->get();

        $statusCounts = [
            'all' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'out_for_delivery' => Order::where('status', 'out_for_delivery')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'items.variant', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,preparing,out_for_delivery,delivered,cancelled',
            'tracking_courier' => 'nullable|string|max:100',
            'tracking_link' => 'nullable|url|max:2000',
            'admin_notes' => 'nullable|string|max:1000',
            'payment_status' => 'nullable|in:pending,paid,refunded',
        ]);

        $order->status = $validated['status'];
        $order->tracking_courier = $validated['tracking_courier'] ?? $order->tracking_courier;
        $order->tracking_link = $validated['tracking_link'] ?? $order->tracking_link;
        $order->admin_notes = $validated['admin_notes'] ?? $order->admin_notes;

        if (!empty($validated['payment_status'])) {
            $order->payment_status = $validated['payment_status'];
        }

        // Set timestamps
        if ($validated['status'] === 'preparing' && !$order->preparing_at) {
            $order->preparing_at = now();
        } elseif ($validated['status'] === 'out_for_delivery' && !$order->out_for_delivery_at) {
            $order->out_for_delivery_at = now();
        } elseif ($validated['status'] === 'delivered' && !$order->delivered_at) {
            $order->delivered_at = now();
        } elseif ($validated['status'] === 'cancelled' && !$order->cancelled_at) {
            $order->cancelled_at = now();
        }

        $order->save();

        return back()->with('success', "Order #{$order->order_number} status updated to " . ucfirst(str_replace('_', ' ', $order->status)) . " successfully!");
    }
}
