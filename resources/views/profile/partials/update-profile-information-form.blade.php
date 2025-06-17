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
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->nama)" required autofocus autocomplete="nama" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
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

        <div>
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat', $user->alamat)" required autocomplete="alamat" />
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div>
            <x-input-label for="no_ktp" :value="__('No KTP')" />
            <x-text-input id="no_ktp" name="no_ktp" type="text" class="mt-1 block w-full" :value="old('no_ktp', $user->no_ktp)" required autocomplete="no_ktp" />
            <x-input-error class="mt-2" :messages="$errors->get('no_ktp')" />
        </div>

        <div>
            <x-input-label for="no_hp" :value="__('No HP')" />
            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->no_hp)" required autocomplete="no_hp" />
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
        </div>

        @if ($user->role === 'dokter')
            <div>
                <x-input-label for="id_poli" :value="__('Poli')" />
                <select id="id_poli" name="id_poli" class="mt-1 block w-full rounded border-gray-300">
                    <option value="">-- Pilih Poli --</option>
                    @foreach($polis as $poli)
                        <option value="{{ $poli->id }}" {{ old('id_poli', $user->id_poli) == $poli->id ? 'selected' : '' }}>
                            {{ $poli->nama }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('id_poli')" />
            </div>
        @endif

        @if ($user->role === 'pasien')
            <div>
                <x-input-label for="no_rm" :value="__('No RM')" />
                <x-text-input id="no_rm" name="no_rm" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->no_rm" disabled readonly />
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
