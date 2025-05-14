<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-black">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-black">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>

            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative">
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full pr-10" autocomplete="current-password" />
                <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 toggle-password" data-target="update_password_current_password">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path class="eye-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path class="eye-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5
                                 12 5c4.478 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.064 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div>

            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative">
                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full pr-10" autocomplete="new-password" />
                <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 toggle-password" data-target="update_password_password">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path class="eye-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path class="eye-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5
                                 12 5c4.478 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.064 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>

            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full pr-10" autocomplete="new-password" />
                <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 toggle-password" data-target="update_password_password_confirmation">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path class="eye-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path class="eye-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5
                                 12 5c4.478 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.064 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-black"
                >{{ __('Saved.') }}</p>

            @endif
        </div>
    </form>

    <!-- Password Toggle Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButtons = document.querySelectorAll(".toggle-password");

            toggleButtons.forEach(button => {
                const targetId = button.getAttribute("data-target");
                const input = document.getElementById(targetId);

                let isVisible = false;

                button.addEventListener("click", () => {
                    isVisible = !isVisible;
                    input.type = isVisible ? "text" : "password";

                    const svg = button.querySelector("svg");
                    svg.innerHTML = isVisible
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
        });
    </script>
</section>
