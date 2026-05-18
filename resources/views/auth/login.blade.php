<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - MOVI</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex">

    {{-- NAVBAR --}}
    <header class="absolute top-0 w-full px-10 py-6 flex justify-end z-20 
                   bg-white/10 backdrop-blur-md">
        <nav class="flex gap-4 text-sm">
            <a href="/"
                class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-200 hover:text-black transition">
                Home
            </a>

            <a href="{{ route('register') }}"
                class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-200 hover:text-black transition">
                Register
            </a>
        </nav>
    </header>

    {{-- LEFT (FORM) --}}
    <div class="w-1/2 flex items-center justify-center bg-white p-12">
        <div class="w-full max-w-md">

            <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email" name="email"
                        :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Remember --}}
                <!-- <div class="block mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm">
                        <span class="ms-2 text-sm text-gray-600">
                            Remember me
                        </span>
                    </label>
                </div> -->

                <div class="flex items-center justify-between mt-6">

                    <a href="{{ route('register') }}"
                        class="text-sm text-gray-600 hover:underline">
                        Don't have account?
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                        Log in
                    </button>

                </div>
            </form>

        </div>
    </div>

    {{-- RIGHT (IMAGE) --}}
    <div class="w-1/2">
        <img src="{{ asset('storage/abangnye.jpg') }}"
            class="w-full h-screen object-cover"
            alt="Login Banner">
    </div>

</body>

</html>