@extends('layouts.dashboard')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-12">
    <!-- Hero Section: My Journey -->
    <div class="relative overflow-hidden flex items-center justify-center bg-gray-900" style="min-height: 50vh;">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=2000" 
                 alt="Journey Background" 
                 class="w-full h-full object-cover opacity-60"
                 onerror="this.style.display='none'">
            <!-- Dark Overlay for text readability -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/80 to-indigo-900/90 mix-blend-multiply"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 tracking-tight">
                My Journey
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto font-light leading-relaxed">
                Monitor, manage, and review all your booked trips in one place.
            </p>
        </div>
    </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Today's Trips</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $bookings->where('scheduled_time', '>=', now()->startOfDay())->where('scheduled_time', '<=', now()->endOfDay())->count() }}</h3>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Upcoming This Week</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $bookings->where('scheduled_time', '>', now())->where('scheduled_time', '<=', now()->addDays(7))->count() }}</h3>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Completed Trips</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $bookings->where('status', 'completed')->count() }}</h3>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option>All Statuses</option>
                            <option>Active</option>
                            <option>Pending</option>
                            <option>Completed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Beneficiary</label>
                        <select class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option>All Beneficiaries</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <input type="date" class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <input type="date" class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Booking Cards -->
            <div class="mb-4">
                <h2 class="text-lg font-bold text-gray-900 mb-4 text-center border-b border-gray-200 pb-2">All Bookings</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 relative overflow-hidden group hover:shadow-md transition">
                        <!-- Status Badge -->
                        <span class="absolute top-6 right-6 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                            {{ $booking->status == 'completed' ? 'bg-green-100 text-green-700' : ($booking->status == 'pending' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ $booking->status }}
                        </span>

                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 flex-shrink-0 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->helper->name) }}&background=random" alt="" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ $booking->helper->name }}</h3>
                                <!-- Helper Info Placeholder -->
                                <p class="text-gray-500 text-sm">Verfied Helper</p> 
                                
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Verified
                                    </span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                        4.9 ★
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Date & Duration -->
                        <div class="flex items-center gap-6 mb-6 text-sm text-gray-600 bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="font-medium">{{ $booking->scheduled_time->format('M d, Y g:i a') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>90 min</span>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('bookings.show', $booking->id) }}" class="w-full flex justify-center items-center py-2 px-4 border border-blue-600 text-blue-600 font-medium rounded-lg hover:bg-blue-50 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                View Details
                            </a>
                            <button class="w-full flex justify-center items-center py-2 px-4 bg-orange-400 text-white font-medium rounded-lg hover:bg-orange-500 transition shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                Rate Helper
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-gray-500">No bookings found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
