<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Delivery Persons') }}
            </h2>
            <a href="{{ route('admin.delivery-persons.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                {{ __('Add Delivery Person') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($deliveryPersons->count())
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="px-6 py-3 text-left text-sm font-medium">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium">{{ __('Email') }}</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium">{{ __('Created At') }}</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deliveryPersons as $person)
                                        <tr class="border-t border-gray-200 dark:border-gray-700">
                                            <td class="px-6 py-4">{{ $person->name }}</td>
                                            <td class="px-6 py-4">{{ $person->email }}</td>
                                            <td class="px-6 py-4">{{ $person->created_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('admin.delivery-persons.edit', $person) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form method="POST" action="{{ route('admin.delivery-persons.destroy', $person) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            {{ $deliveryPersons->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No delivery persons found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
