<a
    href="{{ route('filament.pages.dashboard') }}"
    class="filament-sidebar-brandbox flex items-center px-6 py-4 space-x-3"
>
    {{-- Logo --}}
    <img
        src="{{ $logoUrl ?? asset('images/logo.png') }}"
        alt="{{ $name }}"
        class="h-8 w-auto"
    />

    {{-- Nama brand teks di sampingnya --}}
    <span class="text-lg font-semibold tracking-tight text-gray-900 dark:text-gray-100">
        {{ $name }}
    </span>
</a>
