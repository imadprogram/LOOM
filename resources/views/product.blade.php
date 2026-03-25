@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-10">
    <!-- Back Button -->
    <a href="/home" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#52c6be] font-bold mb-8 transition-colors group">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 group-hover:-translate-x-1 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to Discover
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
        <!-- Product Image Section -->
        <div class="relative group rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 bg-white md:p-4 aspect-square">
             <div class="w-full h-full rounded-[1.5rem] overflow-hidden relative">
                 <img src="{{ asset('storage/' . $annonce->image->file_path) }}" alt="Product Name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                 <!-- Favorite Button -->
                 <button class="absolute top-6 right-6 bg-white/90 backdrop-blur-md p-3.5 rounded-full shadow-lg text-gray-400 hover:text-red-500 transition-colors">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                     </svg>
                 </button>
             </div>
        </div>

        <!-- Product Details Section -->
        <div class="flex flex-col py-2 lg:py-6">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-6">
                    <span class="border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-wider">{{ $annonce->category->name }}</span>
                    
                    <span class="bg-[#52c6be]/10 text-[#52c6be] px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-wider">New Arrival</span>
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight leading-tight mb-4">{{ $annonce->title }}</h1>
                <p class="text-4xl font-black text-[#52c6be] mb-8">{{ $annonce->price }}€</p>

                <div class="w-full h-[1px] bg-gray-100 mb-8"></div>

                <h3 class="font-bold text-gray-900 text-xl mb-4">Description</h3>
                <p class="text-gray-500 leading-relaxed text-lg mb-8">
                    {{ $annonce->description }}
                </p>

                <div class="space-y-4 mb-10">
                    <div class="flex items-center gap-4 text-gray-700 font-medium">
                        <div class="bg-[#52c6be]/10 p-2 rounded-full text-[#52c6be]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span>Authenticated Original</span>
                    </div>
                    <div class="flex items-center gap-4 text-gray-700 font-medium">
                        <div class="bg-[#52c6be]/10 p-2 rounded-full text-[#52c6be]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <span>Free Shipping in Europe</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-10 mt-auto">
                <button class="flex-1 h-14 bg-[#52c6be] hover:bg-[#3fad9e] shadow-lg shadow-[#52c6be]/20 rounded-full text-white font-bold text-lg transition-all hover:-translate-y-0.5">
                    Buy Now
                </button>
                <button class="flex-1 h-14 border-2 border-gray-200 hover:border-gray-900 text-gray-900 rounded-full font-bold text-lg transition-all">
                    Message Seller
                </button>
            </div>

            <!-- Seller Info -->
            <div class="p-6 bg-gray-50/50 rounded-3xl flex items-center justify-between border border-gray-100 hover:bg-gray-50 transition-colors cursor-pointer group">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-white shadow-md relative">
                        <img src="https://api.dicebear.com/7.x/identicon/svg?seed=anytext" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 leading-tight group-hover:text-[#52c6be] transition-colors">{{ $annonce->user->first_name }}</p>
                        <p class="text-xs text-gray-500 font-medium mt-1">Verified Seller Since 2024</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-amber-400 text-sm flex gap-0.5 justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
