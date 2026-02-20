<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loom</title>
</head>
<body class="h-screen bg-black flex justify-center items-center">
    <form action="{{ route('signup') }}" method="post" class="rounded-lg px-4 py-2 bg-gray-400 flex flex-col gap-4 justify-center items-center">
        @csrf
        <input type="text" placeholder="your firstname" name="firstName">
        <input type="text" placeholder="your lastname" name="lastName">
        <input type="email" placeholder="your email" name="email">
        <input type="password" placeholder="your password" name="password">

        <button type="submit">signup</button>
    </form>
</body>
</html>