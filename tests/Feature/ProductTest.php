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
        'status' => 'Active',
    ]);

    $this->actingAs($admin)
        ->put(route('products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Sourdough Updated',
            'description' => 'Fresh loaf updated',
            'price' => 13.50,
            'stock' => 9,
            'status' => 'Active',
        ])
        ->assertRedirect('/admin/dashboard')
        ->assertSessionHas('success', 'Product Updated Successfully ✨')
        ->assertSessionHas('activeSection', 'products');
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
        'status' => 'Active',
    ]);

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertSee("onclick='editProduct(", false)
        ->assertSee("document.getElementById('editProductForm').action = \"/products/\" + id;", false);
});
