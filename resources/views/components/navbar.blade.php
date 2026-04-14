<nav
    class="w-full bg-white/80 backdrop-blur-md border-b border-gray-100 flex justify-between items-center px-6 lg:px-10 py-4 sticky top-0 z-50">
    <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8 text-[#52c6be]">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
        </svg>
        <h1 class="text-2xl font-black tracking-tighter text-gray-900">Loom</h1>
    </a>
</div>

<div class="flex items-center gap-5">
        <a href="{{ route('search') }}"><ion-icon name="search-outline" class="text-2xl"></ion-icon></a>
        @auth
            <a href="/sell"
                class="bg-[#52c6be] hover:bg-[#3fad9e] text-white px-5 py-2.5 rounded-full font-bold text-sm transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5 mr-2">
                Sell an item
            </a>

            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown()"
                    class="flex items-center gap-2 p-1 pl-3 pr-2 rounded-full border border-gray-100 hover:bg-gray-50 transition-all focus:outline-none group">
                    <span
                        class="text-sm font-bold text-gray-700 group-hover:text-[#52c6be]">{{ auth()->user()->first_name }}</span>
                    <div class="w-8 h-8 rounded-full bg-[#52c6be]/10 text-[#52c6be] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                </button>

                <div id="user-dropdown"
                    class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 transition-all hidden">
                    <div class="px-4 py-3 border-b border-gray-50">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Account</p>
                        <p class="text-sm font-black text-gray-900 truncate">{{ auth()->user()->email }}</p>
                    </div>

                    <a href="/profile"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-600 hover:bg-gray-50 hover:text-[#52c6be] transition-colors">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        Profile Settings
                    </a>

                    <a href="/my-listings"
                        class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-600 hover:bg-gray-50 hover:text-[#52c6be] transition-colors">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-3.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        My Listings
                    </a>

                    @if (auth()->user()->is_admin)
                        <a href="/admin/dashboard"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-600 hover:bg-[#52c6be]/5 hover:text-[#52c6be] transition-colors border-t border-gray-50 mt-1">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                            </svg>
                            Admin Dashboard
                        </a>
                    @endif

                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-600 hover:bg-red-50 hover:text-red-500 transition-colors">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function toggleDropdown() {
                    const menu = document.getElementById('user-dropdown');
                    menu.classList.toggle('hidden');
                }

                // Close dropdown if clicking outside
                window.onclick = function(event) {
                    if (!event.target.closest('button')) {
                        const menu = document.getElementById('user-dropdown');
                        if (!menu.classList.contains('hidden')) {
                            menu.classList.add('hidden');
                        }
                    }
                }
            </script>
        @else
            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900 transition-colors">
                Log in
            </a>
            <a href="{{ route('signup') }}"
                class="bg-[#52c6be] hover:bg-[#3fad9e] text-white px-5 py-2.5 rounded-full font-bold text-sm transition-all shadow-sm hover:shadow-md">
                Get Started
            </a>
        @endauth
    </div>
</nav>
