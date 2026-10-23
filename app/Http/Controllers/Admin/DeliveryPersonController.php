<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\SriLankaMobileNumber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'contact_number' => ['nullable', new SriLankaMobileNumber],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'nic' => ['nullable', 'string', 'max:50'],
            'vehicle_type' => ['nullable', 'string', 'max:50'],
            'status' => ['sometimes', 'in:Active,Inactive'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.dashboard', ['section' => 'delivery_person'])
                ->withErrors($validator, 'deliveryPerson')
                ->withInput()
                ->with('activeSection', 'delivery_person');
        }

        $deliveryPerson = User::create([
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'city' => $request->city,
            'nic' => $request->nic,
            'vehicle_type' => $request->vehicle_type,
            'status' => $request->input('status', 'Active'),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'delivery_person',
        ]);

        if ($request->hasFile('photo')) {
            $deliveryPerson->update(['photo' => $request->file('photo')->store('delivery-persons', 'public')]);
        }

        return redirect()->route('admin.dashboard', ['section' => 'delivery_person'])
            ->with('activeSection', 'delivery_person')
            ->with('success', 'Delivery person added successfully.');
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
            'contact_number' => ['nullable', new SriLankaMobileNumber],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'nic' => ['nullable', 'string', 'max:50'],
            'vehicle_type' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:Active,Inactive'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$deliveryPerson->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $deliveryPerson->fill($request->only([
            'name', 'contact_number', 'address', 'city', 'nic', 'vehicle_type', 'status', 'email',
        ]));
        if ($request->filled('password')) {
            $deliveryPerson->password = Hash::make($request->password);
        }
        if ($request->hasFile('photo')) {
            $deliveryPerson->photo = $request->file('photo')->store('delivery-persons', 'public');
        }
        $deliveryPerson->save();

        return redirect()->route('admin.dashboard', ['section' => 'delivery_person'])
            ->with('activeSection', 'delivery_person')
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

        return redirect()->route('admin.dashboard', ['section' => 'delivery_person'])
            ->with('activeSection', 'delivery_person')
            ->with('success', 'Delivery person deleted successfully.');
    }
}
