<nav x-data="{ open: false }" class="bg-white shadow-md sticky top-0 z-50 border-b border-gray-100 py-4">
    @php
        if (auth()->check()) {
            $sessionCart = session('cart', []);
            $sessionItems = collect($sessionCart)->map(function($qty, $id) {
                $shoe = \App\Models\Shoe::find($id);
                return $shoe ? (object)['shoe' => $shoe, 'quantity' => $qty] : null;
            })->filter();
            $dbItems = auth()->user()->cartItems()->with('shoe')->get()->map(function($ci) {
                return (object)['shoe' => $ci->shoe, 'quantity' => $ci->quantity];
            });
            $allItems = $sessionItems->merge($dbItems);
            $cartCount = $allItems->sum('quantity');
            $cartTotal = $allItems->sum(fn($item) => $item->quantity * $item->shoe->price);
        } else {
            $sessionCart = session('cart', []);
            $cartCount = array_sum($sessionCart);
            $cartTotal = 0;
            foreach ($sessionCart as $id => $qty) {
                if ($shoe = \App\Models\Shoe::find($id)) {
                    $cartTotal += $shoe->price * $qty;
                }
            }
        }
    @endphp
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ Vite::asset('resources/images/Number One logo.png') }}" alt="Number One Logo" class="h-16 w-auto">
                    </a>
                </div>
                <!-- Quick Search -->
                <form action="{{ route('products') }}" method="GET" class="hidden sm:flex items-center ms-6">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                    />
                    <button type="submit" class="ml-2 text-gray-500 hover:text-green-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0a7 7 0 111.414-1.414L21 21z" />
                        </svg>
                    </button>
                </form>

                <!-- Navigation Links -->
                @if(!auth()->check() || auth()->user()->email !== 'admin@numberone.store')
                <div class="hidden space-x-8 sm:-my-px sm:ms-4 sm:flex">
                    <x-nav-link class="px-4 py-3 text-lg font-medium rounded-md hover:bg-gray-100 hover:text-green-600 transition" :href="route('home')" :active="request()->routeIs('home')">{{ __('Home') }}</x-nav-link>
                    <x-nav-link class="px-4 py-3 text-lg font-medium rounded-md hover:bg-gray-100 hover:text-green-600 transition" :href="route('products')" :active="request()->routeIs('products')">{{ __('Products') }}</x-nav-link>
                    <x-nav-link class="px-4 py-3 text-lg font-medium rounded-md hover:bg-gray-100 hover:text-green-600 transition" :href="route('categories')" :active="request()->routeIs('categories')">{{ __('Categories') }}</x-nav-link>
                    <x-nav-link class="px-4 py-3 text-lg font-medium rounded-md hover:bg-gray-100 hover:text-green-600 transition" :href="route('about')" :active="request()->routeIs('about')">{{ __('About') }}</x-nav-link>
                    <x-nav-link class="px-4 py-3 text-lg font-medium rounded-md hover:bg-gray-100 hover:text-green-600 transition" :href="route('contact')" :active="request()->routeIs('contact')">{{ __('Contact Us') }}</x-nav-link>
                    <x-nav-link class="px-4 py-3" :href="route('cart')" :active="request()->routeIs('cart')">
                        <div class="relative">
                            <img src="{{ Vite::asset('resources/svg/cart-shopping-svgrepo-com.svg') }}" class="h-8 w-8" alt="Cart">
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                            @endif
                        </div>
                        @if($cartCount > 0)
                            <span class="ml-2 text-sm font-medium">ETB {{ number_format($cartTotal, 2) }}</span>
                        @endif
                    </x-nav-link>
                    @auth
                        <x-nav-link class="px-4 py-3 flex items-center" :href="route('wishlist.index')" :active="request()->routeIs('wishlist.index')">
                            <span class="text-xl text-red-500">&#9825;</span>
                        </x-nav-link>
                    @endauth
                </div>
                @endif
                @if(auth()->check() && auth()->user()->email === 'admin@numberone.store')
                <div class="hidden space-x-4 sm:-my-px sm:ms-4 sm:flex ms-2">
                    <x-nav-link class="px-4 py-3 text-lg" :href="route('admin.shoes.index')" :active="request()->routeIs('admin.shoes*')">{{ __('Shoes') }}</x-nav-link>
                    <x-nav-link class="px-4 py-3 text-lg" :href="route('admin.users.index')" :active="request()->routeIs('admin.users*')">{{ __('Users') }}</x-nav-link>
                    <x-nav-link class="px-4 py-3 text-lg" :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders*')">{{ __('Orders') }}</x-nav-link>
                </div>
                @endif
            </div>
            @guest
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center p-2 text-gray-500 hover:text-gray-700">
                         
                                <img src="{{ Vite::asset('resources/svg/profile-circle-svgrepo-com.svg') }}" class="h-8 w-8" alt="Profile">
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('login')">{{ __('Login') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('register')">{{ __('Register') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endguest

            @auth
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                        <x-dropdown-link :href="route('orders.history')">
                            {{ __('My Orders') }}
                        </x-dropdown-link>
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
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
        <!-- Primary Mobile Nav Links -->
        <div class="pt-2 pb-3 space-y-1 border-b border-gray-200">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">{{ __('Home') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products')" :active="request()->routeIs('products')">{{ __('Products') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categories')" :active="request()->routeIs('categories*')">{{ __('Categories') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">{{ __('About') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">{{ __('Contact Us') }}</x-responsive-nav-link>
        </div>
        <!-- Cart & Wishlist -->
        <div class="pt-4 pb-1 border-b border-gray-200 space-y-1">
            <x-responsive-nav-link :href="route('cart')">
                {{ __('Cart') }} ({{ $cartCount }}) - ETB {{ number_format($cartTotal, 2) }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('wishlist.index')">{{ __('Wishlist') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('orders.history')">{{ __('My Orders') }}</x-responsive-nav-link>
            @endauth
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>
            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-responsive-nav-link>
                    </form>
                @endauth
                @guest
                    <x-responsive-nav-link :href="route('login')">{{ __('Login') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">{{ __('Register') }}</x-responsive-nav-link>
                @endguest
            </div>
        </div>
    </div>
</nav>
