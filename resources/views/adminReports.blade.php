@extends('layouts.appAdmin')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-black mb-6">User Reports</h1>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 font-bold text-gray-600">Reported By</th>
                        <th class="p-4 font-bold text-gray-600">Product</th>
                        <th class="p-4 font-bold text-gray-600">Reason</th>
                        <th class="p-4 font-bold text-gray-600">Status</th>
                        <th class="p-4 font-bold text-gray-600 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($reports as $report)
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td class="p-4">
                                <p class="font-bold">{{ $report->user->first_name }}</p>
                                <p class="text-xs text-gray-400">ID: #{{ $report->user->id }}</p>
                            </td>
                            <td class="p-4">
                                <p class="font-bold text-[#52c6be]">{{ $report->annonce->title }}</p>
                                <a href="{{ route('product.details', $report->annonce->id) }}"
                                    class="text-xs text-gray-400 underline cursor-pointer">View Listing</a>
                            </td>
                            <td class="p-4">
                                <p title="{{ $report->reason }}" class="truncate max-w-[200px] cursor-pointer">
                                    {{ $report->reason }}
                                </p>
                            </td>
                            <td class="p-4">
                                <!-- Red for Pending, Green for Resolved -->
                                <span
                                    class="px-3 py-1 {{ $report->status == 'pending' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }} rounded-full text-xs font-bold uppercase transition-colors">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <!-- Button to update the Status from Pending -> Resolved -->
                                @if ($report->status == 'pending')
                                    <form action="{{ route('resolve.report', $report->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-[#52c6be] text-white px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:scale-105 transition-transform">
                                            Mark as Resolved
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <h1>test</h1>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination for $reports -->
        <div class="mt-6">
            {{-- $reports->links() --}}
        </div>
    </div>
@endsection
