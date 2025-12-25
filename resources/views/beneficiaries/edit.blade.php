<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Beneficiary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('beneficiaries.update', $beneficiary->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" name="name" id="name" required 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                value="{{ old('name', $beneficiary->name) }}">
                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="disability_type" class="block text-sm font-medium text-gray-700 mb-2">Disability Type *</label>
                            <input type="text" name="disability_type" id="disability_type" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                value="{{ old('disability_type', $beneficiary->disability_type) }}">
                            @error('disability_type')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact *</label>
                            <input type="text" name="emergency_contact" id="emergency_contact" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                value="{{ old('emergency_contact', $beneficiary->emergency_contact) }}">
                            @error('emergency_contact')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="4"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('notes', $beneficiary->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-4 rounded">
                                Update Beneficiary
                            </button>
                            <a href="{{ route('beneficiaries.show', $beneficiary->id) }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
