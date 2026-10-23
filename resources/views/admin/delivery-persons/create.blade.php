<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Delivery Person') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.delivery-persons.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="contact_number" :value="__('Phone Number')" />
                            <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="old('contact_number')" autocomplete="tel" />
                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autocomplete="street-address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" autocomplete="address-level2" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="nic" :value="__('NIC / ID Number')" />
                            <x-text-input id="nic" class="block mt-1 w-full" type="text" name="nic" :value="old('nic')" />
                            <x-input-error :messages="$errors->get('nic')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="vehicle_type" :value="__('Vehicle Type')" />
                            <x-text-input id="vehicle_type" class="block mt-1 w-full" type="text" name="vehicle_type" :value="old('vehicle_type')" />
                            <x-input-error :messages="$errors->get('vehicle_type')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="photo" :value="__('Profile Photo')" />
                            <input id="photo" class="block mt-1 w-full" type="file" name="photo" accept="image/*" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <div class="relative mt-1">
                                <x-text-input id="password" class="block w-full pr-10" type="password" name="password" required autocomplete="new-password" />
                                <button type="button" class="absolute inset-y-0 right-0 px-3 text-gray-500" onclick="togglePassword('password', this)" aria-label="Show password">Show</button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <div class="relative mt-1">
                                <x-text-input id="password_confirmation" class="block w-full pr-10" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <button type="button" class="absolute inset-y-0 right-0 px-3 text-gray-500" onclick="togglePassword('password_confirmation', this)" aria-label="Show password">Show</button>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('admin.delivery-persons.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                {{ __('Back') }}
                            </a>
                            <x-primary-button>
                                {{ __('Create Delivery Person') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword(id, button) {
            const input = document.getElementById(id);
            const visible = input.type === 'text';
            input.type = visible ? 'password' : 'text';
            button.textContent = visible ? 'Show' : 'Hide';
            button.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');
        }
    </script>
</x-app-layout>
