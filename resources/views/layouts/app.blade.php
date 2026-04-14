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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
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
