<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Rules\SriLankaMobileNumber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    // ==========================================
    // SHOW CUSTOMER ORDERS
    // ==========================================

    public function index(Request $request)
    {
        $openOrderId = null;

        if ($notificationId = $request->query('notification')) {
            $notification = $request->user()->notifications()->whereKey($notificationId)->firstOrFail();
            $openOrderId = Order::where('user_id', $request->user()->id)
                ->whereKey(data_get($notification->data, 'order_id'))
                ->value('id');

            abort_if($openOrderId === null, 404);
            $notification->markAsRead();
        }

        $notifications = $request->user()->unreadNotifications()->latest()->limit(10)->get();

        $query = Order::where('user_id', auth()->id());

        $selectedStatus = $openOrderId ? 'all' : $request->query('status', 'all');

        if ($selectedStatus !== 'all') {
            $query->whereRaw(
                'LOWER(status) = ?',
                [strtolower($selectedStatus)]
            );
        }

        $orders = $query
            ->orderByDesc('created_at')
            ->get();

        return view(
            'customer.orders.index',
            compact('orders', 'selectedStatus', 'notifications', 'openOrderId')
        );
    }

    public function dismissNotification(Request $request, string $notificationId): RedirectResponse
    {
        $notification = $request->user()
            ->unreadNotifications()
            ->whereKey($notificationId)
            ->firstOrFail();

        $notification->markAsRead();

        return redirect()->route('customer.orders');
    }


    // ==========================================
    // CANCEL ORDER
    // ==========================================

    public function cancel(Order $order)
    {
        // Make sure the order belongs to logged-in customer
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Only pending orders can be cancelled
        if (strtolower($order->status) !== 'pending') {
            return redirect()
                ->route('customer.orders')
                ->with(
                    'error',
                    'Only pending orders can be cancelled.'
                );
        }

        $order->update([
            'status' => 'cancel',
        ]);

        return redirect()
            ->route('customer.orders')
            ->with(
                'success',
                    'Order cancelled successfully. We will contact you within 48 hours, and your full order amount will be refunded within 72 hours.'
            );
    }


    // ==========================================
    // STORE CUSTOM CAKE ORDER
    // ==========================================

    public function store(Request $request)
    {
        $isCustomCakeOrder = $request->routeIs('custom-cake.store');

        if ($request->filled('delivery_option')) {
            $request->merge([
                'delivery_option' => ucfirst(strtolower($request->delivery_option)),
            ]);
        }

        if ($request->filled('card_number')) {
            $request->merge([
                'card_number' => preg_replace('/\D/', '', $request->card_number),
            ]);
        }

        // ==========================================
        // BASIC VALIDATION
        // ==========================================

        $request->validate([

            'customer_name' =>
                'required|string|max:255',

            'phone' =>
                ['required', new SriLankaMobileNumber],

            'delivery_option' =>
                'required|in:Delivery,Pickup',

            'delivery_date' =>
                'required|date|after_or_equal:' . now()->addDays(2)->toDateString(),

            'design_image' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'transaction_id' =>
                'nullable|string|max:100',

            'payment_method' =>
                'nullable|in:Card,Bank Transfer',

            'card_type' =>
                'nullable|in:Visa,Mastercard,Amex',

            'card_number' =>
                'nullable|digits_between:13,19',

            'cvv' =>
                'nullable|digits_between:3,4',
        ]);

        $validatedCartItems = [];
        if (!$isCustomCakeOrder) {
            $request->validate([
                'cart_items' => ['required', 'json'],
            ]);

            $validatedCartItems = Validator::make(
                ['items' => json_decode($request->input('cart_items'), true)],
                [
                    'items' => ['required', 'array', 'min:1'],
                    'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
                    'items.*.quantity' => ['required', 'integer', 'min:1', 'max:1000'],
                ]
            )->validate()['items'];
        }

        $ordersForDate = Order::whereDate('delivery_date', $request->delivery_date)
            ->whereRaw("LOWER(status) NOT IN ('cancel', 'cancelled')")
            ->count();

        if ($ordersForDate >= 3) {
            return back()
                ->withErrors([
                    'delivery_date' => 'This delivery date is fully booked. Please choose another date.',
                ])
                ->withInput();
        }

        if ($request->payment_method === 'Card') {
            $request->validate([
                'card_type' => 'required|in:Visa,Mastercard,Amex',
                'card_number' => 'required|digits_between:13,19',
                'cvv' => 'required|digits_between:3,4',
            ]);
        } elseif ($request->payment_method === 'Bank Transfer') {
            $request->validate([
                'transaction_id' => 'required|string|max:100',
            ]);
        }


        // ==========================================
        // DELIVERY OPTION
        // ==========================================

        $deliveryOption = strtolower(
            $request->delivery_option
        );


        // ==========================================
        // IMAGE UPLOAD
        // ==========================================

        $imagePath = null;

        if ($request->hasFile('design_image')) {

            $imagePath = $request
                ->file('design_image')
                ->store(
                    'custom-cakes',
                    'public'
                );
        }


        // ==========================================
        // DELIVERY VALIDATION
        // ==========================================

        $deliveryCity = null;

        if ($deliveryOption === 'delivery') {

            $request->validate([

                'address' =>
                    'required|string|max:500',

                'latitude' =>
                    'required|numeric',

                'longitude' =>
                    'required|numeric',

            ]);


            // Find delivery area using coordinates
            $deliveryCity = $this->findDeliveryArea(
                $request->latitude,
                $request->longitude
            );


            // ==========================================
            // LOCATION OUTSIDE DELIVERY AREA
            // ==========================================

            if (!$deliveryCity) {

                return back()
                    ->withErrors([
                        'city' =>
                            'Sorry, delivery is available only in Homagama, Kottawa, Maharagama, and Godagama.'
                    ])
                    ->withInput();
            }

            $addressArea = $this->findAddressArea($request->address);

            if ($addressArea && strcasecmp($addressArea, $deliveryCity) !== 0) {
                return back()
                    ->withErrors([
                        'address' => "The address mentions {$addressArea}, but the selected delivery area is {$deliveryCity}. Please correct the address or choose the matching area.",
                    ])
                    ->withInput();
            }
        }


        // ==========================================
        // ADDRESS AND CITY
        // ==========================================

        $address = $request->address;

        if ($deliveryOption === 'pickup') {

            $address = $address
                ?: ($request->pickup_address
                    ?? 'Pickup from bakery');

            $city = $request->city
                ?: ($request->pickup_city
                    ?? 'Bakery Location');

        } else {

            // IMPORTANT:
            // City is determined from coordinates
            $city = $deliveryCity;
        }


        // ==========================================
        // CREATE ORDER
        // ==========================================

        $advanceAmount = $isCustomCakeOrder ? 1500 : null;
        $cardNumber = preg_replace('/\D/', '', (string) $request->card_number);

        $orderAttributes = [

            'user_id' =>
                auth()->id(),

            'product_name' =>
                $request->product_name ?? 'Custom Cake',

            'customer_name' =>
                $request->customer_name,

            'phone' =>
                $request->phone,

            'address' =>
                $address,

            'city' =>
                $city,

            'cake_size' =>
                $request->cake_size,

            'flavor' =>
                $request->flavor,

            'frosting' =>
                $request->frosting,

            'cake_message' =>
                $request->cake_message,

            'special_notes' =>
                $request->special_notes,

            'delivery_date' =>
                $request->delivery_date,

            'delivery_option' =>
                $deliveryOption === 'pickup'
                    ? 'Pickup'
                    : 'Delivery',

            // Save coordinates for delivery
            'latitude' =>
                $deliveryOption === 'delivery'
                    ? $request->latitude
                    : null,

            'longitude' =>
                $deliveryOption === 'delivery'
                    ? $request->longitude
                    : null,

            'design_image' =>
                $imagePath,

            'total_price' =>
                $request->total_price ?? 0,

            'advance_amount' =>
                $advanceAmount,

            'transaction_id' =>
                $request->transaction_id,

            'payment_method' =>
                $request->payment_method,

            'card_type' =>
                $request->card_type,

            'card_last_four' =>
                $cardNumber !== '' ? substr($cardNumber, -4) : null,

            'status' =>
                strtolower(
                    $request->status ?? 'pending'
                ),
        ];

        DB::transaction(function () use ($isCustomCakeOrder, $validatedCartItems, $orderAttributes) {
            if (!$isCustomCakeOrder) {
                $productIds = collect($validatedCartItems)
                    ->pluck('product_id')
                    ->map(fn ($productId) => (int) $productId)
                    ->all();
                $products = Product::query()
                    ->whereIn('id', $productIds)
                    ->orderBy('id')
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');
                $orderedProducts = [];

                foreach ($validatedCartItems as $cartItem) {
                    $product = $products->get((int) $cartItem['product_id']);
                    $quantity = (int) $cartItem['quantity'];

                    if (!$product || $product->status !== 'Active') {
                        throw ValidationException::withMessages([
                            'cart_items' => 'One or more products are no longer available. Please refresh the menu.',
                        ]);
                    }

                    if ((int) $product->stock < $quantity) {
                        throw ValidationException::withMessages([
                            'cart_items' => "Only {$product->stock} of {$product->name} remain in stock.",
                        ]);
                    }

                    $product->decrement('stock', $quantity);
                    $orderedProducts[] = "{$product->name} x{$quantity}";
                }

                $orderAttributes['product_name'] = implode(', ', $orderedProducts);
            }

            Order::create($orderAttributes);
        });


        // ==========================================
        // SUCCESS
        // ==========================================

        return redirect()
            ->back()
            ->with(
                'success',
                $isCustomCakeOrder
                    ? 'Custom cake order submitted successfully. Our staff will contact you within 24 hours to confirm your order details.'
                    : 'Order submitted successfully.'
            );
    }


    // ==========================================
    // CALCULATE DISTANCE
    // HAVERSINE FORMULA
    // ==========================================

    private function calculateDistance(
        $lat1,
        $lon1,
        $lat2,
        $lon2
    ) {
        $earthRadius = 6371000; // meters

        // Convert degrees to radians
        $lat1Rad = deg2rad($lat1);
        $lat2Rad = deg2rad($lat2);

        $deltaLat = deg2rad(
            $lat2 - $lat1
        );

        $deltaLon = deg2rad(
            $lon2 - $lon1
        );


        $a =
            sin($deltaLat / 2) *
            sin($deltaLat / 2) +

            cos($lat1Rad) *
            cos($lat2Rad) *

            sin($deltaLon / 2) *
            sin($deltaLon / 2);


        $c =
            2 *
            atan2(
                sqrt($a),
                sqrt(1 - $a)
            );


        return $earthRadius * $c;
    }


    // ==========================================
    // FIND DELIVERY AREA
    // ==========================================

    private function findDeliveryArea(
        $latitude,
        $longitude
    ) {

        $areas = [

            'Homagama' => [
                'lat' => 6.8449,
                'lng' => 80.0024,
                'radius' => 5000
            ],

            'Kottawa' => [
                'lat' => 6.7733,
                'lng' => 79.9553,
                'radius' => 5000
            ],

            'Maharagama' => [
                'lat' => 6.8480,
                'lng' => 79.9265,
                'radius' => 5000
            ],

            'Godagama' => [
                'lat' => 6.8369,
                'lng' => 80.0328,
                'radius' => 4000
            ]

        ];


        // Check each delivery area
        foreach ($areas as $city => $area) {

            $distance = $this->calculateDistance(

                $latitude,
                $longitude,

                $area['lat'],
                $area['lng']

            );


            // Location is inside delivery radius
            if ($distance <= $area['radius']) {

                return $city;
            }
        }


        // Location is outside all delivery areas
        return null;
    }

    private function findAddressArea(?string $address): ?string
    {
        if (!$address) {
            return null;
        }

        $knownAreas = [
            'Homagama', 'Kurunegala', 'Kaduwela',
            'Kottawa', 'Anuradhapura', 'Gampaha',
            'Maharagama', 'Galle', 'Matara',
            'Godagama', 'Avissawella',
            'Colombo', 'Udugampola', 'Nittambuwa',
            'Dehiwala', 'Moratuwa', 'Panadura',
            'Nugegoda', 'Uduwana', 'Battaramulla',
            'Piliyandala', 'Gampaha', 'Wattala', 
            'Malabe', 'Ragama', 'Kiribathgoda',
            'Athurugiriya', 'Malabe', 'Mawanella', 'Pannipitiya',
            'Padukka', 'Maradana', 'Kadawatha', 'Kelaniya',
            'Kaduwela', 'Borella', 'Narahenpita', 'Wellampitiya',
            'Kotte', 'Rajagiriya', 'Thalawathugoda',
            'Kahathuduwa',      
        ];

        foreach ($knownAreas as $area) {
            if (preg_match('/\b' . preg_quote($area, '/') . '\b/i', $address)) {
                return $area;
            }
        }

        return null;
    }
}