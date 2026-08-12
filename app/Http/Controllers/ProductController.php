<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'nullable|integer|min:0',
            'status' => 'required|in:Active,Inactive',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:2048',
        ]);

        $validated['image'] = $this->resolveImage($request);
        unset($validated['image_url']);

        Product::create($validated);

        return redirect()->route('admin.dashboard')
        ->with('success', 'Product Added Successfully ✨')
        ->with('activeSection', 'products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'nullable|integer|min:0',
            'status' => 'required|in:Active,Inactive',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $image = $this->resolveImage($request);
        if ($image) {
            $validated['image'] = $image;
        } else {
            unset($validated['image']);
        }
        unset($validated['image_url']);

        $product->update($validated);

        return redirect()->route('admin.dashboard')
            ->with('success','Product Updated Successfully ✨')
            ->with('activeSection','products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Product Deleted Successfully 🗑️')
            ->with('activeSection', 'products');
    }

    private function resolveImage(Request $request): ?string
    {
        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return $request->hasFile('image')
            ? $request->file('image')->store('products', 'public')
            : null;
    }
}
