@extends('layouts.appAdmin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Manage Annonces</h1>
    <p class="text-gray-500 font-medium mt-1">Review, activate, or remove listings from the platform.</p>
</div>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50/50 border-b border-gray-100">
            <tr>
                <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Item</th>
                <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Seller</th>
                <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Price</th>
                <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse ($annonces as $annonce)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="p-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-100 border border-gray-200 overflow-hidden shrink-0">
                                @if($annonce->image)
                                    <img src="{{ asset('storage/' . $annonce->image->file_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 leading-tight">{{ $annonce->title }}</h4>
                                <p class="text-xs text-gray-400 mt-1">{{ $annonce->category->name }} • {{ $annonce->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-5 text-sm font-medium text-gray-600">
                        {{ $annonce->user->first_name }} {{ $annonce->user->last_name }}
                    </td>
                    <td class="p-5 text-sm font-black text-gray-900">
                        {{ number_format($annonce->price, 2) }} DH
                    </td>
                    <td class="p-5">
                        @if($annonce->status === 'active')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                Suspended
                            </span>
                        @endif
                    </td>
                    <td class="p-5 text-right space-x-2">
                        <!-- Toggle Status -->
                        @if($annonce->status === 'active')
                            <form action="{{ route('deactivate.annonce' , $annonce->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-xl transition-all">
                                    Deactivate
                                </button>
                            </form>
                        @else
                            <form action="{{ route('activate.annonce' , $annonce->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="text-xs font-bold text-green-600 bg-green-50 hover:bg-green-100 px-4 py-2 rounded-xl transition-all">
                                    Activate
                                </button>
                            </form>
                        @endif

                        <!-- Delete Permanently -->
                        <form id="delete-form-{{ $annonce->id }}" action="{{ route('delete.annonce' , $annonce->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-100 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-400 font-medium italic">No listings found to manage.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $annonces->links() }}
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Delete this listing?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            borderRadius: '24px', 
            background: '#ffffff',
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-4 py-2 font-bold',
                cancelButton: 'rounded-xl px-4 py-2 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the specific form for that annonce ID
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

@endsection
