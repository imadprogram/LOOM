@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-4 md:p-10">
        <!-- Back Button -->
        <a href="/home"
            class="inline-flex items-center gap-2 text-gray-500 hover:text-[#52c6be] font-bold mb-8 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                class="w-5 h-5 group-hover:-translate-x-1 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to Discover
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            <!-- Product Image Section -->
            <div class="flex flex-col gap-6">
                <!-- Main Image Container -->
                <div
                    class="relative group rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 bg-white md:p-4 aspect-square">
                    <div class="w-full h-full rounded-[1.5rem] overflow-hidden relative">
                        <img id="mainImage" src="{{ asset('storage/' . $annonce->images->first()->file_path) }}"
                            alt="{{ $annonce->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                </div>

                <!-- Thumbnails Gallery -->
                <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide">
                    @foreach ($annonce->images as $image)
                        <div
                            class="w-24 h-24 flex-shrink-0 rounded-2xl overflow-hidden border-2 border-transparent hover:border-[#52c6be] transition-all cursor-pointer shadow-sm active:scale-95">
                            <img src="{{ asset('storage/' . $image->file_path) }}" onclick="changeMainImage(this.src)"
                                class="w-full h-full object-cover" alt="Thumbnail">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="flex flex-col py-2 lg:py-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-6">
                        <span
                            class="border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-wider">{{ $annonce->category->name }}</span>

                    </div>

                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight leading-tight mb-4">
                        {{ $annonce->title }}</h1>
                    <div class="flex items-center justify-between mb-8">
                        <p class="text-4xl font-black text-[#52c6be]">{{ $annonce->price }}€</p>
                        <div class="flex items-center gap-2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.412 15.655L9.75 21.75l3.745-4.012M9.257 13.5H3.75l2.659-2.849m2.048-2.191L10.25 2.25l3.745 4.012M14.5 13.5h5.75l-2.659 2.849m-2.048 2.191l-1.793 1.921" />
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-tighter">Verified Link</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Listed</p>
                            <p class="text-sm font-black text-gray-900">{{ $annonce->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Found in</p>
                            <p class="text-sm font-black text-gray-900">{{ $annonce->location }}</p>
                        </div>
                    </div>

                    <h3 class="font-bold text-gray-900 text-xl mb-4">Description</h3>
                    <p class="text-gray-500 leading-relaxed text-lg mb-8">
                        {{ $annonce->description }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-10 mt-auto">
                        @if (auth()->id() !== $annonce->user_id)
                            <a href="{{ route('messages.index', ['user_id' => $annonce->user_id, 'annonce_id' => $annonce->id]) }}"
                                class="flex-1 flex justify-center items-center h-14 bg-[#52c6be] hover:bg-[#3fad9e] shadow-lg shadow-[#52c6be]/20 rounded-full text-white font-bold text-lg transition-all hover:-translate-y-0.5">
                                Message Seller
                            </a>

                            @if (!auth()->user()->is_admin)
                                <button id="report-button"
                                    class="flex-1 flex justify-center items-center h-14 bg-red-500 hover:bg-red-600 shadow-lg shadow-red-500/20 rounded-full text-white font-bold text-lg transition-all hover:-translate-y-0.5"
                                    onclick="showReportForm()">
                                    Report Product
                                </button>
                            @endif
                        @endif
                    </div>

                    <!-- Seller Info -->
                    <div
                        class="p-6 bg-gray-50/50 rounded-3xl flex items-center justify-between border border-gray-100 hover:bg-gray-50 transition-colors cursor-pointer group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-white shadow-md relative">
                                <img src="https://api.dicebear.com/7.x/identicon/svg?seed=anytext"
                                    class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p
                                    class="font-bold text-gray-900 leading-tight group-hover:text-[#52c6be] transition-colors">
                                    {{ $annonce->user->first_name }}</p>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-tight mt-0.5">Member since
                                    {{ $annonce->user->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- report form --}}
            {{-- dialoge dyal daisyUi for showing katrdha modal --}}
            <dialog id="reportForm" class="modal">
                <div class="modal-box bg-white rounded-3xl p-8">
                    <h3 class="font-black text-2xl mb-4">Report listing</h3>
                    <form action="{{ route('report.product', $annonce->id) }}" method="POST" class="mt-6">
                        @csrf
                        <div class="mb-4">
                            <label for="reason" class="block text-gray-700 font-bold mb-2">Reason for Reporting:</label>
                            <textarea id="reason" name="reason" rows="4" required maxlength="1000"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-[#52c6be]/50"></textarea>
                            @error('reason')
                                <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-md transition-colors">
                            Submit Report
                        </button>
                    </form>
                </div>
                {{-- u can't see it cuz this form daisyui when clickin outside the modal it closes --}}
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>

            <script>
                function showReportForm() {
                    // daisyUi way to show a dialog
                    document.getElementById('reportForm').showModal()
                }

                @if ($errors->has('reason'))
                    showReportForm()
                @endif


                // script for changing display on the main image
                function changeMainImage(newSrc) {
                    document.getElementById('mainImage').src = newSrc;
                }
            </script>
        </div>
    @endsection
