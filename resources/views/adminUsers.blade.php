@extends('layouts.appAdmin')

@section('content')
<!-- Header -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Manage Users</h1>
        <p class="text-gray-500 font-medium mt-1">View and manage all members on the platform.</p>
    </div>
</div>

<!-- Users Table -->
<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
    <div class="flex-1 p-0 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider">User</th>
                    <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Email</th>
                    <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Role</th>
                    <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider">Joined</th>
                    <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 border-b border-gray-50 last:border-none transition">
                        <td class="p-5 w-64">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full {{ $user->is_admin ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }} flex items-center justify-center font-bold shadow-sm">
                                    {{ strtoupper(substr($user->first_name, 0, 1)) }}
                                </div>
                                <div class="font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>
                            </div>
                        </td>
                        <td class="p-5 text-gray-500 text-sm font-medium">{{ $user->email }}</td>
                        <td class="p-5">
                            @if($user->is_admin)
                                <span class="px-3 py-1 text-xs font-bold text-purple-700 bg-purple-100 rounded-full">Admin</span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold text-gray-600 bg-gray-100 rounded-full">User</span>
                            @endif
                        </td>
                        <td class="p-5 text-gray-400 text-sm font-medium">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="p-5 text-right">
                            @if(!$user->is_admin)

                                @if(!$user->is_banned)
                                    <form action="{{ route('ban.user' , $user->id) }}" method="POST" class="inline" >
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm bg-red-50 hover:bg-red-100 px-4 py-2 rounded-xl transition-colors">
                                            Ban User
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('unban.user' , $user->id) }}" method="POST" class="inline" >
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-600 hover:text-green-800 font-bold text-sm bg-green-50 hover:bg-green-100 px-4 py-2 rounded-xl transition-colors">
                                            Unban User
                                        </button>
                                    </form>
                                    
                                @endif
                            @else
                                <span class="text-gray-300 text-sm italic font-medium">Protected Role</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400 font-medium">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection