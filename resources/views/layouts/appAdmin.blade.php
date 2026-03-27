<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Loom Admin</title>
</head>
<body class="bg-gray-50 flex">
    
    @include('components.adminSideBar')
    
    <main class="flex-1 ml-64 p-8 min-h-screen overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>
