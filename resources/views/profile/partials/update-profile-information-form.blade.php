<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- biodata -->
        <!-- username ig -->
        <div>
            <x-input-label for="username_ig" :value="__('Username Instagram')" />
            <x-text-input id="username_ig" name="username_ig" type="text" class="mt-1 block w-full" :value="old('username_ig', $user->username_ig)" required autofocus autocomplete="username_ig" />
            <x-input-error class="mt-2" :messages="$errors->get('username_ig')" />
        </div>

        <!-- username tiktok -->
        <div>
            <x-input-label for="username_tiktok" :value="__('Username Tiktokoooo0')" />
            <x-text-input id="username_tiktok" name="username_tiktok" type="text" class="mt-1 block w-full" :value="old('username_tiktok', $user->username_tiktok)" required autofocus autocomplete="username_tiktok" />
            <x-input-error class="mt-2" :messages="$errors->get('username_tiktok')" />
        </div>

        <!-- nik -->
        <div>
            <x-input-label for="nik" :value="__('NIK')" />
            <x-text-input id="nik" name="nik" type="text" class="mt-1 block w-full" :value="old('nik', $user->nik)" required autofocus autocomplete="nik" />
            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
        </div>

        <!-- no wa -->
        <div>
            <x-input-label for="no_wa" :value="__('no_wa')" />
            <x-text-input id="no_wa" name="no_wa" type="text" class="mt-1 block w-full" :value="old('no_wa', $user->no_wa)" required autofocus autocomplete="no_wa" />
            <x-input-error class="mt-2" :messages="$errors->get('no_wa')" />
        </div>

        <!-- followers ig -->
        <div>
            <x-input-label for="followers_ig" :value="__('Username Instagram')" />
            <x-text-input id="followers_ig" name="followers_ig" type="text" class="mt-1 block w-full" :value="old('followers_ig', $user->followers_ig)" required autofocus autocomplete="followers_ig" />
            <x-input-error class="mt-2" :messages="$errors->get('followers_ig')" />
        </div>

        <!-- followers tiktok -->
        <div>
            <x-input-label for="followers_tiktok" :value="__('Followers Tiktok')" />
            <x-text-input id="followers_tiktok" name="followers_tiktok" type="text" class="mt-1 block w-full" :value="old('followers_tiktok', $user->followers_tiktok)" required autofocus autocomplete="followers_tiktok" />
            <x-input-error class="mt-2" :messages="$errors->get('followers_tiktok')" />
        </div>

        <!-- alamat -->
        <div>
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat', $user->alamat)" required autofocus autocomplete="alamat" />
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>