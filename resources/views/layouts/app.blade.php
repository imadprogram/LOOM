<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Loom</title>
</head>
<body class="h-screen justify-center items-center">
    <header>
        @include('components.navbar')
    </header>
    <main>
        @yield('content')
    </main>

    @auth
        <a href="/messages" class="fixed bottom-8 right-8 bg-[#52c6be] text-white p-4 rounded-full shadow-lg shadow-[#52c6be]/30 hover:-translate-y-1 hover:shadow-[0_10px_20px_-5px_rgba(82,198,190,0.4)] transition-all z-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494h.02a3.002 3.002 0 002.818-2.885c.024-.269.048-.538.07-.807.027-.33.052-.656.074-.984.093-1.396.14-2.81.14-4.25s-.047-2.854-.14-4.25c-.022-.328-.047-.654-.074-.984a51.642 51.642 0 00-.07-.807A3.002 3.002 0 0018.068 2.5h-.02a48.282 48.282 0 00-5.68-.494 1.526 1.526 0 01-1.037.443L7.255 6.526v2.96c-1.108.086-2.206.209-3.293.369-1.584.233-2.707 1.626-2.707 3.228v.677z" />
            </svg>
        </a>
    @endauth
</body>
</html>