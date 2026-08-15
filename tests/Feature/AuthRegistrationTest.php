<?php

use App\Models\User;

test('customer can register successfully', function () {
    $response = $this->post('/register', [
        'name' => 'Aneema Rajapaksha',
        'contact_number' => '+94711489030',
        'email' => 'aneema@gmail.com',
        'address' => '464/8 Pitipana South, Homagama',
        'city' => 'Colombo',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response->assertRedirect('/customer/dashboard');
    $this->assertDatabaseHas('users', ['email' => 'aneema@gmail.com', 'role' => 'customer']);
    expect(auth()->check())->toBeTrue();
});
