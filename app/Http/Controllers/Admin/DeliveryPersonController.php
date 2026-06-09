<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class DeliveryPersonController extends Controller
{
    /**
     * Display a listing of delivery persons.
     */
    public function index(): View
    {
        $deliveryPersons = User::where('role', 'delivery_person')->paginate(10);
        return view('admin.delivery-persons.index', compact('deliveryPersons'));
    }

    /**
     * Show the form for creating a new delivery person.
     */
    public function create(): View
    {
        return view('admin.delivery-persons.create');
    }

    /**
     * Store a newly created delivery person in database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'delivery_person',
        ]);

        return redirect(route('admin.delivery-persons.index'))
            ->with('success', 'Delivery person created successfully.');
    }

    /**
     * Show the form for editing the specified delivery person.
     */
    public function edit(User $deliveryPerson): View
    {
        if ($deliveryPerson->role !== 'delivery_person') {
            abort(404);
        }
        return view('admin.delivery-persons.edit', compact('deliveryPerson'));
    }

    /**
     * Update the specified delivery person in database.
     */
    public function update(Request $request, User $deliveryPerson): RedirectResponse
    {
        if ($deliveryPerson->role !== 'delivery_person') {
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$deliveryPerson->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $deliveryPerson->name = $request->name;
        $deliveryPerson->email = $request->email;
        if ($request->filled('password')) {
            $deliveryPerson->password = Hash::make($request->password);
        }
        $deliveryPerson->save();

        return redirect(route('admin.delivery-persons.index'))
            ->with('success', 'Delivery person updated successfully.');
    }

    /**
     * Remove the specified delivery person from database.
     */
    public function destroy(User $deliveryPerson): RedirectResponse
    {
        if ($deliveryPerson->role !== 'delivery_person') {
            abort(404);
        }

        $deliveryPerson->delete();

        return redirect(route('admin.delivery-persons.index'))
            ->with('success', 'Delivery person deleted successfully.');
    }
}
