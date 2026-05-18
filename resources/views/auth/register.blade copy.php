<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

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
            <x-input-label for="referal" value="Kode Referal (Opsional)" />
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
</x-guest-layout>