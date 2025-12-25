@extends('layouts.dashboard')

@section('content')
    <!-- Chatbot Page with Beautiful Background -->
    <div class="min-h-screen relative overflow-hidden">
        <!-- Animated Background Pattern -->
        <div class="fixed inset-0 z-0 pointer-events-none opacity-20">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-20 left-1/3 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative z-10 flex flex-col h-screen">
            <!-- Chatbot Header with Gradient -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 shadow-2xl">
                <div class="max-w-4xl mx-auto px-4 py-6">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="p-2 hover:bg-white/20 rounded-xl transition">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        
                        <div class="flex items-center gap-3 flex-1">
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-xl transform hover:scale-110 transition">
                                <span class="text-4xl">🤖</span>
                            </div>
                            <div>
                                <h2 class="text-white font-bold text-xl">LIA AI Assistant</h2>
                                <p class="text-purple-100 text-sm">Powered by Gemini AI</p>
                            </div>
                        </div>
                        
                        <button class="p-2.5 hover:bg-white/20 rounded-xl transition">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Chat Messages Area with Glass Effect -->
            <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6 bg-gradient-to-b from-gray-50 to-gray-100" id="chat-container">
                <!-- Welcome Message -->
                <div class="flex items-start gap-3 animate-fade-in">
                    <div class="flex-shrink-0 w-11 h-11 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <span class="text-2xl">🤖</span>
                    </div>
                    <div class="flex-1 max-w-md">
                        <div class="bg-white/80 backdrop-blur-sm rounded-3xl rounded-tl-md shadow-xl p-5 border border-purple-100">
                            <p class="text-gray-800 text-sm leading-relaxed">
                                👋 Selamat datang! Saya <span class="font-bold text-purple-600">LIA AI</span>, asisten virtual EmpatiConnect yang didukung oleh Gemini AI. 
                                Saya siap membantu Anda dengan pertanyaan seputar platform kami!
                            </p>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 ml-3">Baru saja</p>
                    </div>
                </div>

                <!-- Messages will be appended here -->
                <div id="messages-end"></div>
            </div>

            <!-- Input Area with Modern Design -->
            <div class="bg-white/90 backdrop-blur-xl border-t border-purple-100 shadow-2xl sticky bottom-20 lg:bottom-0">
                <div class="max-w-4xl mx-auto px-4 py-4">
                    <form id="chat-form" class="flex items-center gap-3">
                        @csrf
                        <div class="flex-1 relative group">
                            <input type="text" 
                                   id="message-input"
                                   name="message" 
                                   placeholder="Tanya apa saja tentang EmpatiConnect..." 
                                   class="w-full rounded-2xl bg-gray-100 border-2 border-transparent hover:border-purple-200 focus:border-purple-500 focus:bg-white px-6 py-4 text-sm focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all shadow-sm"
                                   autocomplete="off">
                            
                            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 p-2 hover:bg-purple-100 rounded-xl transition">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <button type="submit" 
                                id="send-button"
                                class="flex-shrink-0 w-14 h-14 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 rounded-2xl flex items-center justify-center shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        console.log('🤖 Chatbot script loaded!');
        
        document.addEventListener('DOMContentLoaded', function() {
            console.log('✅ DOM loaded, initializing chatbot...');
            
            const form = document.getElementById('chat-form');
            const input = document.getElementById('message-input');
            const sendButton = document.getElementById('send-button');
            
            if (!form || !input) {
                console.error('❌ Chat elements not found!');
                return;
            }
            
            console.log('✅ Elements found, attaching listener...');
            
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                console.log('📨 Form submitted!');
                
                const message = input.value.trim();
                
                if (!message) {
                    return;
                }
                
                // Disable input during processing
                input.disabled = true;
                sendButton.disabled = true;
                sendButton.innerHTML = `
                    <svg class="w-6 h-6 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                `;
                
                // Add user message
                addMessageToChat('user', message);
                input.value = '';
                
                // Show typing
                const typingId = addTypingIndicator();
                
                try {
                    const response = await fetch('{{ route("chatbot.send") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: message })
                    });
                    
                    const data = await response.json();
                    console.log('✅ API Response:', data);
                    
                    removeTypingIndicator(typingId);
                    
                    if (data.success && data.message) {
                        addMessageToChat('bot', data.message);
                    } else {
                        addMessageToChat('bot', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
                    }
                    
                } catch (error) {
                    console.error('❌ Error:', error);
                    removeTypingIndicator(typingId);
                    addMessageToChat('bot', 'Maaf, koneksi bermasalah. Coba lagi.');
                } finally {
                    input.disabled = false;
                    sendButton.disabled = false;
                    sendButton.innerHTML = `
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    `;
                    input.focus();
                }
                
                scrollToBottom();
            });
        
            function addMessageToChat(role, message) {
                const messagesEnd = document.getElementById('messages-end');
                const time = new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});
                
                let html = '';
                
                if (role === 'user') {
                    html = `
                        <div class="flex items-start gap-3 justify-end animate-fade-in">
                            <div class="flex-1 flex justify-end max-w-md">
                                <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl rounded-tr-md shadow-xl p-5">
                                    <p class="text-white text-sm leading-relaxed font-medium">${escapeHtml(message)}</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-11 h-11 bg-blue-900 text-white rounded-2xl flex items-center justify-center font-bold text-lg shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                    `;
                } else {
                    html = `
                        <div class="flex items-start gap-3 animate-fade-in">
                            <div class="flex-shrink-0 w-11 h-11 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                                <span class="text-2xl">🤖</span>
                            </div>
                            <div class="flex-1 max-w-md">
                                <div class="bg-white/80 backdrop-blur-sm rounded-3xl rounded-tl-md shadow-xl p-5 border border-purple-100">
                                    <p class="text-gray-800 text-sm leading-relaxed whitespace-pre-wrap">${escapeHtml(message)}</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-2 ml-3">${time}</p>
                            </div>
                        </div>
                    `;
                }
                
                messagesEnd.insertAdjacentHTML('beforebegin', html);
            }
            
            function addTypingIndicator() {
                const id = 'typing-' + Date.now();
                const messagesEnd = document.getElementById('messages-end');
                messagesEnd.insertAdjacentHTML('beforebegin', `
                    <div id="${id}" class="flex items-start gap-3 animate-fade-in">
                        <div class="flex-shrink-0 w-11 h-11 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="text-2xl">🤖</span>
                        </div>
                        <div class="flex-1 max-w-md">
                            <div class="bg-white/80 backdrop-blur-sm rounded-3xl rounded-tl-md shadow-xl p-5 border border-purple-100">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full animate-bounce"></div>
                                    <div class="w-2 h-2 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                    <div class="w-2 h-2 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                scrollToBottom();
                return id;
            }
            
            function removeTypingIndicator(id) {
                const element = document.getElementById(id);
                if (element) element.remove();
            }
            
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
            
            function scrollToBottom() {
                const container = document.getElementById('chat-container');
                container.scrollTop = container.scrollHeight;
            }
        });
    </script>
    @endpush
@endsection
