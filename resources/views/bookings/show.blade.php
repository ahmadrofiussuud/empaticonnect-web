<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Status Banner -->
            <div class="mb-6 p-6 rounded-lg 
                @if($booking->status == 'pending') bg-yellow-50 border border-yellow-200
                @elseif($booking->status == 'confirmed') bg-blue-50 border border-blue-200
                @elseif($booking->status == 'in_progress') bg-green-50 border border-green-200
                @elseif($booking->status == 'completed') bg-gray-50 border border-gray-200
                @else bg-red-50 border border-red-200 @endif">
                <h3 class="text-lg font-semibold mb-2">Status: {{ ucfirst($booking->status) }}</h3>
                <p class="text-gray-600">Scheduled for {{ $booking->scheduled_time->format('l, d F Y - H:i') }}</p>
            </div>

            <!-- Main Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Beneficiary</h4>
                    <p class="text-lg font-bold">{{ $booking->beneficiary->name }}</p>
                    <p class="text-gray-600">{{ $booking->beneficiary->disability_type }}</p>
                    <p class="text-sm text-gray-600 mt-2">Emergency: {{ $booking->beneficiary->emergency_contact }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">
                        @if(Auth::user()->isGuardian()) Helper @else Guardian @endif
                    </h4>
                    @if(Auth::user()->isGuardian())
                        <p class="text-lg font-bold">{{ $booking->helper->name }}</p>
                        @if($booking->helper->helperProfile)
                            <p class="text-gray-600">{{ ucfirst($booking->helper->helperProfile->tier) }}</p>
                            <p class="text-sm text-gray-600">⭐ {{ number_format($booking->helper->helperProfile->rating, 1) }}</p>
                        @endif
                    @else
                        <p class="text-lg font-bold">{{ $booking->guardian->name }}</p>
                        <p class="text-gray-600">{{ $booking->guardian->phone_number }}</p>
                    @endif
                </div>
            </div>

            <!-- Location Info -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 mb-6">
                <h4 class="font-semibold text-gray-900 mb-4">Location Details</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Pickup</p>
                        <p class="font-medium">📍 {{ $booking->location_start }}</p>
                    </div>
                    @if($booking->location_end)
                    <div>
                        <p class="text-sm text-gray-600">Destination</p>
                        <p class="font-medium">🎯 {{ $booking->location_end }}</p>
                    </div>
                    @endif
                </div>
                @if($booking->notes)
                <div class="mt-4 pt-4 border-t">
                    <p class="text-sm text-gray-600">Notes</p>
                    <p class="text-gray-900">{{ $booking->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Activity Log -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 mb-6">
                <h4 class="font-semibold text-gray-900 mb-4">Activity Log</h4>
                <div class="space-y-3">
                    @foreach($booking->activityLogs as $log)
                        <div class="flex items-start border-l-4 border-primary pl-4 py-2">
                            <div>
                                <p class="text-gray-900">{{ $log->log_message }}</p>
                                <p class="text-xs text-gray-500">{{ $log->log_time->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Actions -->
            @if(Auth::user()->isGuardian() && $booking->status == 'pending')
                <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded">
                        Cancel Booking
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
