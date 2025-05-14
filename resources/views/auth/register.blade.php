<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label-white for="name" :value="__('Username')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label-white for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label-white for="password" :value="__('Password')" />
            <div class="relative">
                <input id="password" type="password" name="password"
                    class="block mt-1 w-full pr-10 rounded-md shadow-sm border-gray-300 focus:ring focus:ring-opacity-50"
                    required autocomplete="new-password" />

                <!-- Eye icon -->
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

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label-white for="password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="block mt-1 w-full pr-10 rounded-md shadow-sm border-gray-300 focus:ring focus:ring-opacity-50"
                    required autocomplete="new-password" />

                <!-- Eye icon -->
                <button type="button" id="toggleConfirmPassword"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg id="confirmEyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
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
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Already Registered -->
        <div class="flex justify-end mt-4">
            <a class="underline font-bold text-sm text-[#DDDDCB] hover:text-[#FFFFFF] transition-colors duration-200 rounded-md focus:outline-none"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

        <!-- Register Button -->
        <div class="flex justify-center mt-4">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Password Toggle Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function setupToggle(buttonId, inputId, iconId) {
                const input = document.getElementById(inputId);
                const button = document.getElementById(buttonId);
                const icon = document.getElementById(iconId);

                let isVisible = false;

                button.addEventListener("click", function () {
                    isVisible = !isVisible;
                    input.type = isVisible ? "text" : "password";

                    icon.innerHTML = isVisible
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
            }

            setupToggle("togglePassword", "password", "eyeIcon");
            setupToggle("toggleConfirmPassword", "password_confirmation", "confirmEyeIcon");
        });
    </script>
</x-guest-layout>
