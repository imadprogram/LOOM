@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Create an Account</h2>
            <p class="text-gray-500 font-medium mt-2">Join Loom and start selling today.</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="ml-3">
                        <ul class="text-sm text-red-700 font-medium space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('submit.signup') }}" method="post" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="firstName" class="block text-sm font-bold text-gray-700 mb-1">First Name</label>
                    <input id="firstName" name="firstName" type="text" required 
                           value="{{ old('firstName') }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 transition-all outline-none bg-gray-50 focus:bg-white" 
                           placeholder="John">
                </div>
                <div>
                    <label for="lastName" class="block text-sm font-bold text-gray-700 mb-1">Last Name</label>
                    <input id="lastName" name="lastName" type="text" required 
                           value="{{ old('lastName') }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 transition-all outline-none bg-gray-50 focus:bg-white" 
                           placeholder="Doe">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                       value="{{ old('email') }}"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 transition-all outline-none bg-gray-50 focus:bg-white" 
                       placeholder="john@example.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                <input id="password" name="password" type="password" required 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 transition-all outline-none bg-gray-50 focus:bg-white" 
                       placeholder="••••••••">
                <p class="text-xs text-gray-400 font-medium mt-2">Must be at least 8 characters.</p>
            </div>

            <button type="submit" class="w-full h-14 bg-[#52c6be] hover:bg-[#42a8a1] text-white font-bold rounded-xl transition-all hover:-translate-y-0.5 shadow-lg mt-4">
                Create Account
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-500 font-medium">
            Already have an account? 
            <a href="/login" class="font-bold text-gray-900 hover:underline ml-1">Sign in instead</a>
        </div>
    </div>
</div>
@endsection