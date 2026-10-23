<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\DeliveryPersonController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('admin/delivery-persons', DeliveryPersonController::class)->names([
        'index' => 'admin.delivery-persons.index',
        'create' => 'admin.delivery-persons.create',
        'store' => 'admin.delivery-persons.store',
        'edit' => 'admin.delivery-persons.edit',
        'update' => 'admin.delivery-persons.update',
        'destroy' => 'admin.delivery-persons.destroy',
    ]);
});

Route::middleware(['auth','role:customer'])->group(function () {
    Route::get('/customer/dashboard', function () {
        $orders = Order::where('user_id', auth()->id());

        $totalOrders = (clone $orders)->count();
        $completedOrders = (clone $orders)
            ->whereRaw("LOWER(status) IN ('completed', 'delivered')")
            ->count();
        $pendingOrders = (clone $orders)
            ->whereRaw('LOWER(status) = ?', ['pending'])
            ->count();

        return view('customer.dashboard', compact(
            'totalOrders',
            'completedOrders',
            'pendingOrders'
        ));
    })->name('customer.dashboard');
});

