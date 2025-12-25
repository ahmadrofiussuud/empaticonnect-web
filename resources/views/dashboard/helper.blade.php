<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Helper
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Stats -->
            @if($helperProfile)
            <div class="px-4 sm:px-0 mb-6">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-2xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name }}</h3>
                    <p class="text-orange-100 text-sm mb-4">Siap membantu hari ini</p>
                    
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center">
                            <div class="text-2xl font-bold">{{ $completedCount }}</div>
                            <div class="text-xs text-orange-100">Completed</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center">
                            <div class="text-xl font-bold">{{ number_format($totalEarnings / 1000, 0) }}K</div>
                            <div class="text-xs text-orange-100">Earnings</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center">
                            <div class="text-2xl font-bold">{{ $pendingBookings->count() }}</div>
                            <div class="text-xs text-orange-100">Requests</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Active Job Card -->
            @if($activeBooking)
            <div class="px-4 sm:px-0 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">🚀 Job Aktif</h3>
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="text-xl font-bold">{{ $activeBooking->beneficiary->name }}</h4>
                            <p class="text-green-100 text-sm">{{ $activeBooking->beneficiary->disability_type }}</p>
                        </div>
                        <span class="bg-white/30 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold">
                            {{ ucfirst($activeBooking->status) }}
                        </span>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-4 space-y-2">
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $activeBooking->scheduled_time->format('d M Y, H:i') }}
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Guardian: {{ $activeBooking->guardian->name }}
                        </div>
                        <div class="flex items-start text-sm">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            <span>{{ $activeBooking->location_start }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        @if($activeBooking->status == 'confirmed')
                            <form action="{{ route('bookings.checkIn', $activeBooking->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-white hover:bg-gray-100 text-green-600 font-bold py-3 px-4 rounded-xl shadow-lg">
                                    ✓ Check In
                                </button>
                            </form>
                        @elseif($activeBooking->status == 'in_progress')
                            <form action="{{ route('bookings.checkOut', $activeBooking->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-white hover:bg-gray-100 text-green-600 font-bold py-3 px-4 rounded-xl shadow-lg">
                                    ✓ Check Out
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('bookings.sos', $activeBooking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg">
                                🚨 SOS
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <!-- Pending Job Requests -->
            <div class="px-4 sm:px-0 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Permintaan Job</h3>
                    @if($pendingBookings->count() > 0)
                        <span class="bg-orange-100 text-orange-600 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $pendingBookings->count() }} Baru
                        </span>
                    @endif
                </div>

                @if($pendingBookings->count() > 0)
                    <div class="space-y-3">
                        @foreach($pendingBookings as $booking)
                            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-4">
                                <div class="flex items-start gap-4 mb-4">
                                    <!-- Guardian Avatar -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-900 to-blue-800 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ substr($booking->guardian->name, 0, 1) }}
                                        </div>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h4 class="font-bold text-gray-900">{{ $booking->beneficiary->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $booking->beneficiary->disability_type }}</p>
                                                <p class="text-xs text-gray-500 mt-1">by {{ $booking->guardian->name }}</p>
                                            </div>
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded-full">
                                                Pending
                                            </span>
                                        </div>
                                        
                                        <div class="space-y-1 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $booking->scheduled_time->format('d M Y, H:i') }}
                                            </div>
                                            <div class="flex items-start">
                                                <svg class="w-4 h-4 mr-1 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                </svg>
                                                <span class="truncate">{{ $booking->location_start }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-2">
                                    <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-xl">
                                            ✓ Terima Job
                                        </button>
                                    </form>
                                    <a href="{{ route('bookings.show', $booking->id) }}" 
                                       class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2.5 rounded-xl">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Belum Ada Permintaan</h4>
                        <p class="text-sm text-gray-600">Job requests akan muncul di sini</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
