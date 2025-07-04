<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Game Haven Admin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" font-sans antialiased dark:bg-[#0f172a]">

    <!-- Optional Navigation (sidebar/nav) -->
    @include('layouts.navigation') {{-- bisa dikustom tampilannya nanti --}}

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-[#1f2937] border-b border-gray-700 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-white">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class=" dark:bg-[#0f172a] min-h-screen">
        @yield('content')
        {{-- This is where the main content of the page will be injected --}}
        {{-- For example, in customer/cart.blade.php, this will be replaced with the cart content --}}
        {{ $slot }}
    </main>
    @yield('scripts')
</body>
</html>
