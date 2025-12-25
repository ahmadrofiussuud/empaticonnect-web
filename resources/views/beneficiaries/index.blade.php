<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Beneficiaries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('beneficiaries.create') }}" class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Beneficiary
                </a>
            </div>

            @if($beneficiaries->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($beneficiaries as $beneficiary)
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $beneficiary->name }}</h3>
                                    <span class="bg-primary-light text-primary-dark text-xs px-2 py-1 rounded-full">
                                        {{ $beneficiary->bookings_count }} bookings
                                    </span>
                                </div>
                                <div class="space-y-2 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-600">Kondisi</p>
                                        <p class="text-sm font-medium">{{ $beneficiary->disability_type }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">Kontak Darurat</p>
                                        <p class="text-sm font-medium">{{ $beneficiary->emergency_contact }}</p>
                                    </div>
                                    @if($beneficiary->notes)
                                    <div>
                                        <p class="text-xs text-gray-600">Catatan</p>
                                        <p class="text-sm">{{ Str::limit($beneficiary->notes, 50) }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('beneficiaries.show', $beneficiary->id) }}" class="flex-1 text-center bg-primary hover:bg-primary-dark text-white py-2 px-4 rounded text-sm">
                                        View
                                    </a>
                                    <a href="{{ route('beneficiaries.edit', $beneficiary->id) }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded text-sm">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Beneficiaries Yet</h3>
                        <p class="text-gray-600 mb-4">Start by adding your first beneficiary</p>
                        <a href="{{ route('beneficiaries.create') }}" class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded inline-block">
                            Add Beneficiary
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
