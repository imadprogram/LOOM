@extends('layouts.appAdmin')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Overview Dashboard</h1>
        <p class="text-gray-500 font-medium mt-1">Here is a quick snapshot of Loom today.</p>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-500">Total Users</h3>
                <div class="p-2 bg-[#52c6be]/10 text-[#52c6be] rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-4xl font-black text-gray-900">{{ $users }}</div>
            <p class="text-sm text-green-500 font-bold mt-2"></p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-500">Active Listings</h3>
                <div class="p-2 bg-blue-100 text-blue-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.651h16.5M3.75 21V9.349m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75v-3.75a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .414.336.75.75.75z" />
                    </svg>
                </div>
            </div>
            <div class="text-4xl font-black text-gray-900">{{ $activeListings }}</div>
            <p class="text-sm text-gray-400 font-bold mt-2">Currently available to buy</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-500">Items Sold</h3>
                <div class="p-2 bg-green-100 text-green-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                </div>
            </div>
            <div class="text-4xl font-black text-gray-900">{{ $soldListings }}</div>
            <p class="text-sm text-green-500 font-bold mt-2">Successful sales!</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-500">Active Boosts</h3>
                <div class="p-2 bg-purple-100 text-purple-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                    </svg>
                </div>
            </div>
            <div class="text-4xl font-black text-gray-900">{{ $activeBoosts }}</div>
            <p class="text-sm text-purple-500 font-bold mt-2">Paid promotions running</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-12">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="font-bold text-lg text-gray-900">Newest Members</h2>
                <a href="/admin/users" class="text-sm text-[#52c6be] font-bold hover:underline">View All Users</a>
            </div>
            <div class="flex-1 p-0 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <tbody>
                        @forelse ($newestMembers as $member)
                            <tr class="hover:bg-gray-50 border-b border-gray-50 last:border-none transition">
                                <td class="p-4 py-5 w-16">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                        {{ $member->first_name[0] }}</div>
                                </td>
                                <td class="p-4 py-5 font-bold text-gray-900">{{ $member->first_name }}
                                    {{ $member->last_name }}</td>
                                <td class="p-4 py-5 text-gray-500 text-sm">{{ $member->email }}</td>
                                <td class="p-4 py-5 text-gray-400 text-sm font-medium text-right">Joined
                                    {{ $member->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-400 font-medium">No users have
                                    registered yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="font-bold text-lg text-gray-900">Latest Annonces</h2>
                <a href="/admin/annonces" class="text-sm text-[#52c6be] font-bold hover:underline">View All Annonces</a>
            </div>
            <div class="flex-1 p-0 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <tbody>
                        @forelse ($newestAnnonces as $annonce)
                            <tr class="hover:bg-gray-50 border-b border-gray-50 last:border-none transition">
                                <td class="p-4 py-5 w-16">
                                    @if ($annonce->image)
                                        <img src="{{ asset('storage/' . $annonce->image->file_path) }}"
                                            alt="{{ $annonce->title }}"
                                            class="w-10 h-10 rounded-xl object-cover shadow-sm">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center shadow-inner">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-4 py-5 font-bold text-gray-900">{{ $annonce->title }}</td>
                                <td class="p-4 py-5 text-[#52c6be] font-bold">${{ $annonce->price }}</td>
                                <td class="p-4 py-5 text-gray-400 text-sm font-medium text-right">
                                    {{ $annonce->created_at->diffForHumans() }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-400 font-medium">No annonces have been
                                    posted yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
