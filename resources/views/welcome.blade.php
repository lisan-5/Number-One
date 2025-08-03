@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-400 to-blue-500 py-20 text-center text-white">
        <h1 class="text-5xl font-bold mb-4">Discover Your Next Favorite Tech</h1>
        <p class="text-xl mb-8">Browse our curated collection of electronics and accessories.</p>
        <a href="{{ route('products') }}" class="px-8 py-3 bg-white text-green-600 font-semibold rounded-md hover:bg-gray-100 transition">Shop Now</a>
    </div>

    <!-- Features Section -->
    <div class="container mx-auto py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                <svg class="h-12 w-12 mx-auto text-yellow-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z" /></svg>
                <h3 class="text-xl font-semibold mb-2">Wide Selection</h3>
                <p class="text-gray-600">Choose from a vast array of devices to suit your needs.</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                <svg class="h-12 w-12 mx-auto text-red-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <h3 class="text-xl font-semibold mb-2">Secure Payments</h3>
                <p class="text-gray-600">Fast and safe checkout with our secure payment system.</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" /></svg>
                <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
                <p class="text-gray-600">Get your products delivered to your door in no time.</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gray-100 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
            <p class="mb-6 text-gray-700">Subscribe to our newsletter for the latest deals.</p>
            <form x-data="{ done: false }" @submit.prevent="done = true" class="max-w-md mx-auto">
                <div x-show="!done" class="flex">
                    <input type="email" name="email" placeholder="Enter your email" class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none" required>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-r-md hover:bg-green-700 transition">Subscribe</button>
                </div>
                <div x-show="done" x-transition class="text-center text-green-600 font-semibold">Done!</div>
            </form>
        </div>
    </div>
@endsection