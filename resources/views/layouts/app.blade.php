<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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
        @php
            $hasUnreadMessages = \App\Models\Message::where('receiver_id', auth()->id())
                ->where('is_read', false)
                ->exists();
        @endphp
        <a href="/messages"
            class="fixed bottom-8 right-8 bg-[#52c6be] text-white p-4 rounded-full shadow-lg shadow-[#52c6be]/30 hover:-translate-y-1 hover:shadow-[0_10px_20px_-5px_rgba(82,198,190,0.4)] transition-all z-50 group">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494h.02a3.002 3.002 0 002.818-2.885c.024-.269.048-.538.07-.807.027-.33.052-.656.074-.984.093-1.396.14-2.81.14-4.25s-.047-2.854-.14-4.25c-.022-.328-.047-.654-.074-.984a51.642 51.642 0 00-.07-.807A3.002 3.002 0 0018.068 2.5h-.02a48.282 48.282 0 00-5.68-.494 1.526 1.526 0 01-1.037.443L7.255 6.526v2.96c-1.108.086-2.206.209-3.293.369-1.584.233-2.707 1.626-2.707 3.228v.677z" />
                </svg>
                <span id="unread-dot"
                    class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-red-500 border-2 border-white rounded-full {{ $hasUnreadMessages ? '' : 'hidden' }}"></span>
            </div>
        </a>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                setTimeout(() => {
                    if (window.Echo) {
                        window.Echo.private(`messages.{{ auth()->id() }}`).listen('MessageSent', (e) => {
                            // If we receive any message anywhere on the site, show the red dot!
                            const dot = document.getElementById('unread-dot');
                            if (dot) dot.classList.remove('hidden');
                        });
                    }
                }, 1000);
            });

        </script>
        

            @if (session('error') || session('status'))
                <script>
                            Toastify({
                                text: "{{ session('error') ?? session('status') }}",
                                duration: 4000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                                style: {
                                    background: "{{ session('error') ? '#ef4444' : '#52c6be' }}",
                                    borderRadius: "15px",
                                    fontWeight: "bold",
                                },
                            }).showToast();
                </script>
            @endif
    @endauth
</body>

</html>
