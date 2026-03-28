@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Welcome back</h2>
            <p class="text-gray-500 font-medium mt-2">Log in to your Loom account</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
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
        <form action="{{ route('submit.login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                       value="{{ old('email') }}"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 transition-all outline-none bg-gray-50 focus:bg-white" 
                       placeholder="john@example.com">
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                    <a href="#" class="text-sm font-bold text-[#52c6be] hover:underline">Forgot password?</a>
                </div>
                <input id="password" name="password" type="password" autocomplete="current-password" required 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#52c6be] focus:ring-2 focus:ring-[#52c6be]/20 transition-all outline-none bg-gray-50 focus:bg-white" 
                       placeholder="••••••••">
            </div>

            <button type="submit" class="w-full h-14 bg-gray-900 hover:bg-gray-800 text-white font-bold rounded-xl transition-all hover:-translate-y-0.5 shadow-lg">
                Sign In
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-500 font-medium">
            Don't have an account? 
            <a href="/signup" class="font-bold text-[#52c6be] hover:underline ml-1">Sign up for free</a>
        </div>
    </div>
</div>
@endsection