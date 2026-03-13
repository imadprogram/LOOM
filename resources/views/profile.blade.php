@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-4 md:p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Account Settings</h2>
        <p class="text-gray-500 mt-1 font-medium">Update your profile information and manage your security.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Sidebar Navigation -->
        <div class="md:col-span-1 border border-gray-100 bg-white rounded-3xl p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] h-fit">
            <div class="flex flex-col gap-2">
                <a href="#general" class="flex items-center gap-3 bg-[#52c6be]/10 text-[#52c6be] px-4 py-3 rounded-2xl font-bold transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    General Info
                </a>
                <a href="#security" class="flex items-center gap-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 px-4 py-3 rounded-2xl font-bold transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    Security
                </a>
            </div>
        </div>

        <!-- Forms Section -->
        <div class="md:col-span-2 space-y-8">
            <!-- General Information Form -->
            <div id="general" class="border border-gray-100 bg-white rounded-3xl p-6 md:p-8 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                <h3 class="text-xl font-bold text-gray-900 mb-6">General Information</h3>
                
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <!-- We use PUT method generally for updates, though it's simulated here -->
                    @method('PUT') 
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label for="first_name" class="block text-sm font-bold text-gray-700">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ auth()->user()->first_name ?? '' }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                        </div>
                        <div class="space-y-1.5">
                            <label for="last_name" class="block text-sm font-bold text-gray-700">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ auth()->user()->last_name ?? '' }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="block text-sm font-bold text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="bg-[#52c6be] hover:bg-[#3fad9e] shadow-lg shadow-[#52c6be]/20 text-white px-8 py-3 rounded-full font-bold transition-all hover:-translate-y-0.5">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Form -->
            <div id="security" class="border border-gray-100 bg-white rounded-3xl p-6 md:p-8 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Change Password</h3>
                
                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="space-y-1.5">
                        <label for="current_password" class="block text-sm font-bold text-gray-700">Current Password</label>
                        <input type="password" id="current_password" name="current_password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                    </div>

                    <div class="space-y-1.5">
                        <label for="new_password" class="block text-sm font-bold text-gray-700">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                    </div>

                    <div class="space-y-1.5">
                        <label for="new_password_confirmation" class="block text-sm font-bold text-gray-700">Confirm New Password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 outline-none transition-all text-gray-700 font-medium">
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="bg-gray-900 hover:bg-gray-800 shadow-lg shadow-gray-900/20 text-white px-8 py-3 rounded-full font-bold transition-all hover:-translate-y-0.5">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection