<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <x-application-logo />
        </x-slot>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-label for="data" :value="__('Email / Username')" class="text-blue-gray-600" />
                <x-input id="data" class="block mt-1 w-full placeholder-gray-400 focus:border-violet-600 focus:ring-violet-300" type="text" name="data"
                    :value="old('data')" placeholder="Masukan username atau email" required autofocus />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" class="text-blue-gray-600" />
                <x-input id="password" class="block mt-1 w-full placeholder-gray-400 focus:border-violet-600 focus:ring-violet-300" type="password" name="password"
                    placeholder="Masukan Password" required autocomplete="current-password" />
            </div>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-violet-600 shadow-sm focus:border-violet-300 focus:ring focus:ring-violet-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-blue-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-violet-400 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-violet-500 focus:outline-none focus:border-violet-500 focus:ring ring-violet-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
