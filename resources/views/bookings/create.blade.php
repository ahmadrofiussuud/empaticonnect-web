@extends('layouts.dashboard')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-12">
        <!-- Header & Stepper -->
        <div class="bg-white border-b border-gray-100 pt-8 pb-6 mb-8">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Book a Helper</h1>
                <p class="text-gray-500 mb-8">Find the perfect match for your loved one in three simple steps</p>
                
                <div class="flex items-center justify-center max-w-2xl mx-auto">
                     <!-- Step 1 -->
                     <div class="flex items-center gap-2">
                         <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">1</div>
                         <span class="text-blue-600 font-medium text-sm">Select Beneficiary</span>
                     </div>
                     <div class="w-24 h-px bg-gray-200 mx-4"></div>
                     <!-- Step 2 -->
                     <div class="flex items-center gap-2">
                         <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm">2</div>
                         <span class="text-gray-500 font-medium text-sm">Schedule Trip</span>
                     </div>
                     <div class="w-24 h-px bg-gray-200 mx-4"></div>
                     <!-- Step 3 -->
                     <div class="flex items-center gap-2">
                         <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm">3</div>
                         <span class="text-gray-500 font-medium text-sm">Choose Helper</span>
                     </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900">Select a Beneficiary</h2>
                <a href="{{ route('beneficiaries.create') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add New
                </a>
            </div>

            <!-- Beneficiary Selection Form -->
            <form action="{{ route('bookings.store') }}" method="POST"> <!-- Note: Real flow might use JS to change steps, for now form submits -->
                @csrf
                <!-- Note: Hidden fields for other steps would be here in a real multi-step form -->
                
                <div class="space-y-4 mb-8">
                    @forelse($beneficiaries as $beneficiary)
                        <div class="relative group">
                             <!-- Radio Input covering the whole card -->
                             <input type="radio" name="beneficiary_id" id="ben_{{ $beneficiary->id }}" value="{{ $beneficiary->id }}" class="peer hidden" required>
                             
                             <label for="ben_{{ $beneficiary->id }}" class="block bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:border-blue-400 transition cursor-pointer peer-checked:border-blue-600 peer-checked:ring-1 peer-checked:ring-blue-600">
                                <div class="flex items-start gap-4">
                                    <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden flex-shrink-0">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($beneficiary->name) }}&background=random&size=128" alt="{{ $beneficiary->name }}" class="w-full h-full object-cover">
                                    </div>
                                    
                                    <div class="flex-grow">
                                        <h3 class="font-bold text-gray-900 text-lg">{{ $beneficiary->name }}</h3>
                                        <p class="text-gray-500 text-sm mb-3">Age {{ $beneficiary->age ?? 'N/A' }}</p>
                                        
                                        <div class="flex flex-wrap gap-2">
                                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">{{ $beneficiary->disability_type ?? 'Generic Condition' }}</span>
                                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                                Needs stroller for long walks
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Select Button (Visual only, state controlled by radio) -->
                                <div class="mt-4 hidden peer-checked:block bg-blue-600 text-white text-center py-2 rounded-lg font-semibold">
                                    Selected
                                </div>
                            </label>
                        </div>
                    @empty
                        <div class="text-center p-8 bg-white rounded-xl border border-dashed border-gray-300">
                            <p class="text-gray-500">No beneficiaries found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Condition Section -->
                <div class="bg-[#F3F4F6] rounded-xl p-6 mb-8">
                    <h3 class="font-semibold text-gray-900 mb-4 text-sm">Confirm Primary Condition</h3>
                    <select name="condition" class="w-full bg-white border-none rounded-lg shadow-sm py-3 px-4 text-gray-600 focus:ring-2 focus:ring-blue-500">
                        <option value="">Select condition</option>
                        <option value="autism">Autism Spectrum Disorder</option>
                        <option value="down_syndrome">Down Syndrome</option>
                        <option value="cerebral_palsy">Cerebral Palsy</option>
                    </select>
                </div>

                <!-- Footer Actions -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition flex items-center gap-2">
                        Continue to Scheduling
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
