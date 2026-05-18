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

            <a href="{{ route('login') }}"
               class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-200 hover:text-black transition">
                Login
            </a>
        </nav>
    </header>

    {{-- LEFT (FORM) --}}
    <div class="w-1/2 flex items-center justify-center bg-white p-12">
        <div class="w-full max-w-lg">

        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

            <!-- Name -->
            <div>
                <x-input-label for="name" value="Nama Lengkap" />
                <x-text-input id="name" class="block mt-1 w-full"
                    type="text" name="name"
                    :value="old('name')" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" class="block mt-1 w-full"
                    type="email" name="email"
                    :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Instagram -->
            <div>
                <x-input-label for="username_ig" value="Username Instagram" />
                <x-text-input id="username_ig" class="block mt-1 w-full"
                    type="text" name="username_ig"
                    :value="old('username_ig')" required />
                <x-input-error :messages="$errors->get('username_ig')" class="mt-2" />
            </div>

            <!-- Tiktok -->
            <div>
                <x-input-label for="username_tiktok" value="Username TikTok" />
                <x-text-input id="username_tiktok" class="block mt-1 w-full"
                    type="text" name="username_tiktok"
                    :value="old('username_tiktok')" required />
                <x-input-error :messages="$errors->get('username_tiktok')" class="mt-2" />
            </div>

            <!-- NIK -->
            <div>
                <x-input-label for="nik" value="NIK" />
                <x-text-input id="nik" class="block mt-1 w-full"
                    type="text" name="nik"
                    :value="old('nik')" required />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>

            <!-- WhatsApp -->
            <div>
                <x-input-label for="no_wa" value="No. WhatsApp" />
                <x-text-input id="no_wa" class="block mt-1 w-full"
                    type="text" name="no_wa"
                    :value="old('no_wa')" required />
                <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
            </div>

            <!-- Followers IG -->
            <div>
                <x-input-label for="followers_ig" value="Followers Instagram" />
                <x-text-input id="followers_ig" class="block mt-1 w-full"
                    type="number" name="followers_ig"
                    :value="old('followers_ig')" required />
                <x-input-error :messages="$errors->get('followers_ig')" class="mt-2" />
            </div>

            <!-- Followers TikTok -->
            <div>
                <x-input-label for="followers_tiktok" value="Followers TikTok" />
                <x-text-input id="followers_tiktok" class="block mt-1 w-full"
                    type="number" name="followers_tiktok"
                    :value="old('followers_tiktok')" required />
                <x-input-error :messages="$errors->get('followers_tiktok')" class="mt-2" />
            </div>

        </div>

        <!-- Alamat Full Width -->
        <div>
            <x-input-label for="alamat" value="Alamat" />
            <x-text-input id="alamat" class="block mt-1 w-full"
                type="text" name="alamat"
                :value="old('alamat')" required />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <!-- Referal -->
        <div>
            <x-input-label for="referal" value="Referal (username IG)" />
            <x-text-input id="referal" class="block mt-1 w-full"
                type="text" name="referal"
                :value="old('referal')" />
            <x-input-error :messages="$errors->get('referal')" class="mt-2" />
        </div>

        <!-- Password Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" value="Confirm Password" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                    type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Footer -->
        <div class="flex items-center justify-between pt-4">
            <a class="text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <x-primary-button>
                Register
            </x-primary-button>
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