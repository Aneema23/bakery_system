<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

use App\Models\Category;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index(): View
    {
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $customerCount = User::where('role', 'customer')->count();
        $deliveryPersonCount = User::where('role', 'delivery_person')->count();
        $newUsersThisMonth = User::where('created_at', '>=', now()->startOfMonth())->count();

        $customers = User::where('role', 'customer')->get();

        $categories = Category::all();

        $totalOrders = 0;
        $pendingOrders = 0;
        $completedOrders = 0;
        $totalRevenue = 0;
        $revenueGrowth = 12;

        $deliveryStaff = $deliveryPersonCount;
        $activeDeliveries = 0;

        $recentOrders = [];

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'customerCount' => $customerCount,
            'deliveryPersonCount' => $deliveryPersonCount,
            'newUsersThisMonth' => $newUsersThisMonth,

            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'totalRevenue' => $totalRevenue,
            'revenueGrowth' => $revenueGrowth,

            'deliveryStaff' => $deliveryStaff,
            'activeDeliveries' => $activeDeliveries,

            'recentOrders' => $recentOrders,

            'customers' => $customers,

            'customers' => $customers,
            'categories' => $categories,

            'products' => Product::all(),
        ]);
    }
}
