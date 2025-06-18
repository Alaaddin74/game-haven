<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Game Haven</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-100">
    <header class="bg-white shadow-md dark:bg-gray-800 dark:shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-600 dark:text-red-400">Game Haven</h1>
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-gray-700 dark:text-gray-100 font-semibold hover:text-red-600 dark:hover:text-red-400">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-700 dark:text-gray-100 font-semibold hover:text-red-600 dark:hover:text-red-400">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-gray-700 dark:text-gray-100 font-semibold hover:text-red-600 dark:hover:text-red-400">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <main class="mt-10 max-w-7xl mx-auto px-6">
        <!-- Hero Section -->
        <section class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-800 dark:text-white mb-4">Surga Belanja untuk Gamer</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                Temukan game dan konsol impianmu dengan sistem loyalty points eksklusif hanya di Game Haven.
            </p>
            <a href="{{ route('register') }}"
                class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                Gabung Sekarang
            </a>
        </section>

        <!-- Product Category Boxes -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Box: Game -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 text-center hover:shadow-lg transition">
                <img 
                src="{{ asset('images/game.jpg') }}" 
                alt="Game PS5" 
                class="h-40 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl mb-2">Game</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Kaset original untuk PlayStation, Xbox, dan Nintendo Switch.
                </p>
            </div>

            <!-- Box: Konsol -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 text-center hover:shadow-lg transition">
                <img 
                src="{{ asset('images/console.jpg') }}" 
                alt="Game PS5" 
                class="h-40 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl mb-2">Konsol</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Dapatkan konsol resmi terbaru dengan garansi.
                </p>
            </div>

            <!-- Box: Aksesoris -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 text-center hover:shadow-lg transition">
                <img 
                src="{{ asset('images/accesories.webp') }}" 
                alt="Game PS5" 
                class="h-40 w-full object-cover rounded mb-4">
                <h3 class="font-bold text-xl mb-2">Aksesoris</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Controller, headset, dan perangkat gaming lainnya.
                </p>
            </div>
        </section>
    </main>

    <footer class="mt-20 text-center text-sm text-gray-500 dark:text-gray-400 py-6">
        © {{ date('Y') }} Game Haven — All rights reserved.
    </footer>
</body>

</html>
