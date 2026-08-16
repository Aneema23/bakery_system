<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('user_id', auth()->id());

        $selectedStatus = $request->query('status', 'all');

        if ($selectedStatus !== 'all') {
            $query->whereRaw('LOWER(status) = ?', [strtolower($selectedStatus)]);
        }

        $orders = $query->orderByDesc('created_at')->get();

        return view('customer.orders.index', compact('orders', 'selectedStatus'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (strtolower($order->status) !== 'pending') {
            return redirect()->route('customer.orders')->with('error', 'Only pending orders can be cancelled.');
        }

        $order->update([
            'status' => 'cancel',
        ]);

        return redirect()->route('customer.orders')->with('success', 'Order cancelled successfully.');
    }

    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('design_image')) {
            $imagePath = $request->file('design_image')
                ->store('custom-cakes', 'public');
        }

        $deliveryOption = strtolower($request->delivery_option ?? 'delivery');
        $address = $request->address;
        $city = $request->city;

        if ($deliveryOption === 'pickup') {
            $address = $address ?: ($request->pickup_address ?? 'Pickup from bakery');
            $city = $city ?: ($request->pickup_city ?? 'Bakery Location');
        }

        Order::create([
            'user_id' => auth()->id(),
            'product_name' => $request->product_name ?? 'Custom Cake',
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $address,
            'city' => $city,
            'postal_code' => $request->postal_code,

            'cake_size' => $request->cake_size,
            'flavor' => $request->flavor,
            'frosting' => $request->frosting,

            'cake_message' => $request->cake_message,
            'special_notes' => $request->special_notes,

            'delivery_date' => $request->delivery_date,
            'delivery_option' => $deliveryOption === 'pickup' ? 'Pickup' : 'Delivery',

            'design_image' => $imagePath,
            'total_price' => $request->total_price ?? 0,
            'status' => strtolower($request->status ?? 'pending'),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Custom cake order submitted successfully.');
    }
}