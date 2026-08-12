<?php

use App\Models\Category;
use App\Models\Product;
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

test('customer products page loads categories and products from the database', function () {
    $category = Category::create([
        'name' => 'Cakes',
        'description' => 'Fresh cakes',
    ]);

    Product::create([
        'category_id' => $category->id,
        'name' => 'Chocolate Cake',
        'description' => 'Moist chocolate cake',
        'price' => 3500,
        'stock' => 10,
        'image' => 'cake.jpg',
        'status' => 'Active',
    ]);

    $this->get('/custom-products')
        ->assertOk()
        ->assertSee('Cakes')
        ->assertSee('Chocolate Cake');
});
