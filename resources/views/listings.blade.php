@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-4 md:p-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
        <div>
            <h2 class="text-4xl font-black text-gray-900 tracking-tight">My Listings</h2>
            <p class="text-gray-500 mt-1 font-medium">Manage and track your items for sale.</p>
        </div>
        {{-- <a href="/sell" class="bg-[#52c6be] hover:bg-[#3fad9e] text-white px-6 py-3 rounded-full font-bold transition-all shadow-lg shadow-[#52c6be]/20 hover:-translate-y-0.5">
            + New Listing
        </a> --}}
    </div>

    <!-- Listings Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @forelse($listings as $item)
            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow flex flex-col">
                <!-- Image -->
                <div class="w-full aspect-square rounded-3xl overflow-hidden bg-gray-100 flex items-center justify-center">
                    @if ($item->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $item->images->first()->file_path) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400 font-bold">No Image</span>
                    @endif
                </div>

                <!-- Info -->
                <div class="p-5 flex flex-col flex-1">
                    <!-- Title & Status Badge -->
                    <div class="flex items-center gap-2 mb-2">
                        <h3 class="text-sm font-bold text-gray-900 line-clamp-1">{{ $item->title }}</h3>
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest flex-shrink-0 {{ $item->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>
                    
                    <!-- Price -->
                    <p class="text-[#52c6be] font-black text-base mb-1">{{ $item->price }}€</p>
                    
                    <!-- Date -->
                    <p class="text-gray-400 text-[11px] mb-4">Published on {{ $item->created_at->format('M d, Y') }}</p>

                    <!-- Actions -->
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <!-- Status Toggle Button -->
                        @if($item->status == 'active')
                            <form action="{{ route('mark.as.sold' , $item->id) }}" method="post" class="contents">
                                @csrf
                                @method('PUT')
                                <button class="text-center px-3 py-2 rounded-full bg-[#52c6be]/10 text-[#52c6be] text-xs font-bold hover:bg-[#52c6be]/20 transition-colors">
                                    Mark as Sold
                                </button>
                            </form>
                        @else
                            <form action="{{ route('mark.as.active' , $item->id) }}" method="post" class="contents">
                                @csrf
                                @method('PUT')
                                <button class="text-center px-3 py-2 rounded-full bg-green-50 text-green-600 text-xs font-bold hover:bg-green-100 transition-colors">
                                    Mark Active
                                </button>
                            </form>
                        @endif

                        @if(!$item->boosted_until || $item->boosted_until < now())
                            <form action="{{ route('boost.checkout', $item->id) }}" method="POST" class="contents">
                                @csrf
                                <button class="text-center px-3 py-2 rounded-full bg-amber-50 text-amber-600 text-xs font-bold hover:bg-amber-100 transition-colors">
                                    🚀 Boost
                                </button>
                            </form>
                        @else
                            <span class="text-center px-3 py-2 rounded-full bg-amber-100 text-amber-600 text-xs font-bold">
                                🚀 Boosted
                            </span>
                        @endif

                        <a href="{{ route('edit.listing' , $item->id) }}" class="text-center px-3 py-2 rounded-full border border-gray-200 text-xs font-bold text-gray-600 hover:bg-gray-50 transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('delete.listing' , $item->id) }}" method="post" class="contents">
                            @csrf
                            @method('DELETE')
                            <button class="text-center px-3 py-2 rounded-full bg-red-50 text-red-500 text-xs font-bold hover:bg-red-100 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-gray-50/50 rounded-[3rem] border-2 border-dashed border-gray-200 text-center flex flex-col items-center">
                <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mb-6 shadow-sm mx-auto">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-3.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No listings yet</h3>
                <p class="text-gray-500 mb-8 max-w-xs mx-auto">Start selling your items to see them appear here in your dashboard.</p>
                <a href="/sell" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full font-bold hover:bg-gray-800 transition-all">
                    Create Listing
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection