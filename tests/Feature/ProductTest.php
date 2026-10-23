<?php

use App\Models\Category;
use App\Models\Order;
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

test('admin can update product stock from inventory and negative counts are rejected', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $category = Category::create([
        'name' => 'Bakery',
        'description' => 'Fresh bakery items',
    ]);
    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Sourdough',
        'price' => 12.00,
        'stock' => 8,
        'status' => 'Active',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'inventory']))
        ->assertOk()
        ->assertSee('id="inventorySection"', false)
        ->assertSee('Product inventory')
        ->assertSee('name="stock"', false)
        ->assertSee('aria-label="New on-hand count for Sourdough"', false);

    $this->actingAs($admin)
        ->post(route('admin.products.update-stock', $product), ['stock' => 14])
        ->assertRedirect(route('admin.dashboard', ['section' => 'inventory']))
        ->assertSessionHas('activeSection', 'inventory');

    expect($product->refresh()->stock)->toBe(14);

    $this->get(route('admin.dashboard', ['section' => 'inventory']))
        ->assertOk()
        ->assertSee('class="success-alert alert alert-success py-2 px-3" role="status"', false)
        ->assertSee('Sourdough stock quantity updated.');

    $this->actingAs($admin)
        ->post(route('admin.products.update-stock', $product), ['stock' => -1])
        ->assertSessionHasErrors('stock');

    expect($product->refresh()->stock)->toBe(14);
});

test('customer product orders deduct the purchased quantity from stock', function () {
    $customer = User::factory()->create(['role' => 'customer']);
    $category = Category::create([
        'name' => 'Bakery',
        'description' => 'Fresh bakery items',
    ]);
    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Sourdough',
        'price' => 1000,
        'stock' => 5,
        'status' => 'Active',
    ]);

    $this->actingAs($customer)
        ->post(route('custom-products.order'), [
            'cart_items' => json_encode([
                ['product_id' => $product->id, 'quantity' => 2],
            ]),
            'total_price' => 2000,
            'product_name' => 'Untrusted product name',
            'cake_size' => '1kg, 1kg',
            'flavor' => 'Sourdough',
            'frosting' => 'Classic',
            'customer_name' => $customer->name,
            'phone' => '0771234567',
            'delivery_date' => now()->addDays(2)->toDateString(),
            'delivery_option' => 'Pickup',
        ])
        ->assertRedirect();

    expect($product->refresh()->stock)->toBe(3);
    $this->assertDatabaseHas('orders', [
        'user_id' => $customer->id,
        'product_name' => 'Sourdough x2',
        'status' => 'pending',
    ]);
});

test('customer product order is rejected without changing stock when quantity is unavailable', function () {
    $customer = User::factory()->create(['role' => 'customer']);
    $category = Category::create([
        'name' => 'Bakery',
        'description' => 'Fresh bakery items',
    ]);
    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Sourdough',
        'price' => 1000,
        'stock' => 1,
        'status' => 'Active',
    ]);

    $this->actingAs($customer)
        ->from('/custom-products')
        ->post(route('custom-products.order'), [
            'cart_items' => json_encode([
                ['product_id' => $product->id, 'quantity' => 2],
            ]),
            'customer_name' => $customer->name,
            'phone' => '0771234567',
            'delivery_date' => now()->addDays(2)->toDateString(),
            'delivery_option' => 'Pickup',
        ])
        ->assertRedirect('/custom-products')
        ->assertSessionHasErrors('cart_items');

    expect($product->refresh()->stock)->toBe(1);
    $this->assertDatabaseCount('orders', 0);
});

test('customer menu labels zero-stock products as out of stock and disables ordering', function () {
    $category = Category::create([
        'name' => 'Bakery',
        'description' => 'Fresh bakery items',
    ]);
    Product::create([
        'category_id' => $category->id,
        'name' => 'Sold Out Loaf',
        'price' => 1000,
        'stock' => 0,
        'status' => 'Active',
    ]);

    $this->get(route('custom-products.customer'))
        ->assertOk()
        ->assertSee('Out of Stock')
        ->assertSee('aria-label="Out of stock"', false)
        ->assertSee('data-stock="0"', false);
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

test('admin dashboard renders external product image URLs without a storage prefix', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $category = Category::create([
        'name' => 'Cakes',
        'description' => 'Sweet cakes',
    ]);
    Product::create([
        'category_id' => $category->id,
        'name' => 'Chocolate Cake',
        'price' => 15.50,
        'stock' => 8,
        'image' => 'https://example.com/chocolate-cake.jpg',
        'status' => 'Active',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'products']))
        ->assertOk()
        ->assertSee('src="https://example.com/chocolate-cake.jpg"', false)
        ->assertDontSee('storage/https://example.com/chocolate-cake.jpg', false);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'inventory']))
        ->assertOk()
        ->assertSee('src="https://example.com/chocolate-cake.jpg"', false)
        ->assertDontSee('storage/https://example.com/chocolate-cake.jpg', false);
});

test('admin dashboard uses real recent orders and top selling data', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    Order::create([
        'product_name' => 'Chocolate Cake',
        'customer_name' => 'Real Customer',
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '1kg',
        'flavor' => 'Chocolate',
        'frosting' => 'Cream',
        'delivery_date' => '2026-09-20',
        'delivery_option' => 'Pickup',
        'total_price' => 2500,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Real Customer')
        ->assertSee('Chocolate Cake')
        ->assertSee('data: [1]', false)
        ->assertDontSee('#ORD-101');
});

test('admin order board marks past-due unfinished orders as overdue', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $baseOrder = [
        'product_name' => 'Bakery Order',
        'customer_name' => 'Order Customer',
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '1 kg',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->subDay()->toDateString(),
        'delivery_option' => 'Pickup',
        'total_price' => 1000,
    ];

    Order::create($baseOrder + ['status' => 'pending']);
    Order::create($baseOrder + ['status' => 'completed']);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'orders']))
        ->assertOk()
        ->assertSee('OVERDUE')
        ->assertSee('class="badge bg-danger" role="status"', false);

    expect(substr_count($this->get(route('admin.dashboard', ['section' => 'orders']))->getContent(), 'OVERDUE'))->toBe(1);
});

test('admin can filter orders by pickup or delivery date', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $orderAttributes = [
        'product_name' => 'Bakery Order',
        'customer_name' => 'Order Customer',
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '1 kg',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_option' => 'Pickup',
        'total_price' => 1000,
        'status' => 'pending',
    ];
    $matchingOrder = Order::create($orderAttributes + [
        'delivery_date' => now()->addDay()->toDateString(),
    ]);
    $otherOrder = Order::create($orderAttributes + [
        'delivery_date' => now()->addDays(2)->toDateString(),
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', [
            'section' => 'orders',
            'delivery_date' => now()->addDay()->toDateString(),
        ]))
        ->assertOk()
        ->assertSee('id="orderDeliveryDateFilter"', false)
        ->assertSee('data-update-url="'.route('admin.orders.update-status', $matchingOrder).'"', false)
        ->assertDontSee('data-update-url="'.route('admin.orders.update-status', $otherOrder).'"', false);
});

test('admin reports use database totals and apply report filters', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'customer']);
    $cakes = Category::create([
        'name' => 'Cakes',
        'description' => 'Fresh cakes',
    ]);
    $bread = Category::create([
        'name' => 'Bread',
        'description' => 'Fresh bread',
    ]);

    Product::create([
        'category_id' => $cakes->id,
        'name' => 'Chocolate Cupcake',
        'description' => 'Chocolate cupcake',
        'price' => 1250,
        'status' => 'Active',
    ]);
    Product::create([
        'category_id' => $bread->id,
        'name' => 'Sourdough Loaf',
        'description' => 'Fresh sourdough',
        'price' => 900,
        'status' => 'Active',
    ]);

    $orderAttributes = [
        'user_id' => $customer->id,
        'customer_name' => 'Report Customer',
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '1 pcs',
        'flavor' => 'Chocolate',
        'frosting' => 'Cream',
        'delivery_date' => now()->addDays(2)->toDateString(),
        'delivery_option' => 'Pickup',
    ];

    Order::create($orderAttributes + [
        'product_name' => 'Chocolate Cupcake',
        'total_price' => 1250,
        'status' => 'pending',
    ]);
    Order::create($orderAttributes + [
        'product_name' => 'Chocolate Cupcake',
        'total_price' => 800,
        'status' => 'processing',
    ]);
    Order::create($orderAttributes + [
        'product_name' => 'Sourdough Loaf',
        'total_price' => 900,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', [
            'section' => 'reports',
            'report_range' => '30',
            'report_category' => $cakes->id,
            'report_status' => 'pending',
        ]))
        ->assertOk()
        ->assertSee('Rs. 1,250.00')
        ->assertSee('name="report_status"', false)
        ->assertSee('showSection(\'reports\')', false)
        ->assertSee('data: [1250]', false)
        ->assertDontSee('842,350')
        ->assertDontSee('Strawberry Cream Cake');
});

test('admin report subtracts cancelled order refunds from net revenue', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'customer']);

    $orderAttributes = [
        'user_id' => $customer->id,
        'customer_name' => 'Refund Report Customer',
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '1kg',
        'flavor' => 'Chocolate',
        'frosting' => 'Cream',
        'delivery_date' => now()->addDays(2)->toDateString(),
        'delivery_option' => 'Pickup',
    ];

    Order::create($orderAttributes + [
        'product_name' => 'Chocolate Cake',
        'total_price' => 2000,
        'status' => 'completed',
    ]);
    Order::create($orderAttributes + [
        'product_name' => 'Vanilla Cake',
        'total_price' => 500,
        'status' => 'cancel',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'reports', 'report_range' => 'all']))
        ->assertOk()
        ->assertSee('Net Revenue')
        ->assertSee('Rs. 2,000.00')
        ->assertSee('Cancelled Refunds')
        ->assertSee('Refund Report Customer')
        ->assertSee('Rs. 500.00')
        ->assertSee('Cancelled Orders and Refund Values')
        ->assertSee('data: [2000]', false);
});

test('admin product section does not expose stock controls', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'products']))
        ->assertOk()
        ->assertDontSee('<th>Stock</th>', false)
        ->assertDontSee('name="stock"', false)
        ->assertDontSee('edit_stock', false)
        ->assertDontSee('low stock', false);
});

test('admin dashboard product filters show only matching products', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $cakes = Category::create([
        'name' => 'Cakes',
        'description' => 'Sweet cakes',
    ]);

    $bread = Category::create([
        'name' => 'Bread',
        'description' => 'Fresh bread',
    ]);

    Product::create([
        'category_id' => $cakes->id,
        'name' => 'Chocolate Cake',
        'description' => 'Rich chocolate cake',
        'price' => 15.50,
        'stock' => 10,
        'size' => '1 pcs',
        'status' => 'Active',
    ]);

    Product::create([
        'category_id' => $bread->id,
        'name' => 'Sourdough',
        'description' => 'Fresh loaf',
        'price' => 12.00,
        'stock' => 8,
        'size' => '1 kg',
        'status' => 'Inactive',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'products', 'product_category' => $cakes->id, 'product_status' => 'Active']))
        ->assertOk()
        ->assertSee('Chocolate Cake')
        ->assertDontSee('Sourdough');
});

test('admin dashboard product filters submit automatically on change', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'products']))
        ->assertOk()
        ->assertSee('onchange="this.form.submit()"', false);
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
            'delivery_date' => now()->addDays(2)->toDateString(),
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
        ->assertSessionHas('success', 'Order cancelled successfully. We will contact you within 48 hours, and your full order amount will be refunded within 72 hours.');

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
            'delivery_date' => now()->addDays(2)->toDateString(),
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

test('customer cannot book a delivery date that already has three active orders', function () {
    $customer = User::factory()->create([
        'role' => 'customer',
    ]);
    $deliveryDate = now()->addDays(2)->toDateString();

    foreach (range(1, 3) as $orderNumber) {
        Order::create([
            'user_id' => $customer->id,
            'product_name' => "Cake {$orderNumber}",
            'customer_name' => $customer->name,
            'phone' => '0771234567',
            'address' => 'Pickup from bakery',
            'city' => 'Bakery Location',
            'cake_size' => '1 kg',
            'flavor' => 'Vanilla',
            'frosting' => 'Buttercream',
            'delivery_date' => $deliveryDate,
            'delivery_option' => 'Pickup',
            'total_price' => 0,
            'status' => 'pending',
        ]);
    }

    $this->actingAs($customer)
        ->from('/custom-cake')
        ->post(route('custom-cake.store'), [
            'product_name' => 'Custom Cake',
            'customer_name' => $customer->name,
            'phone' => '0771234567',
            'delivery_date' => $deliveryDate,
            'delivery_option' => 'pickup',
        ])
        ->assertRedirect('/custom-cake')
        ->assertSessionHasErrors('delivery_date');

    $this->assertDatabaseCount('orders', 3);
});

test('customer cannot order less than two days in advance', function () {
    $customer = User::factory()->create([
        'role' => 'customer',
    ]);

    $this->actingAs($customer)
        ->from('/custom-cake')
        ->post(route('custom-cake.store'), [
            'product_name' => 'Custom Cake',
            'customer_name' => $customer->name,
            'phone' => '0771234567',
            'delivery_date' => now()->addDay()->toDateString(),
            'delivery_option' => 'pickup',
        ])
        ->assertRedirect('/custom-cake')
        ->assertSessionHasErrors('delivery_date');

    $this->assertDatabaseCount('orders', 0);
});

test('admin can add a phone order to the regular order board', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'customer']);

    $this->actingAs($customer)
        ->post(route('admin.orders.store'), [])
        ->assertForbidden();

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'orders']))
        ->assertOk()
        ->assertSee('Add Phone Order');

    $category = Category::create([
        'name' => 'Cakes',
        'description' => 'Fresh cakes',
    ]);
    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Chocolate Cake',
        'description' => 'Chocolate cake',
        'price' => 2500,
        'stock' => 10,
        'size' => '1 kg',
        'status' => 'Active',
    ]);

    $this->actingAs($admin)
        ->post(route('admin.orders.store'), [
            'product_name' => $product->name,
            'customer_name' => 'Phone Customer',
            'phone' => '0771234567',
            'cake_size' => '1 kg',
            'delivery_option' => 'Pickup',
            'delivery_date' => now()->toDateString(),
            'total_price' => 2500,
        ])
        ->assertRedirect(route('admin.dashboard', ['section' => 'orders']))
        ->assertSessionHas('success', 'Phone order added successfully.');

    $this->assertDatabaseHas('orders', [
        'user_id' => null,
        'product_name' => 'Chocolate Cake',
        'customer_name' => 'Phone Customer',
        'phone' => '0771234567',
        'delivery_option' => 'Pickup',
        'status' => 'pending',
        'total_price' => 2500,
    ]);
});

test('admin can update only the order status and review order details', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $order = \App\Models\Order::create([
        'user_id' => User::factory()->create(['role' => 'customer'])->id,
        'product_name' => 'Custom Cake',
        'customer_name' => 'Jane Smith',
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '8 inch',
        'flavor' => 'Vanilla',
        'frosting' => 'Buttercream',
        'delivery_date' => '2026-08-25',
        'delivery_option' => 'Delivery',
        'total_price' => 3200,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertSee('Custom Cake')
        ->assertSee('updateOrderStatus');

    $this->actingAs($admin)
        ->post(route('admin.orders.update-status', $order), [
            'status' => 'processing',
        ])
        ->assertRedirect(route('admin.dashboard', ['section' => 'orders']))
        ->assertSessionHas('activeSection', 'orders')
        ->assertSessionHas('success', 'Order status updated successfully.');

    $order->refresh();
    expect($order->status)->toBe('processing');
});

test('admin can update total price for custom cakes but not regular orders', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $customer = User::factory()->create(['role' => 'customer']);

    $customCake = \App\Models\Order::create([
        'user_id' => $customer->id,
        'product_name' => 'Custom Cake',
        'customer_name' => 'Custom Customer',
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '8 inch',
        'flavor' => 'Vanilla',
        'frosting' => 'Buttercream',
        'delivery_date' => '2026-08-25',
        'delivery_option' => 'Delivery',
        'total_price' => 3200,
        'status' => 'pending',
    ]);

    $regularOrder = \App\Models\Order::create([
        'user_id' => $customer->id,
        'product_name' => 'Chocolate Cake',
        'customer_name' => 'Regular Customer',
        'phone' => '0771234568',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '1kg',
        'flavor' => 'Chocolate',
        'frosting' => 'Cream',
        'delivery_date' => '2026-08-25',
        'delivery_option' => 'Delivery',
        'total_price' => 2500,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)->post(route('admin.orders.update-status', $customCake), [
        'total_price' => 4500,
    ])->assertRedirect();

    $this->actingAs($admin)->post(route('admin.orders.update-status', $regularOrder), [
        'total_price' => 9999,
    ])->assertRedirect();

    $this->assertDatabaseHas('orders', ['id' => $customCake->id, 'total_price' => 4500]);
    $this->assertDatabaseHas('orders', ['id' => $regularOrder->id, 'total_price' => 2500]);
});

test('admin can assign delivery orders to delivery persons', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $deliveryPerson = User::factory()->create(['role' => 'delivery_person']);
    $customer = User::factory()->create(['role' => 'customer']);

    $order = \App\Models\Order::create([
        'user_id' => $customer->id,
        'product_name' => 'Chocolate Cake',
        'customer_name' => 'Delivery Customer',
        'phone' => '0771234567',
        'address' => 'Colombo',
        'city' => 'Colombo',
        'cake_size' => '1kg',
        'flavor' => 'Chocolate',
        'frosting' => 'Cream',
        'delivery_date' => '2026-08-25',
        'delivery_option' => 'Delivery',
        'total_price' => 2500,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)
        ->post(route('admin.orders.assign-delivery', $order), [
            'delivery_person_id' => $deliveryPerson->id,
            'priority' => 'high',
            'notes' => 'Call before arriving.',
        ])
        ->assertRedirect(route('admin.dashboard', ['section' => 'deliverys']))
        ->assertSessionHas('activeSection', 'deliverys')
        ->assertSessionHas('success', 'Order assigned to delivery person successfully.');

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'deliverys']))
        ->assertOk()
        ->assertSee('Order assigned to delivery person successfully.');

    $this->assertDatabaseHas('orders', [
        'id' => $order->id,
        'delivery_person_id' => $deliveryPerson->id,
        'priority' => 'high',
        'delivery_notes' => 'Call before arriving.',
        'status' => 'assigned',
    ]);
});

test('admin cannot change delivered or cancelled order status', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    foreach (['delivered', 'cancel'] as $terminalStatus) {
        $order = \App\Models\Order::create([
            'user_id' => User::factory()->create(['role' => 'customer'])->id,
            'product_name' => 'Custom Cake',
            'customer_name' => 'Locked Order Customer',
            'phone' => '0771234567',
            'address' => 'Colombo',
            'city' => 'Colombo',
            'cake_size' => '8 inch',
            'flavor' => 'Vanilla',
            'frosting' => 'Buttercream',
            'delivery_date' => '2026-08-25',
            'delivery_option' => 'Delivery',
            'total_price' => 3200,
            'status' => $terminalStatus,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.orders.update-status', $order), [
                'status' => 'processing',
            ])
            ->assertRedirect(route('admin.dashboard', ['section' => 'orders']))
            ->assertSessionHas('error', 'Delivered and cancelled orders cannot be changed.');

        expect($order->refresh()->status)->toBe($terminalStatus);
    }
});

test('admin can filter orders by status and custom cake type', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    \App\Models\Order::create([
        'user_id' => User::factory()->create(['role' => 'customer'])->id,
        'product_name' => 'Custom Cake',
        'customer_name' => 'Alice Custom',
        'phone' => '0771111111',
        'address' => 'Galle',
        'city' => 'Galle',
        'cake_size' => '6 inch',
        'flavor' => 'Chocolate',
        'frosting' => 'Ganache',
        'delivery_date' => '2026-08-22',
        'delivery_option' => 'Pickup',
        'total_price' => 2800,
        'status' => 'pending',
    ]);

    \App\Models\Order::create([
        'user_id' => User::factory()->create(['role' => 'customer'])->id,
        'product_name' => 'Chocolate Croissant',
        'customer_name' => 'Bob Product',
        'phone' => '0772222222',
        'address' => 'Kandy',
        'city' => 'Kandy',
        'cake_size' => 'N/A',
        'flavor' => 'Butter',
        'frosting' => 'None',
        'delivery_date' => '2026-08-23',
        'delivery_option' => 'Delivery',
        'total_price' => 900,
        'status' => 'processing',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.orders.index', ['status' => 'pending', 'custom_type' => 'custom_cake']))
        ->assertOk()
        ->assertSee('Alice Custom')
        ->assertDontSee('Bob Product');
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
