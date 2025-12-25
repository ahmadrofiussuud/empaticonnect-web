<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    @if($bookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($bookings as $booking)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-semibold">{{ $booking->beneficiary->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $booking->scheduled_time->format('d M Y, H:i') }}</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if($booking->status == 'completed') bg-green-100 text-green-800
                                            @elseif($booking->status == 'in_progress') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="text-primary hover:text-primary-dark text-sm mt-2 inline-block">
                                        View Details →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-600 py-8">No bookings found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
