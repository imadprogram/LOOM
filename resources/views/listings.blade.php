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
    <div class="grid grid-cols-1 gap-6">
        @php
            // Placeholder data for the template
            // You can replace this with @forelse($myAnnonces as $annonce) later 
            $myListings = [
                ['title' => 'Vintage Camera', 'price' => '120.00', 'status' => 'active', 'image' => 'https://picsum.photos/seed/camera/400/300'],
                ['title' => 'Smart Watch', 'price' => '45.00', 'status' => 'sold', 'image' => 'https://picsum.photos/seed/watch/400/300'],
            ];
        @endphp

        @forelse($listings as $item)
            <div class="bg-white border border-gray-100 rounded-3xl p-4 md:p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] flex flex-col md:flex-row items-center gap-6 hover:shadow-md transition-shadow">
                <!-- Image -->
                <div class="w-full md:w-32 h-32 rounded-2xl overflow-hidden flex-shrink-0 bg-gray-50">
                    <img src="{{ asset('storage/' . $item->image->file_path) }}" class="w-full h-full object-cover">
                </div>

                <!-- Info -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-wrap justify-center md:justify-start items-center gap-3 mb-2">
                        <h3 class="text-xl font-bold text-gray-900">{{ $item->title }}</h3>
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $item->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                            {{ $item['status'] }}
                        </span>
                    </div>
                    <p class="text-[#52c6be] font-black text-lg">{{ $item->price }}€</p>
                    <p class="text-gray-400 text-xs mt-1">Published on Oct 12, 2024</p>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <!-- Status Toggle Button -->
                    @if($item->status == 'active')
                        <form action="{{ route('mark.as.sold' , $item->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="flex-1 md:flex-none text-center px-5 py-2.5 rounded-full bg-[#52c6be]/10 text-[#52c6be] text-sm font-bold hover:bg-[#52c6be]/20 transition-colors">
                                Mark as Sold
                            </button>
                        </form>
                    @else
                        <form action="{{ route('mark.as.active' , $item->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="flex-1 md:flex-none text-center px-5 py-2.5 rounded-full bg-green-50 text-green-600 text-sm font-bold hover:bg-green-100 transition-colors">
                                Mark as Active
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('edit.listing' , $item->id) }}" class="flex-1 md:flex-none text-center px-5 py-2.5 rounded-full border border-gray-100 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('delete.listing' , $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="flex-1 md:flex-none text-center px-5 py-2.5 rounded-full bg-red-50 text-red-500 text-sm font-bold hover:bg-red-100 transition-colors">
                            Delete
                        </button>
                    </form>
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