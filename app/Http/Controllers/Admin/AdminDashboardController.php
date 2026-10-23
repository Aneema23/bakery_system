<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

use App\Models\Category;
use App\Models\Product;
use App\Rules\SriLankaMobileNumber;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index(Request $request): View
    {
        $activeSection = $request->query('section', session('activeSection', 'dashboard'));
        session(['activeSection' => $activeSection]);

        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $customerCount = User::where('role', 'customer')->count();
        $deliveryPersonCount = User::where('role', 'delivery_person')->count();
        $newUsersThisMonth = User::where('created_at', '>=', now()->startOfMonth())->count();

        $customers = User::where('role', 'customer')->get();
        $deliveryPersons = User::where('role', 'delivery_person')->get();
        $categories = Category::all();
        $activeProducts = Product::where('status', 'Active')->get();
        $inventoryProducts = Product::with('category')->orderBy('stock')->orderBy('name')->get();
        $lowStockThreshold = 5;
        $lowStockProducts = $inventoryProducts->filter(
            fn ($product) => $product->stock > 0 && $product->stock <= $lowStockThreshold
        )->count();
        $outOfStockProducts = $inventoryProducts->filter(
            fn ($product) => $product->stock <= 0
        )->count();
        $totalStockUnits = $inventoryProducts->sum('stock');

        $ordersQuery = Order::query()->orderByDesc('created_at');

        $selectedStatus = strtolower((string) $request->query('status', 'all'));
        $selectedCustomType = $request->query('custom_type', 'all');
        $selectedDeliveryDate = $request->validate([
            'delivery_date' => ['nullable', 'date_format:Y-m-d'],
        ])['delivery_date'] ?? '';
        $selectedProductCategory = $request->query('product_category', 'all');
        $selectedProductStatus = $request->query('product_status', 'all');

        if ($selectedCustomType === 'custom_cake') {
            $ordersQuery->whereRaw('LOWER(product_name) = ?', ['custom cake']);
        } elseif ($selectedCustomType === 'standard') {
            $ordersQuery->whereRaw('LOWER(product_name) != ?', ['custom cake']);
        }

        if ($selectedDeliveryDate !== '') {
            $ordersQuery->whereDate('delivery_date', $selectedDeliveryDate);
        }

        $productsQuery = Product::query()->with('category');

        if ($selectedProductCategory !== 'all' && $selectedProductCategory !== null && $selectedProductCategory !== '') {
            $productsQuery->where('category_id', (int) $selectedProductCategory);
        }

        if ($selectedProductStatus !== 'all' && $selectedProductStatus !== null && $selectedProductStatus !== '') {
            $productsQuery->where('status', $selectedProductStatus);
        }

        $orders = $ordersQuery->get();
        $reportRange = (string) $request->query('report_range', '30');
        if (!in_array($reportRange, ['7', '30', '90', '365', 'all'], true)) {
            $reportRange = '30';
        }
        $reportStatus = strtolower((string) $request->query('report_status', 'all'));
        $allowedReportStatuses = ['all', 'pending', 'processing', 'completed', 'delivered', 'cancel', 'assigned', 'in_transit', 'failed'];
        if (!in_array($reportStatus, $allowedReportStatuses, true)) {
            $reportStatus = 'all';
        }
        $reportCategory = (string) $request->query('report_category', 'all');
        if ($reportCategory !== 'all' && !$categories->contains('id', (int) $reportCategory)) {
            $reportCategory = 'all';
        }

        $allReportOrders = Order::query()->orderByDesc('created_at')->get();
        $reportOrders = $allReportOrders;
        $reportStart = match ($reportRange) {
            '7', '30', '90' => now()->subDays((int) $reportRange - 1)->startOfDay(),
            '365' => now()->startOfYear(),
            default => null,
        };
        if ($reportStart) {
            $reportOrders = $reportOrders->filter(
                fn ($order) => $order->created_at && $order->created_at->greaterThanOrEqualTo($reportStart)
            );
        }
        if ($reportStatus !== 'all') {
            $reportOrders = $reportOrders->filter(
                fn ($order) => strtolower((string) $order->status) === $reportStatus
            );
        }

        $reportProducts = Product::with('category')->get();
        $reportProductByName = $reportProducts->keyBy(
            fn ($product) => strtolower(trim((string) $product->name))
        );
        if ($reportCategory !== 'all') {
            $categoryProductNames = $reportProducts
                ->where('category_id', (int) $reportCategory)
                ->map(fn ($product) => strtolower(trim((string) $product->name)));
            $reportOrders = $reportOrders->filter(
                fn ($order) => $categoryProductNames->contains(strtolower(trim((string) $order->product_name)))
            );
        }

        $reportCancelledOrders = $reportOrders->filter(
            fn ($order) => strtolower((string) $order->status) === 'cancel'
        )->values();
        $reportRefundTotal = $reportCancelledOrders->sum('total_price');
        $reportGrossRevenue = $reportOrders->sum('total_price');
        $reportRevenueOrders = $reportOrders->reject(
            fn ($order) => strtolower((string) $order->status) === 'cancel'
        );
        $reportRevenue = $reportGrossRevenue - $reportRefundTotal;
        $reportOrderCount = $reportOrders->count();
        $reportRevenueOrderCount = $reportRevenueOrders->count();
        $reportAverageOrderValue = $reportRevenueOrderCount > 0 ? $reportRevenue / $reportRevenueOrderCount : 0;
        $reportCustomerCount = $reportOrders
            ->map(fn ($order) => $order->user_id ? 'user:'.$order->user_id : 'name:'.strtolower(trim((string) $order->customer_name)))
            ->filter(fn ($key) => $key !== 'name:')
            ->unique()
            ->count();

        $shortRange = in_array($reportRange, ['7', '30', '90'], true);
        $revenueBuckets = $reportRevenueOrders
            ->filter(fn ($order) => $order->created_at)
            ->groupBy(fn ($order) => $order->created_at->format($shortRange ? 'Y-m-d' : 'Y-m'))
            ->map(fn ($bucket) => $bucket->sum('total_price'));
        $reportRevenueLabels = $revenueBuckets->keys()->map(function ($key) use ($shortRange) {
            return $shortRange
                ? \Carbon\Carbon::createFromFormat('Y-m-d', $key)->format('d M')
                : \Carbon\Carbon::createFromFormat('Y-m', $key)->format('M Y');
        })->values();
        $reportRevenueValues = $revenueBuckets->values();

        $reportStatuses = ['pending', 'processing', 'completed', 'delivered', 'cancel', 'assigned', 'in_transit', 'failed'];
        $reportStatusValues = collect($reportStatuses)->map(
            fn ($status) => $reportOrders->filter(fn ($order) => strtolower((string) $order->status) === $status)->count()
        );

        $reportCategorySales = $reportRevenueOrders
            ->groupBy(function ($order) use ($reportProductByName) {
                $product = $reportProductByName->get(strtolower(trim((string) $order->product_name)));
                return $product?->category?->name ?? 'Uncategorized';
            })
            ->map(fn ($categoryOrders, $categoryName) => [
                'name' => $categoryName,
                'revenue' => $categoryOrders->sum('total_price'),
            ])
            ->sortByDesc('revenue')
            ->values();

        $reportTopProducts = $reportRevenueOrders
            ->filter(fn ($order) => filled($order->product_name))
            ->groupBy(fn ($order) => strtolower(trim((string) $order->product_name)))
            ->map(fn ($productOrders) => [
                'name' => $productOrders->first()->product_name,
                'orders' => $productOrders->count(),
            ])
            ->sortByDesc('orders')
            ->take(5)
            ->values();

        $maxTopProductOrders = max(1, (int) $reportTopProducts->max('orders'));
        $reportDeliveryOrders = $reportOrders->filter(
            fn ($order) => strtolower(trim((string) $order->delivery_option)) === 'delivery'
        );
        $countDeliveryStatus = static function ($orders, string $status): int {
            $matchingStatuses = match ($status) {
                'in_transit' => ['picked', 'in_transit'],
                'delivered' => ['completed', 'delivered'],
                default => [$status],
            };

            return $orders->filter(
                fn ($order) => in_array(strtolower(trim((string) $order->status)), $matchingStatuses, true)
            )->count();
        };
        $reportDeliveryCounts = collect(['pending', 'assigned', 'in_transit', 'delivered', 'failed'])
            ->mapWithKeys(fn ($status) => [$status => $countDeliveryStatus($reportDeliveryOrders, $status)]);
        $reportExportRows = $reportOrders->map(fn ($order) => [
            'order_id' => $order->id,
            'customer' => $order->customer_name,
            'product' => $order->product_name,
            'total' => $order->total_price,
            'refund' => strtolower((string) $order->status) === 'cancel' ? $order->total_price : 0,
            'net_total' => strtolower((string) $order->status) === 'cancel' ? 0 : $order->total_price,
            'status' => $order->status,
            'date' => $order->created_at?->toDateString(),
        ])->values();
        $deliveries = $orders->filter(
            fn ($order) => strtolower(trim((string) $order->delivery_option)) === 'delivery'
                && !in_array(strtolower(trim((string) $order->status)), ['cancel', 'cancelled'], true)
        )->values();

        $deliveryStatusCounts = collect(['pending', 'assigned', 'in_transit', 'delivered', 'failed'])
            ->mapWithKeys(fn ($status) => [$status => $countDeliveryStatus($deliveries, $status)]);
        $assignedDeliveries = $deliveryStatusCounts['assigned'];
        $inTransitDeliveries = $deliveryStatusCounts['in_transit'];
        $deliveredDeliveries = $deliveryStatusCounts['delivered'];
        $failedDeliveries = $deliveryStatusCounts['failed'];
        $activeDeliveries = $assignedDeliveries + $inTransitDeliveries;
        $activeDeliveryPersons = $deliveryPersons->filter(
            fn ($person) => ($person->status ?? 'Active') === 'Active'
        )->count();
        $inactiveDeliveryPersons = $deliveryPersonCount - $activeDeliveryPersons;

        $totalOrders = $orders->count();
        $pendingOrders = $orders->filter(fn ($order) => strtolower((string) $order->status) === 'pending')->count();
        $completedOrders = $orders->filter(fn ($order) => in_array(strtolower((string) $order->status), ['completed', 'delivered'], true))->count();
        $totalRevenue = $orders->sum(fn ($order) =>
            strtolower((string) $order->status) === 'cancel' ? 0 : (float) $order->total_price
        );
        $revenueGrowth = 12;
        $newOrdersToday = $orders->filter(fn ($order) => $order->created_at?->isToday())->count();
        $newCustomersThisWeek = $customers->filter(fn ($customer) => $customer->created_at?->isCurrentWeek())->count();

        $deliveryStaff = $deliveryPersonCount;
        $recentOrders = $orders->take(5);
        $topSellingProducts = $orders
            ->filter(fn ($order) => filled($order->product_name))
            ->groupBy(fn ($order) => strtolower(trim((string) $order->product_name)))
            ->map(fn ($productOrders, $productName) => [
                'name' => $productOrders->first()->product_name,
                'orders' => $productOrders->count(),
                'revenue' => $productOrders->sum('total_price'),
            ])
            ->sortByDesc('orders')
            ->take(5)
            ->values();

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
            'assignedDeliveries' => $assignedDeliveries,
            'inTransitDeliveries' => $inTransitDeliveries,
            'deliveredDeliveries' => $deliveredDeliveries,
            'failedDeliveries' => $failedDeliveries,
            'deliveryStatusCounts' => $deliveryStatusCounts,
            'activeDeliveryPersons' => $activeDeliveryPersons,
            'inactiveDeliveryPersons' => $inactiveDeliveryPersons,
            'newOrdersToday' => $newOrdersToday,
            'newCustomersThisWeek' => $newCustomersThisWeek,

            'recentOrders' => $recentOrders,
            'topSellingProducts' => $topSellingProducts,
            'reportRange' => $reportRange,
            'reportStatus' => $reportStatus,
            'reportCategory' => $reportCategory,
            'reportRevenue' => $reportRevenue,
            'reportGrossRevenue' => $reportGrossRevenue,
            'reportRefundTotal' => $reportRefundTotal,
            'reportOrderCount' => $reportOrderCount,
            'reportRevenueOrderCount' => $reportRevenueOrderCount,
            'reportCustomerCount' => $reportCustomerCount,
            'reportAverageOrderValue' => $reportAverageOrderValue,
            'reportRevenueLabels' => $reportRevenueLabels,
            'reportRevenueValues' => $reportRevenueValues,
            'reportStatuses' => $reportStatuses,
            'reportStatusValues' => $reportStatusValues,
            'reportCategorySales' => $reportCategorySales,
            'reportTopProducts' => $reportTopProducts,
            'maxTopProductOrders' => $maxTopProductOrders,
            'reportDeliveryCounts' => $reportDeliveryCounts,
            'reportOrders' => $reportOrders,
            'reportCancelledOrders' => $reportCancelledOrders,
            'reportExportRows' => $reportExportRows,
            'orders' => $orders,
            'deliveries' => $deliveries,
            'selectedStatus' => $selectedStatus,
            'selectedCustomType' => $selectedCustomType,
            'selectedDeliveryDate' => $selectedDeliveryDate,
            'activeSection' => $activeSection,

            'customers' => $customers,
            'deliveryPersons' => $deliveryPersons,
            'categories' => $categories,
            'products' => $productsQuery->get(),
            'activeProducts' => $activeProducts,
            'inventoryProducts' => $inventoryProducts,
            'lowStockThreshold' => $lowStockThreshold,
            'lowStockProducts' => $lowStockProducts,
            'outOfStockProducts' => $outOfStockProducts,
            'totalStockUnits' => $totalStockUnits,
            'selectedProductCategory' => $selectedProductCategory,
            'selectedProductStatus' => $selectedProductStatus,
        ]);
    }

    public function updateStock(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'stock' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        $product->update(['stock' => $validated['stock']]);

        return redirect()->route('admin.dashboard', ['section' => 'inventory'])
            ->with('activeSection', 'inventory')
            ->with('success', $product->name.' stock quantity updated.');
    }

    public function storeManualOrder(Request $request): RedirectResponse
    {
        $availableProducts = Product::where('status', 'Active')
            ->pluck('name')
            ->push('Custom Cake')
            ->unique()
            ->all();

        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255', Rule::in($availableProducts)],
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', new SriLankaMobileNumber],
            'cake_size' => ['required', 'string', 'max:255'],
            'flavor' => ['nullable', 'string', 'max:255'],
            'frosting' => ['nullable', 'string', 'max:255'],
            'delivery_option' => ['required', Rule::in(['Delivery', 'Pickup'])],
            'delivery_date' => ['required', 'date', 'after_or_equal:today'],
            'address' => ['required_if:delivery_option,Delivery', 'nullable', 'string', 'max:500'],
            'city' => ['required_if:delivery_option,Delivery', 'nullable', 'string', 'max:255'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'special_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $isDelivery = $validated['delivery_option'] === 'Delivery';

        Order::create([
            'user_id' => null,
            'product_name' => $validated['product_name'],
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'address' => $isDelivery ? $validated['address'] : 'Pickup from bakery',
            'city' => $isDelivery ? $validated['city'] : 'Bakery Location',
            'cake_size' => $validated['cake_size'],
            'flavor' => $validated['flavor'] ?? null,
            'frosting' => $validated['frosting'] ?? null,
            'special_notes' => $validated['special_notes'] ?? null,
            'delivery_date' => $validated['delivery_date'],
            'delivery_option' => $validated['delivery_option'],
            'total_price' => $validated['total_price'],
            'status' => 'pending',
        ]);

        return redirect()->route('admin.dashboard', ['section' => 'orders'])
            ->with('activeSection', 'orders')
            ->with('success', 'Phone order added successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['sometimes', 'string', Rule::in(['pending', 'processing', 'completed', 'delivered', 'cancel'])],
            'total_price' => ['sometimes', 'numeric', 'min:0'],
        ]);

        if (in_array(strtolower((string) $order->status), ['delivered', 'cancel'], true)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Delivered and cancelled orders cannot be changed.',
                ], 422);
            }

            return redirect()->route('admin.dashboard', ['section' => 'orders'])
                ->with('activeSection', 'orders')
                ->with('error', 'Delivered and cancelled orders cannot be changed.');
        }

        $updates = [];

        if ($request->filled('status')) {
            $updates['status'] = strtolower($request->status);
        }

        if (
            $request->has('total_price')
            && strtolower(trim((string) $order->product_name)) === 'custom cake'
        ) {
            $updates['total_price'] = $request->input('total_price');
        }

        $previousStatus = strtolower((string) $order->status);
        $order->update($updates);

        if (
            isset($updates['status'])
            && $updates['status'] !== $previousStatus
            && $order->user
        ) {
            $order->user->notify(new OrderStatusUpdated($order));
        }

        return redirect()->route('admin.dashboard', ['section' => 'orders'])
            ->with('activeSection', 'orders')
            ->with('success', 'Order status updated successfully.');
    }

    public function assignDelivery(Request $request, Order $order): RedirectResponse
    {
        if (!$this->isAssignableDelivery($order)) {
            return redirect()->route('admin.dashboard', ['section' => 'deliverys'])
                ->with('activeSection', 'deliverys')
                ->with('error', 'Only pending or completed delivery orders can be assigned.');
        }

        $validated = $request->validate([
            'delivery_person_id' => ['required', 'integer', Rule::exists('users', 'id')->where('role', 'delivery_person')],
            'priority' => ['nullable', Rule::in(['normal', 'high', 'urgent'])],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order->update([
            'delivery_person_id' => $validated['delivery_person_id'],
            'priority' => $validated['priority'] ?? 'normal',
            'delivery_notes' => $validated['notes'] ?? null,
            'status' => 'assigned',
        ]);

        return redirect()->route('admin.dashboard', ['section' => 'deliverys'])
            ->with('activeSection', 'deliverys')
            ->with('success', 'Order assigned to delivery person successfully.');
    }

    public function reassignDelivery(Request $request, Order $order): RedirectResponse
    {
        if (!$this->isAssignableDelivery($order)) {
            return redirect()->route('admin.dashboard', ['section' => 'deliverys'])
                ->with('activeSection', 'deliverys')
                ->with('error', 'Only pending or completed delivery orders can be reassigned.');
        }

        $validated = $request->validate([
            'delivery_person_id' => ['required', 'integer', Rule::exists('users', 'id')->where('role', 'delivery_person')],
            'reassign_reason' => ['nullable', 'string', 'max:1000'],
        ]);

        $order->update([
            'delivery_person_id' => $validated['delivery_person_id'],
            'status' => 'assigned',
            'delivery_notes' => $validated['reassign_reason'] ?? $order->delivery_notes,
        ]);

        return redirect()->route('admin.dashboard', ['section' => 'deliverys'])
            ->with('activeSection', 'deliverys')
            ->with('success', 'Delivery assignment updated successfully.');
    }

    private function isAssignableDelivery(Order $order): bool
    {
        return strtolower(trim((string) $order->delivery_option)) === 'delivery'
            && in_array(strtolower(trim((string) $order->status)), ['pending', 'completed'], true);
    }
}
