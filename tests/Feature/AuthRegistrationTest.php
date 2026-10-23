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

test('customer cannot register with an invalid Sri Lankan mobile number', function () {
    $response = $this->from('/register')->post('/register', [
        'name' => 'Aneema Rajapaksha',
        'contact_number' => '1234567890',
        'email' => 'invalid-phone@gmail.com',
        'address' => '464/8 Pitipana South, Homagama',
        'city' => 'Colombo',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response
        ->assertRedirect('/register')
        ->assertSessionHasErrors('contact_number');

    $this->assertDatabaseMissing('users', ['email' => 'invalid-phone@gmail.com']);
});
