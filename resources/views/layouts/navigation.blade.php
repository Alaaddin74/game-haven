<nav x-data="{ open: false }" class="bg-white dark:bg-[#0f172a] border-b border-gray-200 dark:border-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo + Title -->
            <div class="flex items-center">
                <span class="text-xl font-extrabold tracking-wide text-red-600 dark:text-cyan-400">🎮 Game Haven</span>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-gray-800 dark:text-white hover:text-red-600 dark:hover:text-cyan-400">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('customer.cart')" :active="request()->routeIs('customer.cart')"
                        class="text-gray-800 dark:text-white hover:text-red-600 dark:hover:text-cyan-400">
                        🛒 {{ __('Keranjang') }}
                    </x-nav-link>

                    <x-nav-link :href="route('rewards.index')" :active="request()->routeIs('rewards.index')"
                        class="text-gray-800 dark:text-white hover:text-red-600 dark:hover:text-cyan-400">
                    🎁 {{ __('Rewards') }}
                    </x-nav-link>

                </div>


            </div>

            <div class="hidden sm:flex sm:items-center space-x-4">
    <div class="text-sm font-semibold text-gray-800 dark:text-white">
        ⭐ Poin: {{ $loyaltyPoints ?? 0 }}
    </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-800 dark:text-white bg-gray-100 dark:bg-[#1e293b] hover:bg-gray-200 dark:hover:bg-[#334155] transition duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-red-600 dark:text-cyan-400 hover:bg-gray-100 dark:hover:bg-[#1e293b] focus:outline-none transition">
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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-gray-50 dark:bg-[#1e293b] border-t border-gray-200 dark:border-gray-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-gray-800 dark:text-white hover:text-red-600 dark:hover:text-cyan-400">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('customer.cart')" :active="request()->routeIs('customer.cart')"
                class="text-gray-800 dark:text-white hover:text-red-600 dark:hover:text-cyan-400">
                🛒 {{ __('Keranjang') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('rewards.index')" :active="request()->routeIs('rewards.index')"
                class="text-gray-800 dark:text-white hover:text-red-600 dark:hover:text-cyan-400">
                    🎁 {{ __('Rewards') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-300 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="text-gray-800 dark:text-white hover:text-red-600 dark:hover:text-cyan-400">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-gray-800 dark:text-white hover:text-red-600 dark:hover:text-cyan-400">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
