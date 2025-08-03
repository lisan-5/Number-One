@extends('layouts.app')

@section('title', ucfirst($category))

@section('content')
<!-- Hero Banner -->
<div class="bg-green-50 py-8 mb-8 text-center">
    <h1 class="text-4xl font-bold text-green-800">{{ ucfirst($category) }} Collection</h1>
    <p class="text-gray-600 mt-2">Explore our curated selection of {{ strtolower($category) }} shoes.</p>
</div>
<div class="container mx-auto py-10 space-y-6 px-4 sm:px-6 lg:px-8">
    <h2 class="sr-only">Category Products</h2>

    @if($shoes->isEmpty())
        <p class="text-gray-600">No products found in this category.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($shoes as $shoe)
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300">
                    @if(!empty($shoe->images) && count($shoe->images))
                        <img src="{{ asset('storage/' . $shoe->images[0]) }}" alt="{{ $shoe->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-6 grid grid-cols-2 gap-4">
                        <h2 class="text-lg font-semibold">{{ $shoe->name }}</h2>
                        <p class="text-gray-700 mt-1">ETB {{ number_format($shoe->price, 2) }}</p>
                        <p class="text-gray-600 mt-1">{{ $shoe->description }}</p>
                        <p class="text-gray-600 mt-1">Size: {{ $shoe->size }}</p>
                        @if(!empty($shoe->tags))
                            <div class="mt-2">
                                @foreach($shoe->tags as $tag)
                                    <span class="inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded mr-1">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
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
