<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeliveryPersonDashboardController extends Controller
{
    private const CITY_COORDINATES = [
        'homagama' => [6.8449, 80.0024],
        'kottawa' => [6.7733, 79.9553],
        'maharagama' => [6.8480, 79.9265],
        'godagama' => [6.8369, 80.0328],
    ];

    public function index(): View
    {
        $orders = Order::query()
            ->where('delivery_person_id', auth()->id())
            ->whereRaw("LOWER(COALESCE(delivery_option, '')) = ?", ['delivery'])
            ->orderBy('delivery_date')
            ->orderByDesc('created_at')
            ->get();

        $dashboardOrders = $orders->map(function (Order $order) {
            $cityCoordinates = self::CITY_COORDINATES[strtolower(trim((string) $order->city))] ?? null;
            $hasExactLocation = is_numeric($order->latitude) && is_numeric($order->longitude);

            return [
                'id' => $order->id,
                'customer' => $order->customer_name,
                'phone' => $order->phone,
                'address' => $order->address,
                'lat' => $hasExactLocation ? (float) $order->latitude : ($cityCoordinates[0] ?? null),
                'lng' => $hasExactLocation ? (float) $order->longitude : ($cityCoordinates[1] ?? null),
                'locationLabel' => $hasExactLocation ? 'Exact delivery location' : 'Approximate city location',
                'size' => $order->cake_size,
                'flavor' => $order->flavor,
                'frosting' => $order->frosting,
                'message' => $order->cake_message,
                'status' => strtolower($order->status ?? 'assigned'),
                'deliveryDate' => $order->delivery_date,
                'notes' => $order->delivery_notes ?? $order->special_notes,
            ];
        })->values()->all();

        return view('admin.delivery-persons.delivery_dashboard', compact('orders', 'dashboardOrders'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        abort_unless($order->delivery_person_id === auth()->id(), 403);

        $validated = $request->validate([
            'status' => ['required', 'in:delivered'],
        ]);

        if (in_array(strtolower((string) $order->status), ['delivered', 'failed'], true)) {
            return back()->with('error', 'This delivery is already closed.');
        }

        $order->update(['status' => $validated['status']]);

        return back()->with('success', "Order #{$order->id} status updated.");
    }
}
