@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6 text-green-800">My Wishlist</h1>
    @if($items->isEmpty())
        <p class="text-gray-600">Your wishlist is empty.</p>
        <a href="{{ route('products') }}" class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Browse Products</a>
    @else
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-green-50 text-green-800 uppercase text-sm">
                        <th class="px-6 py-3 text-left">Product</th>
                        <th class="px-6 py-3 text-left">Price</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4 flex items-center">
                                @if(!empty($item->shoe->images) && count($item->shoe->images))
                                    <img src="{{ asset('storage/' . $item->shoe->images[0]) }}" alt="{{ $item->shoe->name }}" class="h-12 w-12 object-cover rounded mr-4">
                                @else
                                    <div class="h-12 w-12 bg-gray-200 rounded mr-4"></div>
                                @endif
                                <span class="font-medium">{{ $item->shoe->name }}</span>
                            </td>
                            <td class="px-6 py-4">ETB {{ number_format($item->shoe->price, 2) }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <form action="{{ route('wishlist.toggle', $item->shoe) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md transition">Remove</button>
                                </form>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="shoe_id" value="{{ $item->shoe->id }}">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md transition">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $items->links() }}
        </div>
    @endif
</div>
@endsection
