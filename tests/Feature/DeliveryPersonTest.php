<?php

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

test('admin can create, update, view and delete a delivery person user', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(route('admin.delivery-persons.store'), [
        'name' => 'Nimal Perera',
        'contact_number' => '0771234567',
        'address' => '12 Main Street',
        'city' => 'Colombo',
        'nic' => '901234567V',
        'vehicle_type' => 'Motorcycle',
        'email' => 'nimal@example.com',
        'password' => 'Delivery123!',
        'password_confirmation' => 'Delivery123!',
    ]);

    $response->assertRedirect(route('admin.dashboard', ['section' => 'delivery_person']));
    $response->assertSessionHas('success', 'Delivery person added successfully.');
    $this->get(route('admin.dashboard', ['section' => 'delivery_person']))
        ->assertOk();

    $deliveryPerson = User::where('email', 'nimal@example.com')->firstOrFail();
    expect($deliveryPerson->role)->toBe('delivery_person');
    expect(Hash::check('Delivery123!', $deliveryPerson->password))->toBeTrue();
    $this->assertDatabaseHas('users', [
        'id' => $deliveryPerson->id,
        'contact_number' => '0771234567',
        'nic' => '901234567V',
        'vehicle_type' => 'Motorcycle',
    ]);

    $this->actingAs($admin)->put(route('admin.delivery-persons.update', $deliveryPerson), [
        'name' => 'Nimal Perera Updated',
        'contact_number' => '0719999999',
        'address' => '12 Main Street',
        'city' => 'Kandy',
        'nic' => '901234567V',
        'vehicle_type' => 'Car',
        'status' => 'Inactive',
        'email' => 'nimal.updated@example.com',
    ])->assertRedirect(route('admin.dashboard', ['section' => 'delivery_person']))
        ->assertSessionHas('activeSection', 'delivery_person');

    $this->assertDatabaseHas('users', [
        'id' => $deliveryPerson->id,
        'name' => 'Nimal Perera Updated',
        'contact_number' => '0719999999',
        'city' => 'Kandy',
        'status' => 'Inactive',
    ]);

    $this->actingAs($admin)->delete(route('admin.delivery-persons.destroy', $deliveryPerson))
        ->assertRedirect(route('admin.dashboard', ['section' => 'delivery_person']))
        ->assertSessionHas('activeSection', 'delivery_person');

    $this->assertDatabaseMissing('users', ['id' => $deliveryPerson->id]);
});

test('delivery person creation returns to its form and shows validation errors', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->post(route('admin.delivery-persons.store'), [
        'name' => 'Nimal Perera',
        'contact_number' => 'invalid',
        'email' => 'nimal@example.com',
        'password' => 'Delivery123!',
        'password_confirmation' => 'Delivery123!',
    ])
        ->assertRedirect(route('admin.dashboard', ['section' => 'delivery_person']))
        ->assertSessionHasErrors(['contact_number'], null, 'deliveryPerson');

    $this->assertDatabaseMissing('users', ['email' => 'nimal@example.com']);
});

test('delivery person login opens the delivery dashboard', function () {
    $deliveryPerson = User::factory()->create([
        'role' => 'delivery_person',
        'email' => 'driver@example.com',
        'password' => 'password',
    ]);

    $this->post('/login', [
        'email' => $deliveryPerson->email,
        'password' => 'password',
    ])->assertRedirect(route('delivery.dashboard'));

    $this->get(route('delivery.dashboard'))
        ->assertOk()
        ->assertSee('Delivery Dashboard');
});

test('delivery management only displays delivery orders', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Order::create([
        'customer_name' => 'Delivery Customer',
        'phone' => '0770000000',
        'address' => '1 Main Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'pending',
    ]);
    $cancelledDeliveryOrder = Order::create([
        'customer_name' => 'Cancelled Delivery Customer',
        'phone' => '0770000002',
        'address' => '3 Main Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'cancel',
    ]);
    $completedDeliveryOrder = Order::create([
        'customer_name' => 'Completed Delivery Customer',
        'phone' => '0770000003',
        'address' => '4 Main Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'completed',
    ]);
    Order::create([
        'customer_name' => 'Picked Up Customer',
        'phone' => '0770000004',
        'address' => '5 Main Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'picked',
    ]);
    Order::create([
        'customer_name' => 'Pickup Customer',
        'phone' => '0770000001',
        'address' => '2 Main Street',
        'city' => 'Colombo',
        'delivery_option' => 'Pickup',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'deliverys']))
        ->assertOk();

    expect($response->viewData('deliveries')->pluck('customer_name')->all())
        ->toContain('Completed Delivery Customer')
        ->toContain('Delivery Customer');

    expect($response->viewData('deliveries')->pluck('id')->all())
        ->toContain($completedDeliveryOrder->id)
        ->not->toContain($cancelledDeliveryOrder->id);

    expect($response->viewData('deliveredDeliveries'))->toBe(1);
    expect($response->viewData('deliveryStatusCounts')->all())
        ->toBe(['pending' => 1, 'assigned' => 0, 'in_transit' => 1, 'delivered' => 1, 'failed' => 0]);
    expect($response->viewData('reportDeliveryCounts')->all())
        ->toBe(['pending' => 1, 'assigned' => 0, 'in_transit' => 1, 'delivered' => 1, 'failed' => 0]);
    $response->assertSee('value="completed">Completed</option>', false)
        ->assertSee('>Completed</span>', false)
        ->assertSee("labels: ['Pending', 'Assigned', 'Picked Up / In Transit', 'Delivered', 'Failed']", false)
        ->assertSee('data: [1,0,1,1,0]', false);

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'reports']))
        ->assertOk()
        ->assertSee('Delivery Snapshot')
        ->assertSee('Picked Up / In Transit')
        ->assertViewHas('reportDeliveryCounts', fn ($counts) => $counts->all() === [
            'pending' => 1,
            'assigned' => 0,
            'in_transit' => 1,
            'delivered' => 1,
            'failed' => 0,
        ]);
});

test('admin cannot assign or reassign delivered orders', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $currentDriver = User::factory()->create(['role' => 'delivery_person']);
    $newDriver = User::factory()->create(['role' => 'delivery_person']);
    $order = Order::create([
        'delivery_person_id' => $currentDriver->id,
        'customer_name' => 'Delivered Customer',
        'phone' => '0770000002',
        'address' => '3 Main Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'delivered',
    ]);

    $this->actingAs($admin)
        ->post(route('admin.orders.assign-delivery', $order), [
            'delivery_person_id' => $newDriver->id,
        ])
        ->assertRedirect(route('admin.dashboard', ['section' => 'deliverys']))
        ->assertSessionHas('error', 'Only pending or completed delivery orders can be assigned.');

    $this->actingAs($admin)
        ->put(route('admin.orders.reassign-delivery', $order), [
            'delivery_person_id' => $newDriver->id,
        ])
        ->assertRedirect(route('admin.dashboard', ['section' => 'deliverys']))
        ->assertSessionHas('error', 'Only pending or completed delivery orders can be reassigned.');

    $this->actingAs($admin)
        ->get(route('admin.dashboard', ['section' => 'deliverys']))
        ->assertOk()
        ->assertDontSee("openReassignModal({$order->id})", false)
        ->assertSee('Assignment unavailable')
        ->assertSee("<strong>{$order->id}</strong>", false)
        ->assertDontSee("<strong>#ORD-{$order->id}</strong>", false);

    expect($order->fresh()->delivery_person_id)->toBe($currentDriver->id)
        ->and($order->fresh()->status)->toBe('delivered');
});

test('admin can assign a completed delivery order', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $driver = User::factory()->create(['role' => 'delivery_person']);
    $order = Order::create([
        'customer_name' => 'Completed Customer',
        'phone' => '0770000004',
        'address' => '5 Main Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'completed',
    ]);

    $this->actingAs($admin)
        ->post(route('admin.orders.assign-delivery', $order), [
            'delivery_person_id' => $driver->id,
        ])
        ->assertRedirect(route('admin.dashboard', ['section' => 'deliverys']))
        ->assertSessionHas('success', 'Order assigned to delivery person successfully.');

    expect($order->fresh()->delivery_person_id)->toBe($driver->id)
        ->and($order->fresh()->status)->toBe('assigned');

    $this->actingAs($driver)
        ->get(route('delivery.dashboard'))
        ->assertOk()
        ->assertSee('Mark as Delivered');
});

test('admin can assign and reassign a pending delivery order', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $currentDriver = User::factory()->create(['role' => 'delivery_person']);
    $newDriver = User::factory()->create(['role' => 'delivery_person']);
    $order = Order::create([
        'delivery_person_id' => $currentDriver->id,
        'customer_name' => 'Pending Customer',
        'phone' => '0770000003',
        'address' => '4 Main Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)
        ->put(route('admin.orders.reassign-delivery', $order), [
            'delivery_person_id' => $newDriver->id,
        ])
        ->assertRedirect(route('admin.dashboard', ['section' => 'deliverys']))
        ->assertSessionHas('success', 'Delivery assignment updated successfully.');

    expect($order->fresh()->delivery_person_id)->toBe($newDriver->id)
        ->and($order->fresh()->status)->toBe('assigned');
});

test('delivery dashboard is scoped to the logged in delivery person', function () {
    $driver = User::factory()->create(['role' => 'delivery_person']);
    $otherDriver = User::factory()->create(['role' => 'delivery_person']);

    $assignedOrder = Order::create([
        'delivery_person_id' => $driver->id,
        'customer_name' => 'Assigned Customer',
        'phone' => '0770000010',
        'address' => '1 Driver Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'assigned',
    ]);
    Order::create([
        'delivery_person_id' => $otherDriver->id,
        'customer_name' => 'Other Driver Customer',
        'phone' => '0770000011',
        'address' => '2 Driver Street',
        'city' => 'Colombo',
        'delivery_option' => 'Delivery',
        'product_name' => 'Cake',
        'cake_size' => 'Medium',
        'flavor' => 'Vanilla',
        'frosting' => 'Cream',
        'delivery_date' => now()->toDateString(),
        'total_price' => 1000,
        'status' => 'assigned',
    ]);

    $this->actingAs($driver)
        ->get(route('delivery.dashboard'))
        ->assertOk()
        ->assertViewHas('orders', fn ($orders) => $orders->pluck('id')->all() === [$assignedOrder->id]);

    $this->actingAs($driver)
        ->post(route('delivery.orders.status', $assignedOrder), ['status' => 'picked'])
        ->assertSessionHasErrors('status');

    expect($assignedOrder->fresh()->status)->toBe('assigned');

    $this->actingAs($driver)
        ->post(route('delivery.orders.status', $assignedOrder), ['status' => 'delivered'])
        ->assertRedirect();

    expect($assignedOrder->fresh()->status)->toBe('delivered');

    $this->actingAs($driver)
        ->post(route('delivery.orders.status', $assignedOrder), ['status' => 'delivered'])
        ->assertRedirect()
        ->assertSessionHas('error', 'This delivery is already closed.');

    expect($assignedOrder->fresh()->status)->toBe('delivered');

    $this->actingAs($driver)
        ->get(route('delivery.dashboard'))
        ->assertOk()
        ->assertSee('Delivery closed', false);

    $otherOrder = Order::where('delivery_person_id', $otherDriver->id)->firstOrFail();
    $this->actingAs($driver)
        ->post(route('delivery.orders.status', $otherOrder), ['status' => 'delivered'])
        ->assertForbidden();
});