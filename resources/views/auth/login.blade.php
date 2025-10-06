<x-guest-layout>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-white to-blue-50">

    <div class="w-full max-w-sm bg-white shadow-2xl rounded-xl p-8 space-y-6">
      <!-- Logo & Judul -->
      <div class="text-center">
        <img src="{{ asset('assets/images/germas.png') }}" alt="Logo Germas" class="mx-auto h-16 mb-3">
        <h1 class="text-xl font-bold text-blue-700 tracking-wide">DUK Dinkes Kampar</h1>
        <p class="text-sm text-gray-500 italic">Silakan login untuk melanjutkan</p>
      </div>

      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <!-- Form Login -->
      <form method="POST" action="{{ route('login') }}" class="space-y-4 text-center">
        @csrf

        <!-- Email -->
        <div>
          <x-input-label for="email" :value="__('Email')" class="text-left" />
          <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
            class="block mt-1 w-full max-w-xs mx-auto" placeholder="Masukkan email" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
          <x-input-label for="password" :value="__('Password')" class="text-left" />
          <x-text-input id="password" type="password" name="password" required
            class="block mt-1 w-full max-w-xs mx-auto" placeholder="Masukkan password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
          <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox"
              class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
              name="remember">
            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
          </label>
        </div>

        <!-- Tombol Login -->
        <div class="mt-4">
          <x-primary-button class="w-full max-w-xs mx-auto justify-center text-center">
            {{ __('Login') }}
          </x-primary-button>
        </div>
      </form>

      <!-- Footer -->
      <div class="text-center text-xs text-gray-400 pt-4 border-t">
        © {{ date('Y') }} Dinas Kesehatan Kampar
      </div>
    </div>

  </div>
</x-guest-layout>
