<?php

use App\Models\User;

test('category creation shows a success message on the admin dashboard', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->actingAs($admin)
        ->post('/categories', [
            'name' => 'Cakes',
            'description' => 'Sweet treats',
        ])
        ->assertRedirect('/admin/dashboard')
        ->assertSessionHas('success', 'Category Added Successfully');

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertSee('Category Added Successfully');
});
