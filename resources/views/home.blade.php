@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-4 md:p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-4xl font-black text-gray-900 tracking-tight">
                Discover
            </h2>
            <p class="text-gray-500 mt-1 font-medium">Explore the best items from our community</p>
        </div>
        <div class="bg-[#52c6be]/10 text-[#52c6be] px-4 py-2 rounded-full font-bold text-sm">
            {{ $annonces->where('status', 'active')->count() }} Items
        </div>
    </div>

    <!-- Scrollable Section -->
    <div class="h-[calc(100vh-200px)] overflow-y-auto pb-10 scrollbar-hide">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($annonces as $annonce)
                @if ($annonce->status === 'active')
                
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 hover:-translate-y-1 hover:shadow-[0_12px_30px_-4px_rgba(82,198,190,0.15)] transition-all duration-300">
                        <figure class="relative aspect-[4/3] overflow-hidden bg-gray-100 flex items-center justify-center">
                            @if($annonce->image)
                                <img src="{{ asset('storage/' . $annonce->image->file_path) }}" alt="Product" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <span class="text-gray-400 font-bold">No Image</span>
                            @endif
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm text-gray-400 hover:text-red-500 transition-colors cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </div>
                        </figure>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight group-hover:text-[#52c6be] transition-colors line-clamp-1">{{ $annonce->title }}</h3>
                                <span class="text-lg font-black text-[#52c6be] whitespace-nowrap ml-4">{{ $annonce->price }}€</span>
                            </div>
                            <p class="text-gray-500 text-sm mb-6 line-clamp-2">{{ $annonce->description }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden text-center flex items-center justify-center text-xs font-bold text-gray-400 uppercase">
                                        {{ substr($annonce->user->first_name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-600 truncate max-w-[100px]">{{ $annonce->user->first_name ?? 'Unknown' }}</span>
                                </div>
                                <a href="{{ route('product.details', $annonce->id) }}" class="text-sm font-bold text-white bg-[#52c6be] hover:bg-[#3fad9e] shadow-sm hover:shadow px-5 py-2 rounded-full transition-all inline-block">View</a>
                            </div>
                        </div>
                    </div>

                @endif
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-20">
                    <p class="text-gray-500 text-lg font-medium">No items found. Be the first to <a href="/sell" class="text-[#52c6be] hover:underline">sell something</a>!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection