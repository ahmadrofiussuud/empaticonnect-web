<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 -mx-8 -mt-6 px-8 pt-6 pb-8">
            <h2 class="font-bold text-2xl text-white">
                Halo, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-blue-200 text-sm mt-1">Selamat datang di EmpatiConnect</p>
        </div>
    </x-slot>

    <div class="pb-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Quick Actions - Mobile Optimized -->
            <div class="px-4 sm:px-0 -mt-6 mb-6">
                <div class="grid grid-cols-3 gap-3">
                    <a href="{{ route('beneficiaries.create') }}" 
                       class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition flex flex-col items-center justify-center text-center">
                        <div class="bg-gradient-to-br from-orange-400 to-orange-500 text-white rounded-full p-3 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Tambah</span>
                    </a>

                    <a href="{{ route('bookings.create') }}" 
                       class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-xl shadow-md p-4 hover:shadow-lg transition flex flex-col items-center justify-center text-center">
                        <div class="bg-white/20 backdrop-blur-sm text-white rounded-full p-3 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-white">Book Helper</span>
                    </a>

                    <a href="{{ route('beneficiaries.index') }}" 
                       class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition flex flex-col items-center justify-center text-center">
                        <div class="bg-gradient-to-br from-gray-600 to-gray-700 text-white rounded-full p-3 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700">Kelola</span>
                    </a>
                </div>
            </div>

            <!-- Beneficiaries Section -->
            <div class="px-4 sm:px-0 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Beneficiaries Saya</h3>
                    @if($beneficiaries->count() > 0)
                        <a href="{{ route('beneficiaries.index') }}" class="text-sm text-blue-900 font-medium">Lihat Semua →</a>
                    @endif
                </div>

                @if($beneficiaries->count() > 0)
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($beneficiaries->take(4) as $beneficiary)
                            <a href="{{ route('beneficiaries.show', $beneficiary->id) }}" 
                               class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">
                                <div class="bg-gradient-to-br from-blue-900 to-blue-800 p-6 flex items-center justify-center">
                                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                        <span class="text-3xl">👤</span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-gray-900 text-sm mb-1 truncate">{{ $beneficiary->name }}</h4>
                                    <p class="text-xs text-gray-600 mb-2 truncate">{{ $beneficiary->disability_type }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs bg-blue-50 text-blue-900 px-2 py-1 rounded-full font-medium">
                                            {{ $beneficiary->bookings_count }} trips
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Belum Ada Beneficiary</h4>
                        <p class="text-sm text-gray-600 mb-4">Daftarkan orang terkasih Anda</p>
                        <a href="{{ route('beneficiaries.create') }}" 
                           class="inline-block bg-blue-900 hover:bg-blue-800 text-white font-medium py-2 px-6 rounded-xl">
                            Tambah Sekarang
                        </a>
                    </div>
                @endif
            </div>

            <!-- Active Bookings -->
            @if($activeBookings->count() > 0)
            <div class="px-4 sm:px-0 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Booking Aktif</h3>
                <div class="space-y-3">
                    @foreach($activeBookings as $booking)
                        <a href="{{ route('bookings.show', $booking->id) }}" 
                           class="block bg-white rounded-2xl shadow-sm hover:shadow-md transition p-4">
                            <div class="flex items-start gap-4">
                                <!-- Helper Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="w-14 h-14 bg-gradient-to-br from-blue-900 to-blue-800 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($booking->helper->name, 0, 1) }}
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $booking->beneficiary->name }}</h4>
                                            <p class="text-sm text-gray-600">dengan {{ $booking->helper->name }}</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                            @if($booking->status == 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($booking->status == 'in_progress') bg-green-100 text-green-800
                                            @endif">
                                            @if($booking->status == 'confirmed') Dikonfirmasi
                                            @elseif($booking->status == 'in_progress') Sedang Berlangsung
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center gap-4 text-sm">
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $booking->scheduled_time->format('d M, H:i') }}
                                        </div>
                                        <div class="flex items-center text-gray-600 truncate">
                                            <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="truncate">{{ Str::limit($booking->location_start, 25) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Arrow -->
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recent Activities -->
            @if($recentActivities->count() > 0)
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Aktivitas Terakhir</h3>
                <div class="bg-white rounded-2xl shadow-sm p-4">
                    <div class="space-y-4">
                        @foreach($recentActivities->take(5) as $activity)
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-2 h-2 bg-blue-900 rounded-full"></div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900">{{ $activity->log_message }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $activity->log_time->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
