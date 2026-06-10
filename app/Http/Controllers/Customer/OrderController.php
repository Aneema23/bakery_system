<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('design_image')) {
            $imagePath = $request->file('design_image')
                ->store('custom-cakes', 'public');
        }

        Order::create([
            'user_id' => auth()->id(),

            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,

            'cake_size' => $request->cake_size,
            'flavor' => $request->flavor,
            'frosting' => $request->frosting,

            'cake_message' => $request->cake_message,
            'special_notes' => $request->special_notes,

            'delivery_date' => $request->delivery_date,

            'design_image' => $imagePath,

            'total_price' => $request->total_price,

            'status' => 'Pending'
        ]);

        return redirect()
            ->back()
            ->with('success', 'Custom cake order submitted successfully.');
    }
}