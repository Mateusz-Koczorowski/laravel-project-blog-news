<nav x-data="{ open: false }" class="bg-slate-200 opacity-85 dark:bg-sky-950 border-b border-gray-100 dark:border-gray-700 relative z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl max-h-32 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{asset('logos/logo.png')}}" class="block h-20 w-auto fill-current text-gray-800 dark:text-gray-200" alt="Blog news">
                    </a>
                </div>

                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link >
                    <div class="text-gray-700 dark:text-gray-300 font-semibold text-xl">InfoSphere</div>
                </x-nav-link>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home Page') }}
                    </x-nav-link>
                </div>

                @if (Auth::check())
                    @if (Auth::user()->role === 'Admin')
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Admin Dashboard') }}
                            </x-nav-link>
                        </div>
                    @endif

                    @if (Auth::user()->role === 'Author')
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('author.dashboard')" :active="request()->routeIs('author.dashboard')">
                                {{ __('Author Dashboard') }}
                            </x-nav-link>
                        </div>
                    @endif

                    @if(Auth::check() && Auth::user()->isReader())
                        <x-nav-link :href="route('subscriptions.index')" :active="request()->routeIs('subscriptions.index')">
                            {{ __('Purchase Subscription') }}
                        </x-nav-link>
                    @endif
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center space-x-4">
                    <label for="dark-mode-toggle" class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="dark-mode-toggle" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-500 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:peer-checked:bg-gray-900"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Dark Mode</span>
                    </label>
                </div>
                

                <div class="space-x-8 mr-5 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link >
                    <div id="live-clock" class="text-gray-700 dark:text-gray-300 text-sm font-medium"></div>
                </x-nav-link>
                </div>

                @if (Auth::check())
                    <x-dropdown align="right" width="48" class="z-50">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden z-99">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home Page') }}
            </x-responsive-nav-link>

            @if (Auth::check())
                @if (Auth::user()->role === 'Admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin Dashboard') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role === 'Author')
                    <x-responsive-nav-link :href="route('author.dashboard')" :active="request()->routeIs('author.dashboard')">
                        {{ __('Author Dashboard') }}
                    </x-responsive-nav-link>
                @endif

                @if(Auth::check() && Auth::user()->isReader())
                        <x-nav-link :href="route('subscriptions.index')" :active="request()->routeIs('subscriptions.index')">
                            {{ __('Purchase Subscription') }}
                        </x-nav-link>
                @endif
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @if (Auth::check())
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const clockElement = document.getElementById('live-clock');
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
        }
        // Initialize clock
        updateClock();
        // Update every second
        setInterval(updateClock, 1000);
    });
</script>