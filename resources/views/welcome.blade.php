<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="flex min-h-screen flex-col items-center justify-center">
        <h1 class="text-5xl font-bold text-blue-500">
            My Gym App
        </h1>
        @auth
            <a href="{{ route('dashboard') }}"
                class="mt-6 rounded-lg bg-blue-600 px-6 py-3 text-white transition hover:bg-blue-700">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
                class="mt-6 rounded-lg bg-blue-600 px-6 py-3 text-white transition hover:bg-blue-700">
                Login
            </a>
             <a href="{{ route('register') }}"
                class="mt-6 rounded-lg bg-rose-600 px-6 py-3 text-white transition hover:bg-rose-700">
                Register
            </a>
        @endauth
    </div>
</body>

</html>
