<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

test('product updates redirect back to the admin dashboard products section', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Bakery',
        'description' => 'Fresh bakery items',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Sourdough',
        'description' => 'Fresh loaf',
        'price' => 12.00,
        'stock' => 8,
        'size' => '1 kg',
        'status' => 'Active',
    ]);

    $this->actingAs($admin)
        ->put(route('products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Sourdough Updated',
            'description' => 'Fresh loaf updated',
            'price' => 13.50,
            'stock' => 9,
            'size' => '2 kg',
            'status' => 'Active',
        ])
        ->assertRedirect('/admin/dashboard')
        ->assertSessionHas('success', 'Product Updated Successfully ✨')
        ->assertSessionHas('activeSection', 'products');

    $product->refresh();
    expect($product->size)->toBe('2 kg');
});

test('admin dashboard renders the product edit modal with a form action setter', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Cakes',
        'description' => 'Sweet cakes',
    ]);

    Product::create([
        'category_id' => $category->id,
        'name' => 'Chocolate Cake',
        'description' => 'Rich chocolate cake',
        'price' => 15.50,
        'stock' => 10,
        'size' => '1 pcs',
        'status' => 'Active',
    ]);

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertSee("onclick='editProduct(", false)
        ->assertSee("document.getElementById('editProductForm').action = \"/products/\" + id;", false);
});

test('checkout form saves cart and delivery details with pending status', function () {
    $customer = User::factory()->create([
        'name' => 'Aneema Rajapaksha',
        'contact_number' => '+94711234567',
        'address' => 'Main Road, Colombo',
        'city' => 'Colombo',
        'role' => 'customer',
    ]);

    $this->actingAs($customer)
        ->post(route('custom-products.order'), [
            'total_price' => 1500,
            'product_name' => 'Chocolate Cake x2',
            'cake_size' => '1kg, 2kg',
            'flavor' => 'Chocolate',
            'frosting' => 'Classic',
            'customer_name' => $customer->name,
            'phone' => $customer->contact_number,
            'address' => $customer->address,
            'city' => $customer->city,
            'postal_code' => '10100',
            'delivery_date' => '2026-08-20',
            'cake_message' => 'Happy Birthday',
            'special_notes' => 'Extra candles',
            'delivery_option' => 'Delivery',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('orders', [
        'user_id' => $customer->id,
        'product_name' => 'Chocolate Cake x2',
        'customer_name' => $customer->name,
        'delivery_option' => 'Delivery',
        'cake_message' => 'Happy Birthday',
        'status' => 'pending',
    ]);
});

test('customer can cancel a pending order and set the status to cancel', function () {
    $customer = User::factory()->create([
        'name' => 'Aneema Rajapaksha',
        'role' => 'customer',
    ]);

    $order = \App\Models\Order::create([
        'user_id' => $customer->id,
        'customer_name' => $customer->name,
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'postal_code' => '10100',
        'cake_size' => '1kg',
        'flavor' => 'Chocolate',
        'frosting' => 'Classic',
        'delivery_date' => '2026-08-20',
        'delivery_option' => 'Delivery',
        'total_price' => 2500,
        'status' => 'pending',
    ]);

    $this->actingAs($customer)
        ->post(route('customer.orders.cancel', $order))
        ->assertRedirect(route('customer.orders'))
        ->assertSessionHas('success', 'Order cancelled successfully.');

    $this->assertDatabaseHas('orders', [
        'id' => $order->id,
        'status' => 'cancel',
    ]);
});

test('custom cake form posts the order details with product name custom cake', function () {
    $customer = User::factory()->create([
        'role' => 'customer',
    ]);

    $this->actingAs($customer)
        ->get(route('custom-cake'))
        ->assertOk()
        ->assertSee('name="product_name"', false)
        ->assertSee('value="Custom Cake"', false)
        ->assertSee('name="cake_size"', false)
        ->assertSee('name="flavor"', false)
        ->assertSee('name="frosting"', false);
});

test('custom cake order saves delivery_option as pickup when pickup is selected', function () {
    $customer = User::factory()->create([
        'name' => 'Pickup Customer',
        'role' => 'customer',
    ]);

    $this->actingAs($customer)
        ->post(route('custom-cake.store'), [
            'product_name' => 'Custom Cake',
            'cake_size' => '8 inches',
            'flavor' => 'Chocolate',
            'frosting' => 'Buttercream',
            'cake_message' => 'Happy Birthday',
            'customer_name' => $customer->name,
            'phone' => '0771234567',
            'address' => 'Pickup from bakery',
            'city' => 'Bakery Location',
            'delivery_date' => '2026-08-25',
            'delivery_option' => 'pickup',
            'special_notes' => 'Pickup at bakery',
            'total_price' => 0,
            'status' => 'pending',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('orders', [
        'user_id' => $customer->id,
        'product_name' => 'Custom Cake',
        'delivery_option' => 'Pickup',
        'address' => 'Pickup from bakery',
        'city' => 'Bakery Location',
    ]);
});

test('customer can view their my orders page', function () {
    $customer = User::factory()->create([
        'role' => 'customer',
    ]);

    $this->actingAs($customer)
        ->get(route('customer.orders'))
        ->assertOk()
        ->assertSee('My Orders');
});
