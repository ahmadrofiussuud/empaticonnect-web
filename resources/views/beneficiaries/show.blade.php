<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $beneficiary->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $beneficiary->name }}</h3>
                            <p class="text-gray-600">{{ $beneficiary->disability_type }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('beneficiaries.edit', $beneficiary->id) }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('beneficiaries.destroy', $beneficiary->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-600">Emergency Contact</p>
                            <p class="font-medium">{{ $beneficiary->emergency_contact }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Bookings</p>
                            <p class="font-medium">{{ $beneficiary->bookings->count() }}</p>
                        </div>
                    </div>

                    @if($beneficiary->notes)
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-1">Notes</p>
                        <p class="text-gray-900">{{ $beneficiary->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 border-b">
                    <h4 class="font-semibold text-lg">Booking History</h4>
                </div>
                <div class="p-6">
                    @if($beneficiary->bookings->count() > 0)
                        <div class="space-y-3">
                            @foreach($beneficiary->bookings as $booking)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium">Helper: {{ $booking->helper->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $booking->scheduled_time->format('d M Y, H:i') }}</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if($booking->status == 'completed') bg-green-100 text-green-800
                                            @elseif($booking->status == 'in_progress') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-600 py-4">No bookings yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
