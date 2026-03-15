<nav class="w-full bg-white/80 backdrop-blur-md border-b border-gray-100 flex justify-between items-center px-6 lg:px-10 py-4 sticky top-0 z-50">
    <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
        <!-- Loom Logo matching the Figma design -->
        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8 text-[#52c6be]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
        </svg>
        <h1 class="text-2xl font-black tracking-tighter text-gray-900">Loom</h1>
    </a>
    
    <div class="flex items-center gap-5">
        @auth
            <a href="/sell" class="bg-[#52c6be] hover:bg-[#3fad9e] text-white px-5 py-2.5 rounded-full font-bold text-sm transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5 mr-2">
                Sell an item
            </a>

            <a href="/profile" class="text-gray-500 hover:text-[#52c6be] transition-colors p-2 rounded-full hover:bg-gray-100" title="Profile Settings">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </a>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="text-sm font-bold text-gray-500 hover:text-red-500 transition-colors px-2 py-2">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900 transition-colors">
                Log in
            </a>
            <a href="{{ route('signup') }}" class="bg-[#52c6be] hover:bg-[#3fad9e] text-white px-5 py-2.5 rounded-full font-bold text-sm transition-all shadow-sm hover:shadow-md">
                Get Started
            </a>
        @endauth
    </div>
</nav>