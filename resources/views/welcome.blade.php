@extends('layouts.app')

@section('content')
<div class="relative bg-white overflow-hidden">
    <div class="absolute inset-y-0 w-full h-full pointer-events-none" aria-hidden="true">
        <div class="absolute top-0 right-0 -mr-32 -mt-20 w-96 h-96 rounded-full bg-gradient-to-br from-[#52c6be]/20 to-blue-100 blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-32 -mb-20 w-96 h-96 rounded-full bg-gradient-to-tr from-[#52c6be]/20 to-purple-100 blur-3xl opacity-50"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20 pb-24 sm:pt-32 sm:pb-32">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#52c6be]/10 border border-[#52c6be]/20 text-[#52c6be] text-sm font-bold tracking-wide uppercase mb-8">
                <span class="w-2 h-2 rounded-full bg-[#52c6be] animate-pulse"></span>
                The Modern Marketplace
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black text-gray-900 tracking-tighter mb-6 leading-tight">
                Buy and Sell. <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#52c6be] to-blue-500">Unbelievably fast.</span>
            </h1>
            
            <p class="text-lg md:text-xl text-gray-500 font-medium mb-10 leading-relaxed">
                Loom safely connects local buyers and sellers. Discover amazing deals on electronics, fashion, and furniture, or turn your unused items into instant cash.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/signup" class="w-full sm:w-auto px-8 py-4 bg-gray-900 hover:bg-gray-800 text-white font-bold rounded-full transition-all hover:-translate-y-1 shadow-xl hover:shadow-2xl">
                    Get Started Free
                </a>
                <a href="/home" class="w-full sm:w-auto px-8 py-4 bg-white border-2 border-gray-100 hover:border-gray-200 text-gray-900 font-bold rounded-full transition-all hover:-translate-y-1 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                    Explore Listings 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-10 lg:gap-16">
            
            <div class="bg-gray-50/50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition-all group">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sell Instantly</h3>
                <p class="text-gray-500 font-medium">Post your item in less than 60 seconds. Our platform organizes it neatly into categories for thousands of local buyers to browse.</p>
            </div>

            <div class="bg-gray-50/50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition-all group">
                <div class="w-14 h-14 bg-[#52c6be]/20 text-[#52c6be] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494h.02a3.002 3.002 0 002.818-2.885c.024-.269.048-.538.07-.807.027-.33.052-.656.074-.984.093-1.396.14-2.81.14-4.25s-.047-2.854-.14-4.25c-.022-.328-.047-.654-.074-.984a51.642 51.642 0 00-.07-.807A3.002 3.002 0 0018.068 2.5h-.02a48.282 48.282 0 00-5.68-.494 1.526 1.526 0 01-1.037.443L7.255 6.526v2.96c-1.108.086-2.206.209-3.293.369-1.584.233-2.707 1.626-2.707 3.228v.677z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Live Messaging</h3>
                <p class="text-gray-500 font-medium">Negotiate in real-time. Our built-in lightning-fast chat system means you never have to give out your personal phone number.</p>
            </div>

            <div class="bg-gray-50/50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition-all group">
                <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Boost Sales</h3>
                <p class="text-gray-500 font-medium">Need to sell fast? Use our Stripe-powered Boost feature to pin your item securely to the very top of the marketplace.</p>
            </div>

        </div>
    </div>
</div>
@endsection