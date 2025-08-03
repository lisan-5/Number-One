@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <div class="container mx-auto py-10">
        @if(session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline"> {{ session('success') }} </span>
            </div>
        @endif

        <h1 class="text-3xl font-semibold mb-6">Shopping Cart</h1>

        <!-- Cart Items -->
        <div class="overflow-x-auto bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-green-800 border-b pb-2">Shopping Cart</h2>
            @if($items->isEmpty())
                <p class="text-center text-gray-600">Your cart is empty. Add some products to get started.</p>
            @else
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-green-50 text-green-800 uppercase text-sm">
                            <th class="px-6 py-3">Product</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">{{ $item->shoe->name }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="shoe_id" value="{{ $item->shoe->id }}">
                                            <button type="submit" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
                                        </form>
                                        <span>{{ $item->quantity }}</span>
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="shoe_id" value="{{ $item->shoe->id }}">
                                            <button type="submit" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4">ETB {{ number_format($item->shoe->price, 2) }}</td>
                                <td class="px-6 py-4">ETB {{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div><!-- Products will appear here when added --></div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>ETB {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-semibold text-lg">
                        <span>Total</span>
                        <span>ETB {{ number_format($total, 2) }}</span>
                    </div>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="w-full mt-6 block bg-blue-600 text-white py-2 rounded-md text-center">Proceed to Checkout</a>
                @else
                    <a href="{{ route('checkout.create') }}" class="w-full mt-6 block bg-blue-600 text-white py-2 rounded-md text-center">Proceed to Checkout</a>
                @endguest
            </div>
        </div>

        <div class="mt-8 p-6 bg-gray-100 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Need Help? Contact Me</h2>
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <span class="text-xl">📱</span>
                    <span>Telegram: <a href="https://t.me/Numberonebrandfashion" class="text-blue-600 hover:underline">@Numberonebrandfashion</a></span>
                </div>
                
            </div>
            <p class="mt-4 text-gray-600">Feel free to reach out for any questions about your order or our products!</p>
        </div>
    </div>
@endsection
