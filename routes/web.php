<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

    // Customer Dashboard
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->middleware('role:customer')->name('customer.dashboard');

    // Delivery Person Dashboard (placeholder)
    Route::get('/delivery/dashboard', function () {
        return view('dashboard');
    })->middleware('role:delivery_person')->name('delivery.dashboard');

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
Route::get('/products', function () {
    return view('customer.products.products');
})->name('products');

//customer custom cake page
Route::get('/custom-cake', function () {
    return view('customer.custom-cake.custom-cake');
})->middleware(['auth', 'role:customer'])->name('custom-cake');

// Admin category management routes
Route::resource('categories', CategoryController::class);

//customer order submission
Route::post('/custom-cake/order', [OrderController::class, 'store'])
    ->middleware('auth')
    ->name('custom-cake.store');
    
require __DIR__.'/auth.php';
