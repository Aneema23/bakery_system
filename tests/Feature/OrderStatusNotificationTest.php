<?php

use App\Models\Order;
use App\Models\User;

test('customer can open the full order from an admin status notification', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'customer']);
    $order = Order::create([
        'user_id' => $customer->id,
        'product_name' => 'Custom Cake',
        'customer_name' => $customer->name,
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '8 inch',
        'flavor' => 'Vanilla',
        'frosting' => 'Buttercream',
        'delivery_date' => '2026-10-10',
        'delivery_option' => 'Delivery',
        'total_price' => 3200,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)
        ->post(route('admin.orders.update-status', $order), ['status' => 'processing'])
        ->assertRedirect();

    $notification = $customer->notifications()->firstOrFail();
    expect($notification->data['message'])->toBe('Your order has been confirmed and is being prepared.');

    $this->actingAs($customer)
        ->get(route('customer.orders', ['notification' => $notification->id]))
        ->assertOk()
        ->assertSee('Custom Cake')
        ->assertSee('receipt-' . $order->id);

    expect($notification->fresh()->read_at)->not->toBeNull();
});

test('customer can dismiss a new order update alert', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'customer']);
    $order = Order::create([
        'user_id' => $customer->id,
        'product_name' => 'Chocolate Cake',
        'customer_name' => $customer->name,
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '1kg',
        'flavor' => 'Chocolate',
        'frosting' => 'Cream',
        'delivery_date' => '2026-10-10',
        'delivery_option' => 'Delivery',
        'total_price' => 2500,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)
        ->post(route('admin.orders.update-status', $order), ['status' => 'processing']);

    $notification = $customer->notifications()->firstOrFail();

    $this->actingAs($customer)
        ->get(route('customer.orders'))
        ->assertOk()
        ->assertSee('New order update')
        ->assertSee('Dismiss order update');

    $this->post(route('customer.notifications.dismiss', $notification->id))
        ->assertRedirect(route('customer.orders'));

    expect($notification->fresh()->read_at)->not->toBeNull();

    $this->get(route('customer.orders'))
        ->assertOk()
        ->assertDontSee('New order update');
});