<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\DeliveryPersonDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

//Menu page
Route::get('/menu', function () {
    return view('menu');
})->name('menu');

// Dashboard routing based on user role
Route::middleware(['auth', 'verified'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/orders', [AdminDashboardController::class, 'index'])->name('admin.orders.index');
    Route::post('/admin/products/{product}/stock', [AdminDashboardController::class, 'updateStock'])
        ->middleware('role:admin')
        ->name('admin.products.update-stock');
    Route::post('/admin/orders', [AdminDashboardController::class, 'storeManualOrder'])
        ->middleware('role:admin')
        ->name('admin.orders.store');
    Route::post('/admin/orders/{order}/update-status', [AdminDashboardController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::post('/admin/orders/{order}/assign-delivery', [AdminDashboardController::class, 'assignDelivery'])->name('admin.orders.assign-delivery');
    Route::put('/admin/orders/{order}/reassign-delivery', [AdminDashboardController::class, 'reassignDelivery'])->name('admin.orders.reassign-delivery');

    // Delivery Person Dashboard
    Route::get('/delivery/dashboard', [DeliveryPersonDashboardController::class, 'index'])
        ->middleware('role:delivery_person')
        ->name('delivery.dashboard');
    Route::post('/delivery/orders/{order}/status', [DeliveryPersonDashboardController::class, 'updateStatus'])
        ->middleware('role:delivery_person')
        ->name('delivery.orders.status');

    // Redirect /dashboard to appropriate dashboard based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            'delivery_person' => redirect()->route('delivery.dashboard'),
            default => view('dashboard'),
        };
    })->name('dashboard');
});

// Profile routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//customer products page
Route::get('/custom-products', function () {
    $categories = Category::with('products')->get();
    $products = Product::with('category')->get();

    return view('customer.custom-products.custom-products', compact('categories', 'products'));
})->name('custom-products.customer');

//customer custom cake page
Route::get('/custom-cake', function () {
    return view('customer.custom-cake.custom-cake');
})->middleware(['auth', 'role:customer'])->name('custom-cake');

// Admin category management routes
Route::resource('categories', CategoryController::class);

// Admin product management routes
Route::resource('products', ProductController::class);

//customer order submission
Route::post('/custom-cake/order', [OrderController::class, 'store'])
    ->middleware('auth')
    ->name('custom-cake.store');

Route::post('/custom-products/order', [OrderController::class, 'store'])
    ->middleware('auth')
    ->name('custom-products.order');

Route::get('/customer/orders', [OrderController::class, 'index'])
    ->middleware(['auth', 'role:customer'])
    ->name('customer.orders');

Route::post('/customer/notifications/{notification}/dismiss', [OrderController::class, 'dismissNotification'])
    ->middleware(['auth', 'role:customer'])
    ->name('customer.notifications.dismiss');

Route::post('/customer/orders/{order}/cancel', [OrderController::class, 'cancel'])
    ->middleware(['auth', 'role:customer'])
    ->name('customer.orders.cancel');

require __DIR__.'/auth.php';
