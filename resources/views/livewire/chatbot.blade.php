<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-4xl mx-auto">
        <!-- Wizard Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Book a Helper</h1>
            <p class="text-gray-500">Find the perfect match for your loved one in three simple steps</p>
        </div>

        <!-- Stepper -->
        <div class="flex items-center justify-center mb-12">
            <div class="flex items-center">
                <div class="flex flex-col items-center relative">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white mb-2 
                        {{ $step >= 1 ? 'bg-[#3B82F6]' : 'bg-gray-300' }}">1</div>
                    <span class="text-xs font-semibold {{ $step >= 1 ? 'text-[#3B82F6]' : 'text-gray-400' }} absolute -bottom-6 w-32 text-center">Select Beneficiary</span>
                </div>
                <div class="w-24 h-1 {{ $step >= 2 ? 'bg-[#3B82F6]' : 'bg-gray-200' }} mx-2"></div>
                <div class="flex flex-col items-center relative">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white mb-2 
                        {{ $step >= 2 ? 'bg-[#3B82F6]' : 'bg-gray-300' }}">2</div>
                    <span class="text-xs font-semibold {{ $step >= 2 ? 'text-[#3B82F6]' : 'text-gray-400' }} absolute -bottom-6 w-32 text-center">Schedule Trip</span>
                </div>
                <div class="w-24 h-1 {{ $step >= 3 ? 'bg-[#3B82F6]' : 'bg-gray-200' }} mx-2"></div>
                <div class="flex flex-col items-center relative">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white mb-2 
                        {{ $step >= 3 ? 'bg-[#3B82F6]' : 'bg-gray-300' }}">3</div>
                    <span class="text-xs font-semibold {{ $step >= 3 ? 'text-[#3B82F6]' : 'text-gray-400' }} absolute -bottom-6 w-32 text-center">Choose Helper</span>
                </div>
            </div>
        </div>

        <!-- Step 1: Select Beneficiary -->
        @if($step === 1)
            <div class="animate-fade-in-up">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Select a Beneficiary</h2>
                    <button class="flex items-center gap-1 text-gray-500 hover:text-[#3B82F6] text-sm font-semibold border border-gray-300 rounded-lg px-3 py-2 bg-white hover:bg-gray-50 transition">
                        <span>+</span> Add New
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @forelse($beneficiaries as $index => $beneficiary)
                        <div class="bg-white rounded-xl shadow-sm border-2 p-6 cursor-pointer transition-all duration-200
                                    {{ $selected_beneficiary_id == $beneficiary->id ? 'border-[#3B82F6] ring-2 ring-[#3B82F6]/20' : 'border-gray-100 hover:border-[#3B82F6]/50' }}"
                             wire:click="selectBeneficiary({{ $beneficiary->id }}, '{{ $beneficiary->disability_type }}')">
                            
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-14 h-14 rounded-full bg-gray-200 overflow-hidden flex-shrink-0">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($beneficiary->name) }}&background=random" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $beneficiary->name }}</h3>
                                    <p class="text-gray-500 text-sm">Patient ID: #{{ $beneficiary->id }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-2 mb-4">
                                <p class="text-xs text-gray-500 mb-1">Primary Condition</p>
                                <div class="flex items-center gap-2 text-sm font-semibold text-gray-700">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $beneficiary->disability_type }}
                                </div>
                            </div>

                            <button class="w-full py-2 rounded-lg font-semibold transition text-sm
                                           {{ $selected_beneficiary_id == $beneficiary->id ? 'bg-[#3B82F6] text-white' : 'bg-[#3B82F6]/10 text-[#3B82F6] hover:bg-[#3B82F6] hover:text-white' }}">
                                {{ $selected_beneficiary_id == $beneficiary->id ? 'Selected' : 'Select' }}
                            </button>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                             <p class="text-gray-500 mb-2">No beneficiaries found.</p>
                             <button class="text-[#3B82F6] font-bold hover:underline">Add your first beneficiary</button>
                        </div>
                    @endforelse
                </div>

                <!-- Confirm Primary Condition (Mockup Style) -->
                @if($selected_beneficiary_id)
                    <div class="bg-gray-100/50 rounded-xl p-6 mb-8 border border-gray-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Confirm Primary Condition</label>
                        <div class="relative">
                            <input type="text" readonly value="{{ $selected_condition_text }}" 
                                   class="w-full bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-3">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex justify-end">
                    <button wire:click="confirmBeneficiary" 
                            class="bg-[#3B82F6] hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ !$selected_beneficiary_id ? 'disabled' : '' }}>
                        Continue to Scheduling →
                    </button>
                </div>
            </div>
        @endif

        <!-- Step 2: Schedule Trip -->
        @if($step === 2)
            <div class="animate-fade-in-up">
                <h2 class="text-xl font-bold text-gray-900 mb-6">When is the trip?</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                     <button wire:click="selectTime('Hari Ini')" class="bg-white p-6 rounded-xl border-2 border-gray-100 hover:border-[#3B82F6] shadow-sm hover:shadow-md transition text-left group">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#3B82F6] transition">
                            <svg class="w-6 h-6 text-[#3B82F6] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Hari Ini</h3>
                        <p class="text-gray-500 text-sm">Find helpers available immediately</p>
                    </button>

                    <button wire:click="selectTime('Besok')" class="bg-white p-6 rounded-xl border-2 border-gray-100 hover:border-[#3B82F6] shadow-sm hover:shadow-md transition text-left group">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-600 transition">
                            <svg class="w-6 h-6 text-purple-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Besok</h3>
                        <p class="text-gray-500 text-sm">Schedule for tomorrow</p>
                    </button>
                </div>

                 <button wire:click="$set('step', 1)" class="text-gray-500 font-semibold hover:text-gray-800">
                    ← Back to Beneficiary
                </button>
            </div>
        @endif

        <!-- Step 3: Choose Helper -->
        @if($step === 3)
            <div class="animate-fade-in-up">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Select a Helper</h2>
                
                <div class="grid gap-4">
                     @forelse($helpers as $helper)
                        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gray-200 rounded-full overflow-hidden">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($helper->user->name) }}&background=random" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $helper->user->name }}</h4>
                                    <div class="flex items-center gap-2 text-sm text-gray-600 mt-1">
                                        <span class="flex items-center text-yellow-500">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            {{ $helper->rating }}
                                        </span>
                                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                        <span>{{ ucfirst($helper->tier) }}</span>
                                    </div>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($helper->skills ?? [] as $skill)
                                            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded-full">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-lg text-gray-900 mb-2">Rp {{ number_format($helper->hourly_rate, 0, ',', '.') }}<span class="text-xs text-gray-400 font-normal">/hr</span></div>
                                <a href="{{ route('helpers.show', $helper->id) }}" class="bg-[#3B82F6] hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition inline-block">
                                    Select
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                             <p class="text-gray-500 mb-2">No helpers found matching your criteria.</p>
                             <button wire:click="resetWizard" class="text-[#3B82F6] font-bold hover:underline">Start Over</button>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 flex justify-between">
                     <button wire:click="$set('step', 2)" class="text-gray-500 font-semibold hover:text-gray-800">
                        ← Back to Schedule
                    </button>
                </div>
            </div>
        @endif

    </div>
</div>
