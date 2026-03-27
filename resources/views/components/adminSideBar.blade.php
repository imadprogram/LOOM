<aside class="w-64 min-h-screen bg-gray-900 text-white flex flex-col p-4 shadow-xl fixed left-0 top-0">
    <!-- Brand Logo -->
    <div class="flex items-center gap-3 px-4 py-6 mb-4 border-b border-gray-800">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8 text-[#52c6be]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
        </svg>
        <div class="flex flex-col">
            <h1 class="text-xl font-black tracking-tighter">Loom</h1>
            <span class="text-[10px] uppercase font-bold text-[#52c6be] tracking-widest mt-0.5">Admin</span>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 space-y-2 mt-2">
        <!-- Dashboard/Statistics -->
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/dashboard') ? 'bg-[#52c6be] text-white shadow-lg shadow-[#52c6be]/20' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <span class="font-bold text-sm">Dashboard</span>
        </a>

        <!-- Users -->
        <a href="/admin/users" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/users') ? 'bg-[#52c6be] text-white shadow-lg shadow-[#52c6be]/20' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="font-bold text-sm">Manage Users</span>
        </a>

        <!-- Annonces -->
        <a href="/admin/annonces" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/annonces') ? 'bg-[#52c6be] text-white shadow-lg shadow-[#52c6be]/20' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75v-3.75a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
            </svg>
            <span class="font-bold text-sm">All Annonces</span>
        </a>

        <!-- Reports -->
        <a href="/admin/reports" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->is('admin/reports') ? 'bg-[#52c6be] text-white shadow-lg shadow-[#52c6be]/20' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" />
            </svg>
            <span class="font-bold text-sm">Reports</span>
        </a>
    </nav>
    
    <!-- User Logout/Profile area-->
    <div class="border-t border-gray-800 pt-6 pb-2 mt-auto">
        <a href="/home" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-800 text-gray-300 hover:text-white hover:bg-gray-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 -scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
            </svg>
            <span class="font-bold text-sm">Back to Store</span>
        </a>
    </div>
</aside>