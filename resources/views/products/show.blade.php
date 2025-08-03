@extends('layouts.app')

@section('title', $shoe->name)

@section('content')
<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Image Carousel -->
        <div x-data="{
                images: {{ json_encode($shoe->images ?: []) }},
                idx: 0
            }" class="flex flex-col items-center">
            <div class="w-full overflow-hidden">
                <template x-if="images.length">
                    <img :src="`{{ asset('storage') }}/${images[idx]}`" alt="{{ $shoe->name }}" 
                        class="w-full h-96 object-cover transform hover:scale-110 transition duration-500 cursor-zoom-in" />
                </template>
                <template x-if="!images.length">
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                </template>
            </div>
            <div class="flex items-center space-x-4 mt-4">
                <button @click="idx = (idx === 0 ? images.length - 1 : idx - 1)" class="px-3 py-1 bg-gray-200 rounded">Prev</button>
                <span x-text="idx + 1 + '/' + Math.max(images.length, 1)" class="text-sm text-gray-600"></span>
                <button @click="idx = (idx === images.length - 1 ? 0 : idx + 1)" class="px-3 py-1 bg-gray-200 rounded">Next</button>
            </div>
        </div>
        <!-- Details -->
        <div class="space-y-6">
            <h1 class="text-3xl font-semibold">{{ $shoe->name }}</h1>
            <p class="text-green-700 text-2xl font-bold">ETB {{ number_format($shoe->price, 2) }}</p>
            <p class="text-gray-700">{{ $shoe->description }}</p>
            <div class="space-y-2">
                <p><strong>Size:</strong> {{ $shoe->size }}</p>
                @if(!empty($shoe->tags))
                <div class="flex flex-wrap gap-2">
                    @foreach($shoe->tags as $tag)
                        <a href="{{ route('products.tag', $tag) }}" class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded hover:bg-gray-200 transition">{{ $tag }}</a>
                    @endforeach
                </div>
                @endif
            </div>
            <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="shoe_id" value="{{ $shoe->id }}">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md">Add to Cart</button>
            </form>
        </div>
    </div>

    <!-- Related Products -->
    @if($related->count())
    <div class="mt-16">
        <h2 class="text-2xl font-semibold mb-6">Related Products</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($related as $rel)
            <a href="{{ route('products.show', $rel) }}" class="bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition duration-300 overflow-hidden">
                @if(!empty($rel->images) && count($rel->images))
                    <img src="{{ asset('storage/' . $rel->images[0]) }}" alt="{{ $rel->name }}" class="w-full h-44 object-cover" />
                @else
                    <div class="w-full h-44 bg-gray-200 flex items-center justify-center"><span class="text-gray-500">No Image</span></div>
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-medium">{{ $rel->name }}</h3>
                    <p class="text-green-700">ETB {{ number_format($rel->price, 2) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
