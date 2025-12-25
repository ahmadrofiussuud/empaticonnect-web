<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Beneficiary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('beneficiaries.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" name="name" id="name" required 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Disability Type -->
                        <div class="mb-4">
                            <label for="disability_type" class="block text-sm font-medium text-gray-700 mb-2">Disability Type *</label>
                            <input type="text" name="disability_type" id="disability_type" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                placeholder="e.g., Mobility Impairment, Visual Impairment"
                                value="{{ old('disability_type') }}">
                            @error('disability_type')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Emergency Contact -->
                        <div class="mb-4">
                            <label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact *</label>
                            <input type="text" name="emergency_contact" id="emergency_contact" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                placeholder="e.g., 081234567890"
                                value="{{ old('emergency_contact') }}">
                            @error('emergency_contact')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="4"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                placeholder="Any special notes or requirements...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-4 rounded">
                                Save Beneficiary
                            </button>
                            <a href="{{ route('beneficiaries.index') }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
