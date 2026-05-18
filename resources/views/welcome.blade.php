<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MOVIVERSE') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col">

    {{-- Navigation --}}
    {{-- Navigation --}}
    @if (Route::has('login'))
    <header class="absolute top-0 w-full px-10 py-6 flex justify-end z-20 
                   bg-white/10 backdrop-blur-md">
        <nav class="flex gap-4 text-sm">
            @auth
            <a href="{{ url('/dashboard') }}"
                class="px-4 py-2 border border-white text-white rounded-lg hover:bg-white hover:text-black transition">
                Dashboard
            </a>
            @else
            <a href="{{ route('login') }}"
                class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-200 hover:text-black transition">
                Login
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-200 hover:text-black transition">
                Register
            </a>
            @endif
            @endauth
        </nav>
    </header>
    @endif

    {{-- Main --}}
    <div class="flex flex-1">

        {{-- LEFT --}}
        <div class="w-1/2 flex items-center justify-center bg-white p-12">
            <div class="text-center max-w-md">

                <img src="{{ asset('storage/black.png') }}"
                    alt="Logo"
                    class="mx-auto mb-8 w-full">

                <h1 class="text-3xl font-bold mb-4">
                    Welcome to MOVI
                </h1>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    MOVI menawarkan program berjenjang yang memberikan banyak keuntungan.
                    Semakin konsisten menjalankan misi, semakin besar reward yang kamu dapatkan.
                </p>

                <a href="{{ route('register') }}" target="_blank" class="inline-block bg-gradient-to-r from-[#F62DFD] to-white dark:border-[#eeeeec] dark:text-[#f9f9f8] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-12 py-1.5 bg-[#1b1b18] border-black text-white text-2xl leading-normal rounded-2xl "> Join now </a>

            </div>
        </div>

        {{-- RIGHT --}}
        <div class="w-1/2 relative">
            <img src="{{ asset('storage/abangnye.jpg') }}"
                alt="Banner"
                class="w-full h-screen object-cover">

            {{-- Overlay biar nav kebaca --}}
            <!-- <div class="absolute inset-0 bg-black/40"></div> -->
        </div>

    </div>

</body>

</html>