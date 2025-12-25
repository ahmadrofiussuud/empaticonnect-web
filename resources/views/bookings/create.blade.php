<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book a Helper') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <p class="text-gray-600 mb-6">Create a new booking for your beneficiary</p>

                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="beneficiary_id" class="block text-sm font-medium text-gray-700 mb-2">Select Beneficiary *</label>
                            <select name="beneficiary_id" id="beneficiary_id" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                <option value="">-- Choose Beneficiary --</option>
                                @foreach($beneficiaries as $beneficiary)
                                    <option value="{{ $beneficiary->id }}">{{ $beneficiary->name }} ({{ $beneficiary->disability_type }})</option>
                                @endforeach
                            </select>
                            @error('beneficiary_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="helper_id" class="block text-sm font-medium text-gray-700 mb-2">Select Helper *</label>
                            <p class="text-sm text-gray-500 mb-2">For now, use helper@test.com (ID: 2) or helper2@test.com (ID: 3)</p>
                            <input type="number" name="helper_id" id="helper_id" required min="1"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                placeholder="Enter Helper ID">
                            @error('helper_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="scheduled_time" class="block text-sm font-medium text-gray-700 mb-2">Scheduled Time *</label>
                            <input type="datetime-local" name="scheduled_time" id="scheduled_time" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            @error('scheduled_time')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="location_start" class="block text-sm font-medium text-gray-700 mb-2">Pickup Location *</label>
                            <input type="text" name="location_start" id="location_start" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                placeholder="e.g., Jl. Merdeka No. 123, Jakarta">
                            @error('location_start')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="location_end" class="block text-sm font-medium text-gray-700 mb-2">Destination (Optional)</label>
                            <input type="text" name="location_end" id="location_end"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                placeholder="e.g., RS. Bethesda, Jakarta">
                            @error('location_end')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                placeholder="Any special requirements or notes..."></textarea>
                            @error('notes')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-4 rounded">
                                Create Booking
                            </button>
                            <a href="{{ route('dashboard') }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
