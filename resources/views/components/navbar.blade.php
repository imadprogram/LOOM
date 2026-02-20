<nav class="w-full bg-red-400 flex justify-between px-10 text-4xl py-2">
    <h1>Loom</h1>
    <div class="flex gap-4">
        <input type="checkbox">
        <form action="{{ route('logout') }}" method="post">
            <button class="btn">Logout</button>
        </form>
    </div>
</nav>