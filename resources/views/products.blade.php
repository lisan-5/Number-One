@extends('layouts.app')

@section('title', 'Products')

@section('content')
<!-- Hero Banner -->
<div class="bg-green-50 py-8 mb-8">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold text-green-800 mb-2">{{ isset($tag) ? ucfirst($tag) . ' Collection' : 'All Products' }}</h1>
        <p class="text-gray-600">{{ isset($tag) ? 'Explore our best ' . $tag . ' products.' : 'Discover our latest arrivals and offers.' }}</p>
    </div>
</div>
<div class="container mx-auto py-10 space-y-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-semibold mb-6">Products</h1>
    @php $action = isset($tag) ? route('products.tag', $tag) : route('products'); @endphp
    <div class="bg-white p-4 rounded shadow mb-6">
        <form method="GET" action="{{ $action }}" class="flex flex-wrap items-center gap-4">
            <select name="sort" class="border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
            <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Newest</option>
            <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
        </select>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">Sort</button>
    </form>

    @if(session('success'))
        <div class="mb-4 text-green-600 text-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($shoes->isEmpty())
        <p class="text-gray-600">No products found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($shoes as $shoe)
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transform hover:scale-105 transition duration-300">
                    @if(!empty($shoe->images) && count($shoe->images))
                        <a href="{{ route('products.show', $shoe) }}">
                            <img src="{{ asset('storage/' . $shoe->images[0]) }}" alt="{{ $shoe->name }}" class="w-full h-64 object-cover transform transition duration-300 hover:scale-105 hover:rotate-3">
                        </a>
                    @else
                        <a href="{{ route('products.show', $shoe) }}">
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        </a>
                    @endif
                    <div class="p-6 grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <h2 class="text-lg font-semibold">{{ $shoe->name }}</h2>
                            <p class="text-gray-600">{{ $shoe->description }}</p>
                            <p class="text-gray-600">Size: {{ $shoe->size }}</p>
                            @if(!empty($shoe->tags))
                                <div class="flex flex-wrap gap-2">
                                    @foreach($shoe->tags as $tag)
                                        <a href="{{ route('products.tag', $tag) }}" class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded hover:bg-blue-200 transition">
                                            {{ $tag }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col justify-between items-end">
                            <p class="text-green-800 font-bold text-xl">ETB {{ number_format($shoe->price, 2) }}</p>
                            @unless(session('cart')[$shoe->id] ?? false)
                                <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="shoe_id" value="{{ $shoe->id }}">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded transition-colors duration-200 flex items-center justify-center">
                                        <img src="{{ Vite::asset('resources/svg/cart-shopping-svgrepo-com.svg') }}" class="h-5 w-5 mr-2" alt="Cart" />
                                        Add to Cart
                                    </button>
                                </form>
                            @endunless
                            @auth
                                <form action="{{ route('wishlist.toggle', $shoe) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-xl text-red-500 hover:text-red-700 focus:outline-none">
                                        @if(auth()->user()->wishlist()->where('shoe_id', $shoe->id)->exists())
                                            &#10084; {{-- filled heart --}}
                                        @else
                                            &#9825; {{-- empty heart --}}
                                        @endif
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
             @endforeach
         </div>
         <div class="mt-6">
             {{ $shoes->links() }}
         </div>
     @endif
 </div>
@endsection
