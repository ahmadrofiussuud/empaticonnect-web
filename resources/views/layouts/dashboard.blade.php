<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 relative overflow-x-hidden">
        <!-- Background Pattern Overlay -->
        <div class="min-h-screen relative z-10 pb-20 lg:pb-0">
            <!-- Top Navbar - Light Theme -->
            <nav class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Top Row: Logo and Menu -->
                    <div class="flex items-center justify-between h-20">
                        <!-- Left: Logo -->
                        <div class="flex items-center gap-3">
                            <a href="{{ route('home') }}" class="flex items-center gap-2">
                                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                     <!-- Placeholder for Logo -->
                                     <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </div>
                                <h3 class="text-blue-600 font-bold text-xl tracking-tight">EmpatiConnect</h3>
                            </a>
                        </div>
                        
                        <!-- Center: Desktop Navigation -->
                        <div class="hidden lg:flex items-center gap-8">
                            <a href="{{ route('home') }}" 
                               class="text-base font-medium hover:text-blue-600 transition {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600' }}">
                                Home
                            </a>
                            <a href="{{ route('bookings.index') }}" 
                               class="text-base font-medium hover:text-blue-600 transition {{ request()->routeIs('bookings.*') ? 'text-blue-600' : 'text-gray-600' }}">
                                My Journey
                            </a>
                            <a href="{{ route('beneficiaries.index') }}" 
                               class="text-base font-medium hover:text-blue-600 transition {{ request()->routeIs('beneficiaries.*') ? 'text-blue-600' : 'text-gray-600' }}">
                                Beneficiaries
                            </a>
                        </div>
                        
                        <!-- Right: User & Logout -->
                        <div class="flex items-center gap-4">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="px-5 py-2 bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium rounded-lg transition border border-gray-200">
                                        Log Out
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-blue-600 transition">Log in</a>
                                <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-lg shadow-blue-600/20">Register</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Professional Footer (Desktop only) -->
            <footer class="hidden lg:block bg-gray-900 text-gray-300 mt-16 w-full">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <!-- Brand Section -->
                            <div class="col-span-1">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-xl">E</span>
                                    </div>
                                    <h3 class="text-white font-bold text-lg">EmpatiConnect</h3>
                                </div>
                                <p class="text-sm text-gray-400 mb-4">
                                    Connecting companions with those who need support. Professional care assistance platform.
                                </p>
                                <div class="flex gap-3">
                                    <a href="#" class="w-8 h-8 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </a>
                                    <a href="#" class="w-8 h-8 bg-gray-800 hover:bg-blue-400 rounded-full flex items-center justify-center transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                    </a>
                                    <a href="#" class="w-8 h-8 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Quick Links -->
                            <div>
                                <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                                <ul class="space-y-2 text-sm">
                                    <li><a href="{{ route('dashboard') }}" class="hover:text-blue-400 transition">Dashboard</a></li>
                                    <li><a href="{{ route('beneficiaries.index') }}" class="hover:text-blue-400 transition">My Guides</a></li>
                                    <li><a href="{{ route('bookings.index') }}" class="hover:text-blue-400 transition">My Trips</a></li>
                                    <li><a href="{{ route('chatbot.index') }}" class="hover:text-blue-400 transition">AI Assistant</a></li>
                                </ul>
                            </div>

                            <!-- Support -->
                            <div>
                                <h4 class="text-white font-semibold mb-4">Support</h4>
                                <ul class="space-y-2 text-sm">
                                    <li><a href="#" class="hover:text-blue-400 transition">Help Center</a></li>
                                    <li><a href="#" class="hover:text-blue-400 transition">Safety Guidelines</a></li>
                                    <li><a href="#" class="hover:text-blue-400 transition">Contact Us</a></li>
                                    <li><a href="#" class="hover:text-blue-400 transition">FAQs</a></li>
                                </ul>
                            </div>

                            <!-- Contact -->
                            <div>
                                <h4 class="text-white font-semibold mb-4">Contact</h4>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>support@empaticonnect.com</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span>+62 812-3456-7890</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Malang, Jawa Timur</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Bottom Bar -->
                        <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                            <p>&copy; 2025 EmpatiConnect. All rights reserved.</p>
                            <div class="flex gap-6 mt-4 md:mt-0">
                                <a href="#" class="hover:text-blue-400 transition">Privacy Policy</a>
                                <a href="#" class="hover:text-blue-400 transition">Terms of Service</a>
                                <a href="#" class="hover:text-blue-400 transition">Cookie Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- Bottom Navigation (Mobile Only) -->
            <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 shadow-2xl lg:hidden">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex items-center justify-around py-2.5">
                        <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-1 py-1 px-3 {{ request()->routeIs('dashboard') || request()->routeIs('guardian.dashboard') || request()->routeIs('helper.dashboard') ? 'text-blue-900' : 'text-gray-400' }}">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            <span class="text-xs font-medium">Beranda</span>
                        </a>
                        <a href="{{ route('beneficiaries.index') }}" class="flex flex-col items-center gap-1 py-1 px-3 {{ request()->routeIs('beneficiaries.*') ? 'text-blue-900' : 'text-gray-400' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="text-xs font-medium">Favorit</span>
                        </a>
                        
                        <!-- Center Plus Button -->
                        <a href="{{ route('bookings.create') }}" class="relative -mt-6">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-900 to-blue-800 rounded-full flex items-center justify-center shadow-2xl hover:shadow-xl transition-all">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                        </a>
                        
                        <a href="{{ route('chatbot.index') }}" class="flex flex-col items-center gap-1 py-1 px-3 {{ request()->routeIs('chatbot.*') ? 'text-blue-900' : 'text-gray-400' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span class="text-xs font-medium">Chatbot</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-1 py-1 px-3 {{ request()->routeIs('profile.*') ? 'text-blue-900' : 'text-gray-400' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-xs font-medium">Profile</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Floating Chatbot Widget -->
            <div style="z-index: 9999; position: fixed; bottom: 2rem; right: 2rem;">
                <!-- Chat Window (Hidden by default) -->
                <div id="chat-widget" class="hidden flex-col bg-white rounded-2xl shadow-2xl overflow-hidden mb-4 transition-all duration-300 transform origin-bottom-right scale-95 opacity-0"
                     style="width: 300px; height: 450px; display: none;">
                    <!-- Header -->
                    <div class="p-4 flex justify-between items-center text-white shadow-md" style="background-color: #0d9488;">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-400"></div>
                            <h3 class="font-bold text-lg">EmpatiConnect AI</h3>
                        </div>
                        <button onclick="toggleChat()" class="text-white hover:bg-white/20 rounded-full p-1 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <!-- Chat Body -->
                    <div class="flex-1 overflow-y-auto p-4 bg-gray-50 flex flex-col gap-4" id="chat-messages">
                        <!-- AI Message -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0" style="background-color: #ccfbf1; color: #0f766e;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 text-sm text-gray-700">
                                <p>Halo! Saya EmpatiConnect AI. Saya di sini untuk membantu Anda menemukan Caregiver terbaik atau menjawab pertanyaan seputar layanan kami.</p>
                                <p class="mt-2 text-teal-600 font-medium" style="color: #0d9488;">Ada yang bisa saya bantu hari ini?</p>
                            </div>
                        </div>
                    </div>

                    <!-- Input Area -->
                    <div class="p-3 bg-white border-t border-gray-100">
                        <form onsubmit="sendMessage(event)" class="relative flex items-center">
                            <input type="text" id="user-input" placeholder="Ketik pesan..." class="w-full pl-4 pr-12 py-3 rounded-full border border-gray-300 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-sm">
                            <button type="submit" class="absolute right-2 p-2 text-white rounded-full hover:bg-teal-700 transition flex items-center justify-center shadow-md" style="background-color: #0d9488;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Toggle Button -->
                <button onclick="toggleChat()" class="ml-auto w-16 h-16 text-white rounded-full shadow-2xl flex items-center justify-center transition-transform hover:scale-110 focus:outline-none"
                        style="background-color: #0d9488 !important; border: 4px solid white !important; display: flex !important; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </button>
            </div>

            <script>
                function toggleChat() {
                    const widget = document.getElementById('chat-widget');
                    if (widget.style.display === 'none' || widget.classList.contains('hidden')) {
                        widget.classList.remove('hidden');
                        widget.style.display = 'flex'; // Force flex display
                        setTimeout(() => {
                            widget.classList.remove('scale-95', 'opacity-0');
                            widget.classList.add('scale-100', 'opacity-100');
                        }, 10);
                        document.getElementById('user-input').focus();
                        scrollToBottom();
                    } else {
                        widget.classList.remove('scale-100', 'opacity-100');
                        widget.classList.add('scale-95', 'opacity-0');
                        setTimeout(() => {
                            widget.classList.add('hidden');
                            widget.style.display = 'none';
                        }, 300);
                    }
                }

                function scrollToBottom() {
                    const chatBody = document.getElementById('chat-messages');
                    chatBody.scrollTop = chatBody.scrollHeight;
                }

                async function sendMessage(e) {
                    e.preventDefault();
                    const input = document.getElementById('user-input');
                    const message = input.value.trim();
                    if (!message) return;

                    const chatBody = document.getElementById('chat-messages');

                    // 1. Render User Message
                    const userDiv = document.createElement('div');
                    userDiv.className = 'flex items-center justify-end gap-3';
                    userDiv.innerHTML = `
                        <div class="bg-teal-600 text-white p-3 rounded-2xl rounded-tr-none shadow-sm text-sm">
                            ${escapeHtml(message)}
                        </div>
                    `;
                    chatBody.appendChild(userDiv);
                    input.value = '';
                    scrollToBottom();

                    // 2. Show Typing Indicator
                    const typingDiv = document.createElement('div');
                    typingDiv.id = 'typing-indicator';
                    typingDiv.className = 'flex items-start gap-3';
                    typingDiv.innerHTML = `
                        <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0" style="background-color: #ccfbf1; color: #0f766e;">
                            <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                        </div>
                        <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 text-sm text-gray-500 italic">
                            Sedang mengetik...
                        </div>
                    `;
                    chatBody.appendChild(typingDiv);
                    scrollToBottom();

                    try {
                        // 3. Send API Request
                        const response = await fetch('{{ route("chatbot.send") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ message: message })
                        });

                        const data = await response.json();

                        // Remove typing indicator
                        typingDiv.remove();

                        if (data.status === 'success') {
                            renderResponse(data.response);
                        } else {
                            renderTextResponse("Maaf, terjadi kesalahan pada sistem.");
                        }

                    } catch (error) {
                        typingDiv.remove();
                        renderTextResponse("Maaf, koneksi terputus. Silakan coba lagi.");
                        console.error('Chatbot Error:', error);
                    }
                    
                    scrollToBottom();
                }

                function renderResponse(response) {
                    if (response.type === 'text') {
                        renderTextResponse(response.text);
                    } else if (response.type === 'cards') {
                        renderTextResponse(response.text);
                        renderCards(response.data);
                    }
                }

                function renderTextResponse(text) {
                    const chatBody = document.getElementById('chat-messages');
                    const aiDiv = document.createElement('div');
                    aiDiv.className = 'flex items-start gap-3';
                    aiDiv.innerHTML = `
                        <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0" style="background-color: #ccfbf1; color: #0f766e;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 text-sm text-gray-700">
                            <p>${text}</p>
                        </div>
                    `;
                    chatBody.appendChild(aiDiv);
                }

                function renderCards(cards) {
                    const chatBody = document.getElementById('chat-messages');
                    const cardsContainer = document.createElement('div');
                    cardsContainer.className = 'flex flex-col gap-2 ml-11'; // Offset to align with text bubble

                    cards.forEach(card => {
                        const cardDiv = document.createElement('div');
                        cardDiv.className = 'bg-white p-3 rounded-xl shadow border border-gray-200 flex gap-3 items-center hover:shadow-md transition';
                        cardDiv.innerHTML = `
                            <img src="${card.image}" class="w-12 h-12 rounded-full object-cover bg-gray-100">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-gray-900 text-sm truncate">${card.name}</h4>
                                <div class="flex items-center text-xs text-yellow-500 mb-1">
                                    <span>★ ${card.rating}</span>
                                    <span class="text-gray-400 ml-1">(${card.tier})</span>
                                </div>
                                <p class="text-teal-600 font-bold text-xs">${card.rate}/jam</p>
                            </div>
                            <a href="${card.url}" class="p-2 bg-teal-50 text-teal-700 rounded-lg hover:bg-teal-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        `;
                        cardsContainer.appendChild(cardDiv);
                    });

                    chatBody.appendChild(cardsContainer);
                }

                function escapeHtml(text) {
                    return text
                        .replace(/&/g, "&amp;")
                        .replace(/</g, "&lt;")
                        .replace(/>/g, "&gt;")
                        .replace(/"/g, "&quot;")
                        .replace(/'/g, "&#039;");
                }
            </script>

        @stack('scripts')
    </body>
</html>
