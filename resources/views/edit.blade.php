@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-4 md:p-8">
    <div class="mb-8">
        <a href="/my-listings" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#52c6be] font-bold mb-6 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 group-hover:-translate-x-1 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to My Listings
        </a>
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Edit Item</h2>
        <p class="text-gray-500 mt-1 font-medium">Update your item's details for potential buyers.</p>
    </div>

    <!-- The Form -->
    <div class="border border-gray-100 bg-white rounded-3xl p-6 md:p-10 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
        <form action="{{ route('update.listing', $annonce->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Image Upload Section -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3">Update Image (Optional)</label>
                <label class="relative block border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:bg-gray-50 hover:border-[#52c6be]/50 transition-colors cursor-pointer group overflow-hidden">
                    <div id="upload-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400 group-hover:text-[#52c6be] mb-3 transition-colors">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span class="block text-sm font-bold text-[#52c6be]">Click to change image</span>
                        <span class="block text-xs text-gray-500 mt-1">Leave empty to keep current photo</span>
                    </div>

                    @if($annonce->image)
                        <img id="image-preview" src="{{ asset('storage/' . $annonce->image->file_path) }}" alt="Preview" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <img id="image-preview" src="#" alt="Preview" class="absolute inset-0 w-full h-full object-cover hidden">
                    @endif

                    <input type="file" name="image" id="image-input" class="sr-only" accept="image/*" onchange="previewImage(event)">
                </label>
            </div>

            <!-- Basics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ $annonce->title }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                </div>

                <div class="space-y-2">
                    <label for="price" class="block text-sm font-bold text-gray-700">Price (€)</label>
                    <input type="number" step="0.01" id="price" name="price" value="{{ $annonce->price }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                </div>

                <div class="space-y-2">
                    <label for="category_id" class="block text-sm font-bold text-gray-700">Category</label>
                    <select id="category_id" name="category_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium bg-white">
                        <option value="" disabled>Select a category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected($annonce->category_id == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-bold text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="5" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium resize-none">{{ $annonce->description }}</textarea>
            </div>

            <!-- Location -->
            <div class="space-y-2">
                <label for="location" class="block text-sm font-bold text-gray-700">Location</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <input type="text" id="location" name="location" value="{{ $annonce->location }}" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-4">
                <a href="/my-listings" class="px-6 py-3 rounded-full font-bold text-gray-500 hover:bg-gray-50 transition-colors">Cancel</a>
                <button type="submit" class="bg-[#52c6be] hover:bg-[#3fad9e] shadow-lg shadow-[#52c6be]/20 text-white px-10 py-3 rounded-full font-bold transition-all hover:-translate-y-0.5">
                    Update Listing
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');
    const placeholder = document.getElementById('upload-placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }
}
</script>