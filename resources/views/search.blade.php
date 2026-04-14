@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-4 md:p-8">
        <!-- Search Header -->
        <div class="mb-8">
            <h2 class="text-4xl font-black text-gray-900 tracking-tight mb-6">
                Search Products
            </h2>
            
            <!-- Search Input -->
            <form method="GET" action="{{ route('search') }}" class="flex gap-2">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $query ?? '' }}"
                    placeholder="Search by title or description..." 
                    class="flex-1 px-6 py-3 rounded-full border border-gray-300 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-900"
                >
                <button 
                    type="submit"
                    class="px-8 py-3 bg-[#52c6be] hover:bg-[#3fad9e] text-white font-bold rounded-full transition-all"
                >
                    Search
                </button>
            </form>

            <!-- Search Info -->
            @if($query)
                <p class="text-gray-500 mt-4 text-sm">
                    Found <span class="font-bold text-[#52c6be]">{{ $annonces->total() ?? 0 }}</span> result(s) for "<span class="font-semibold">{{ $query }}</span>"
                </p>
            @else
                <p class="text-gray-500 mt-4 text-sm italic">Enter a keyword to search...</p>
            @endif
        </div>

        <!-- Results Grid -->
        @if($query && $annonces && $annonces->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($annonces as $annonce)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 hover:-translate-y-1 hover:shadow-[0_12px_30px_-4px_rgba(82,198,190,0.15)] transition-all duration-300">
                        <figure class="relative aspect-[4/3] overflow-hidden bg-gray-100 flex items-center justify-center">
                            @if ($annonce->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $annonce->images->first()->file_path) }}" alt="Product"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <span class="text-gray-400 font-bold">No Image</span>
                            @endif

                            <!-- Boosted Badge -->
                            @if($annonce->boosted_until && \Carbon\Carbon::parse($annonce->boosted_until)->isFuture())
                                <div class="absolute top-3 right-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold">
                                    ⭐ Boosted
                                </div>
                            @endif
                        </figure>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight group-hover:text-[#52c6be] transition-colors line-clamp-1">
                                    {{ $annonce->title }}
                                </h3>
                                <span class="text-lg font-black text-[#52c6be] whitespace-nowrap ml-4">
                                    {{ $annonce->price }}€
                                </span>
                            </div>

                            <p class="text-gray-500 text-sm mb-2 line-clamp-2">{{ $annonce->description }}</p>

                            <!-- Category & Location -->
                            <div class="flex items-center gap-2 mb-4 text-xs text-gray-500">
                                @if($annonce->category)
                                    <span class="px-2 py-1 bg-gray-100 rounded-full">{{ $annonce->category->name }}</span>
                                @endif
                                <span>📍 {{ $annonce->location }}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden text-center flex items-center justify-center text-xs font-bold text-gray-400 uppercase">
                                        {{ substr($annonce->user->first_name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-600 truncate max-w-[100px]">
                                        {{ $annonce->user->first_name ?? 'Unknown' }}
                                    </span>
                                </div>
                                <a href="{{ route('product.details', $annonce->id) }}"
                                    class="text-sm font-bold text-white bg-[#52c6be] hover:bg-[#3fad9e] shadow-sm hover:shadow px-5 py-2 rounded-full transition-all inline-block">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $annonces->links() }}
            </div>

        @elseif($query)
            <!-- No Results -->
            <div class="text-center py-20">
                <div class="text-6xl mb-4">🔍</div>
                <p class="text-gray-500 text-lg font-medium">
                    No products found for "<span class="font-bold text-gray-900">{{ $query }}</span>"
                </p>
                <p class="text-gray-400 text-sm mt-2">Try different keywords or browse <a href="/home" class="text-[#52c6be] hover:underline font-semibold">all items</a></p>
            </div>
        @endif
    </div>
@endsection
