<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Suspended</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center p-4">
    
    <div class="max-w-md w-full bg-white rounded-3xl border border-red-100 shadow-xl overflow-hidden text-center p-8">
        
        <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 text-red-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" />
            </svg>
        </div>

        <h1 class="text-3xl font-black text-gray-900 mb-2">Account Suspended</h1>
        
        <p class="text-gray-500 font-medium mb-8 leading-relaxed">
            Your account has been permanently banned by an administrator due to violations of our community guidelines. You can no longer buy, sell, or send messages on Loom.
        </p>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="w-full h-14 bg-gray-900 hover:bg-gray-800 text-white font-bold rounded-full transition-all hover:-translate-y-0.5 shadow-lg">
                Log Out
            </button>
        </form>

    </div>

</body>
</html>
