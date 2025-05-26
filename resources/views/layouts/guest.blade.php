<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Game Haven') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800 antialiased dark:bg-gray-900">

    <div class="min-h-screen bg-cover bg-center flex items-center justify-center " style="background-image: url('{{ asset('images/background.png') }}');">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
