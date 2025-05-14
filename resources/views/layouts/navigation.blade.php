
<nav x-data="{ open: false }" class="bg-white dark:bg-white border-b border-gray-100 dark:border-gray-700">
    <div class="w-full px-0 sm:px-0 lg:px-0">
        <!-- Wrapper utama -->
        <div class="flex justify-between items-center h-16 w-full px-4">
           <!-- Kiri: Logo + Tulisan Dashboard -->
        <div class="relative flex items-center space-x-2 sm:space-x-4 ml-[-3rem] sm:ml-0 top-[-1rem] sm:top-0">
            <a href="{{ route('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 stroke-black dark:stroke-black transition-all duration-300 hover:bg-gray-200 hover:scale-105 hover:shadow-lg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>

            </a>
            <span class="text-lg font-semibold text-gray-800 dark:text-black mt-[28px] sm:mt-0">
                Profile
            </span>
        </div>


            <!-- Kanan: Dropdown -->
            <div class="hidden sm:flex sm:items-center space-x-6 mr-20">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-black bg-white hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" class="text-black hover:bg-[#DBD2AF]" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
            </x-slot>

                </x-dropdown>
            </div>

            <!-- Kanan: Hamburger -->
            <div class="sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-200 hover:text-gray-500 hover:bg-[#361D00] dark:hover:bg-[#361D00] focus:outline-none focus:bg-[#361D00] focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 text-center">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="dark:text-white hover:bg-[#361D00]">
                {{ __('Profile') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-black-600">
            <div class="px-4 text-center">
                <div class="font-medium text-base text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-white">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="dark:text-white hover:bg-[#DBD2AF]" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
