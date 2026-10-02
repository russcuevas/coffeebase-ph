<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\ContactMessage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::where('payment_status', 'paid')->sum('total_amount');
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $preparingOrdersCount = Order::where('status', 'preparing')->count();
        $outForDeliveryCount = Order::where('status', 'out_for_delivery')->count();
        $completedOrdersCount = Order::where('status', 'delivered')->count();

        $totalProductsCount = Product::count();
        $totalCategoriesCount = Category::count();
        $totalCustomersCount = User::where('role', 'customer')->count();
        $unreadMessagesCount = ContactMessage::where('status', 'unread')->count();

        $recentOrders = Order::with('items')->latest()->take(7)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalSales',
            'pendingOrdersCount',
            'preparingOrdersCount',
            'outForDeliveryCount',
            'completedOrdersCount',
            'totalProductsCount',
            'totalCategoriesCount',
            'totalCustomersCount',
            'unreadMessagesCount',
            'recentOrders',
            'recentMessages'
        ));
    }
}
