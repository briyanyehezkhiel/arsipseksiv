<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label-white for="email" :value="('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
<div class="mt-4">
    <x-input-label-white for="password" :value="('Password')" />

    <div class="relative">
        <input id="password"
               class="block mt-1 w-full pr-10 rounded-md shadow-sm border-gray-300 focus:ring focus:ring-opacity-50"
               type="password"
               name="password"
               required autocomplete="current-password" />

        <!-- Visibility Eye Icon -->
        <button type="button" id="togglePassword"
                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5
                         12 5c4.478 0 8.268 2.943 9.542 7
                         -1.274 4.057-5.064 7-9.542 7
                         -4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>



        <!-- Remember Me + Register -->
        <div class="flex items-center justify-between mt-4 flex-wrap gap-y-2 font-bold">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded bg-white border-white text-[#64481E] focus:ring-white focus:ring-2"
                       name="remember">
                <span class="ms-2 text-sm text-[#DDDDCB]">{{ __('Remember me') }}</span>
            </label>

            <div class="flex items-center space-x-4">
                <a class="underline text-sm text-[#DDDDCB] hover:text-[#FFFFFF] transition-colors duration-200"
                   href="{{ route('register') }}">
                    {{ __('Not have an account? Register') }}
                </a>
            </div>
        </div>

        <!-- Log in Button -->
        <div class="flex justify-center mt-6">
            <x-primary-button class="bg-[#64481E] text-white hover:bg-[#503A17] font-bold">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Toggle Password Visibility Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passwordInput = document.getElementById("password");
            const togglePassword = document.getElementById("togglePassword");
            const eyeIcon = document.getElementById("eyeIcon");

            let isVisible = false;

            togglePassword.addEventListener("click", function () {
                isVisible = !isVisible;
                passwordInput.type = isVisible ? "text" : "password";

                eyeIcon.innerHTML = isVisible
                    ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0
                            -8.268-2.943-9.542-7a9.956 9.956 0 012.284-3.818
                            m1.768-1.609A9.956 9.956 0 0112 5c4.478 0
                            8.268 2.943 9.542 7a9.953 9.953 0 01-4.137 5.167
                            M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18" />`
                    : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5
                               12 5c4.478 0 8.268 2.943 9.542 7
                               -1.274 4.057-5.064 7-9.542 7
                               -4.477 0-8.268-2.943-9.542-7z" />`;
            });
        });
    </script>
</x-guest-layout>
