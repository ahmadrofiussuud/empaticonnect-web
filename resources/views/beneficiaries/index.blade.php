@extends('layouts.dashboard')

@section('content')
    <!-- Hero Section: Beneficiaries -->
    <div class="relative overflow-hidden flex items-center justify-center bg-gray-900" style="min-height: 50vh;">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=2000" 
                 alt="Beneficiaries Background" 
                 class="w-full h-full object-cover opacity-60"
                 onerror="this.style.display='none'">
            <!-- Dark Overlay for text readability -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/80 to-indigo-900/90 mix-blend-multiply"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 tracking-tight">
                Your Loved Ones
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto font-light leading-relaxed">
                Manage profiles and care details for the people who matter most.
            </p>
        </div>
    </div>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto -mt-16 relative z-10">
        <div class="mb-10 flex items-center justify-end">
            <a href="{{ route('beneficiaries.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg inline-flex items-center shadow-lg transition transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Beneficiary
            </a>
        </div>

        @if($beneficiaries->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($beneficiaries as $beneficiary)
                    <div class="bg-white overflow-hidden shadow-md rounded-2xl hover:shadow-lg transition">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-lg font-bold text-gray-900">{{ $beneficiary->name }}</h3>
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-medium">
                                    {{ $beneficiary->bookings_count }} trips
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
                                <a href="{{ route('beneficiaries.show', $beneficiary->id) }}" class="flex-1 text-center bg-blue-900 hover:bg-blue-800 text-white py-2 px-4 rounded-lg text-sm font-medium">
                                    View
                                </a>
                                <a href="{{ route('beneficiaries.edit', $beneficiary->id) }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg text-sm font-medium">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-md rounded-2xl">
                <div class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Beneficiaries Yet</h3>
                    <p class="text-gray-600 mb-4">Start by adding your first beneficiary</p>
                    <a href="{{ route('beneficiaries.create') }}" class="bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 px-6 rounded-lg inline-block">
                        Add Beneficiary
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
