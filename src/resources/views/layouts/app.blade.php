<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FashionablyLate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-lg font-semibold">FashionablyLate</h1>
        
        <nav class="flex items-center space-x-4">
            <a href="{{ route('contacts.create') }}" class="text-blue-600 hover:underline">Contact</a>
    @guest
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        @endif
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
    @else

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-blue-600 hover:underline">Logout</button>
        </form>
    @endguest
</nav>
    </header>

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
    </main>
    @yield('js')
</body>
</html>