<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ Vite::asset('resources/images/Number One logo.png') }}" type="image/png">

        <title>Number One Brand</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            @if(session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                     class="fixed top-5 right-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500 z-50">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline"> {{ session('success') }} </span>
                </div>
            @endif
            @if(session('error'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                     class="fixed top-5 right-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500 z-50">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline"> {{ session('error') }} </span>
                </div>
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-12 bg-gray-100">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    @isset($slot)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white">
                                {{ $slot }}
                            </div>
                        </div>
                    @else
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white">
                                @yield('content')
                            </div>
                        </div>
                    @endisset
                </div>
            </main>
        </div>
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-10 mt-8">
            <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h4 class="text-xl font-semibold mb-4">About Number One Brand</h4>
                    <p>Number One Brand is a leader in premium footwear. Our curated collections feature everything from casual sneakers to elegant dress shoes, combining style, comfort, and durability. Every pair comes with a satisfaction guarantee and personalized fitting consultations to ensure you find the perfect fit.</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                        <li><a href="{{ route('products') }}" class="hover:underline">Products</a></li>
                        <li><a href="{{ route('categories') }}" class="hover:underline">Categories</a></li>
                        <li><a href="{{ route('about') }}" class="hover:underline">About</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:underline">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Follow Us</h4>
                    <div class="flex items-center space-x-4">
                        <a href="https://t.me/Numberonebrandfashion" target="_blank" class="hover:opacity-75">
                            <img src="{{ Vite::asset('resources/svg/telegram-svgrepo-com.svg') }}" class="h-6 w-6" alt="Telegram">
                        </a>
                        <a href="#" class="hover:opacity-75" aria-label="Instagram">
                            <img src="{{ Vite::asset('resources/svg/instagram-1-svgrepo-com.svg') }}" class="h-6 w-6" alt="Instagram">
                        </a>
                        <a href="https://www.tiktok.com/@numberonebrand1" target="_blank" class="hover:opacity-75">
                            <img src="{{ Vite::asset('resources/svg/tiktok-svgrepo-com.svg') }}" class="h-6 w-6" alt="TikTok">
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} Number One Brand. All rights reserved.
            </div>
        </footer>
    </body>
</html>
