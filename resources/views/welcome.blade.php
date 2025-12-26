@extends('layouts.dashboard')

@section('content')
    <!-- Hero Section -->
    <!-- Hero Section -->
    <div class="relative overflow-hidden flex items-center justify-center" style="min-height: 65vh;">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1573497491208-6b1acb260507?q=80&w=2000" 
                 alt="People with disabilities" 
                 class="w-full h-full object-cover"
                 style="filter: brightness(0.4); object-position: center 25%;">
            <!-- Dark Overlay for text readability -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-blue-800/70 to-indigo-900/80"></div>
        </div>

        <!-- Optional: Subtle decorative blobs -->
        <div class="absolute inset-0 z-0">
             <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-400 opacity-10 filter blur-3xl"></div>
             <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-indigo-500 opacity-10 filter blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center w-full">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tight text-white drop-shadow-lg leading-tight">
                Trusted Care for Your Loved <br/> Ones
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl text-white max-w-4xl mx-auto mb-10 font-light leading-relaxed drop-shadow-md">
                Connect with verified Helpers who understand your family's unique needs. Safe, transparent, and compassionate support starts here.
            </p>
            
            <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                <a href="{{ route('bookings.create') }}" class="inline-flex items-center justify-center px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg shadow-xl hover:shadow-2xl transition-all text-base min-w-[180px] transform hover:scale-105">
                    Book a Helper
                </a>
                @guest
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-white hover:bg-gray-50 text-blue-600 hover:text-blue-700 font-semibold rounded-lg shadow-xl hover:shadow-2xl transition-all text-base min-w-[180px] transform hover:scale-105">
                    Become a Helper
                </a>
                @endguest
            </div>
        </div>
    </div>
    <!-- Dashboard Widgets for Authenticated Users -->
    @auth
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Complete Profile Alert -->
            <div class="rounded-xl shadow-lg p-6 mb-12 text-white flex flex-col md:flex-row items-center justify-between gap-6 relative z-40 -mt-20 overflow-hidden" 
                 style="background: linear-gradient(to right, #fb923c, #f97316);">
                <!-- Background decorative circle -->
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 rounded-full bg-orange-300 opacity-20 blur-2xl"></div>
                
                <div class="flex items-center gap-5 relative z-10">
                    <div class="p-3 bg-white/20 rounded-full backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">Complete Your Profile</h3>
                        <p class="text-orange-50 text-sm">Add your first Beneficiary or finish your Helper profile to get started.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 w-full md:w-auto min-w-[300px] relative z-10">
                    <div class="w-full bg-black/20 rounded-full h-2.5">
                        <div class="bg-white h-2.5 rounded-full shadow-sm" style="width: 25%"></div>
                    </div>
                    <span class="text-sm font-bold">25%</span>
                </div>
            </div>

            <!-- Today's Trips -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Today's Trips</h2>
                    <a href="{{ route('bookings.index') }}" class="text-blue-600 font-semibold text-sm hover:underline">View All Trips</a>
                </div>

                <!-- Empty State / List -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
                    @if(isset($activeBookings) && $activeBookings->isEmpty())
                        <div class="flex flex-col items-center justify-center text-gray-400">
                             <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                             <p>No trips scheduled for today.</p>
                        </div>
                    @elseif(isset($activeBookings))
                        <!-- List would go here -->
                        <div class="grid gap-4">
                            @foreach($activeBookings as $booking)
                                <div class="bg-gray-50 p-4 rounded-lg flex justify-between items-center">
                                    <span class="font-medium text-gray-900">{{ $booking->beneficiary->name }} with {{ $booking->helper->name }}</span>
                                    <span class="text-sm text-gray-500">{{ $booking->scheduled_time->format('H:i') }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mb-16">
                <div class="bg-gray-100 rounded-xl p-6">
                    <h3 class="text-gray-700 font-semibold mb-4 flex items-center gap-2">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                         Recent Activity
                    </h3>
                    <div class="space-y-4">
                        @if(isset($recentActivities))
                            @forelse($recentActivities as $activity)
                                <div class="bg-white rounded-lg p-4 shadow-sm flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                                        <span class="text-gray-600 text-sm">{{ $activity->log_message }}</span>
                                    </div>
                                    <span class="text-gray-400 text-xs">{{ $activity->log_time->format('M d, Y, g:i a') }}</span>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 text-sm">No recent activity.</div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>

            <!-- Book a Helper Stepper Section -->
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Book a Helper</h2>
                <p class="text-gray-500 mb-8">Find the perfect match for your loved one in three simple steps</p>
                
                <div class="flex items-center justify-center max-w-2xl mx-auto mb-8">
                     <!-- Step 1 -->
                     <div class="flex items-center gap-2">
                         <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">1</div>
                         <span class="text-blue-600 font-medium text-sm">Select Beneficiary</span>
                     </div>
                     <div class="w-16 h-px bg-gray-300 mx-2"></div>
                     <!-- Step 2 -->
                     <div class="flex items-center gap-2">
                         <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm">2</div>
                         <span class="text-gray-500 font-medium text-sm">Schedule Trip</span>
                     </div>
                     <div class="w-16 h-px bg-gray-300 mx-2"></div>
                     <!-- Step 3 -->
                     <div class="flex items-center gap-2">
                         <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm">3</div>
                         <span class="text-gray-500 font-medium text-sm">Choose Helper</span>
                     </div>
                </div>

                <a href="{{ route('bookings.create') }}" class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
                    Start Booking
                </a>
            </div>

        </div>
    </div>
    @endauth

    <!-- Features Section (Optional placeholder if needed to fill space) -->
    <!-- <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Why Choose EmpatiConnect?</h2>
            </div>
             ...
        </div>
    </div> -->
@endsection
