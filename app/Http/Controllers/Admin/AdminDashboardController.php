<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

use App\Models\Category;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index(Request $request): View
    {
        $activeSection = $request->query('section', session('activeSection', 'dashboard'));

        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $customerCount = User::where('role', 'customer')->count();
        $deliveryPersonCount = User::where('role', 'delivery_person')->count();
        $newUsersThisMonth = User::where('created_at', '>=', now()->startOfMonth())->count();

        $customers = User::where('role', 'customer')->get();
        $categories = Category::all();

        $ordersQuery = Order::query()->orderByDesc('created_at');

        $selectedStatus = strtolower((string) $request->query('status', 'all'));
        $selectedCustomType = $request->query('custom_type', 'all');

        if ($selectedStatus !== 'all') {
            $ordersQuery->whereRaw('LOWER(status) = ?', [$selectedStatus]);
        }

        if ($selectedCustomType === 'custom_cake') {
            $ordersQuery->whereRaw('LOWER(product_name) = ?', ['custom cake']);
        } elseif ($selectedCustomType === 'standard') {
            $ordersQuery->whereRaw('LOWER(product_name) != ?', ['custom cake']);
        }

        $orders = $ordersQuery->get();

        $totalOrders = $orders->count();
        $pendingOrders = $orders->filter(fn ($order) => strtolower((string) $order->status) === 'pending')->count();
        $completedOrders = $orders->filter(fn ($order) => in_array(strtolower((string) $order->status), ['completed', 'delivered'], true))->count();
        $totalRevenue = $orders->sum('total_price');
        $revenueGrowth = 12;

        $deliveryStaff = $deliveryPersonCount;
        $activeDeliveries = 0;
        $recentOrders = $orders->take(5);

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
            'orders' => $orders,
            'selectedStatus' => $selectedStatus,
            'selectedCustomType' => $selectedCustomType,
            'activeSection' => $activeSection,

            'customers' => $customers,
            'categories' => $categories,
            'products' => Product::all(),
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'string', Rule::in(['pending', 'processing', 'completed', 'delivered', 'cancel'])],
        ]);

        $order->update([
            'status' => strtolower($request->status),
        ]);

        return redirect()->route('admin.dashboard', ['section' => 'orders'])
            ->with('activeSection', 'orders')
            ->with('success', 'Order status updated successfully.');
    }
}
