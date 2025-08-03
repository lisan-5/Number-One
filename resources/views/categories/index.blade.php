@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<!-- Hero Banner -->
<div class="bg-green-50 py-8 mb-8 text-center">
    <h1 class="text-4xl font-bold text-green-800">Shop by Category</h1>
    <p class="text-gray-600 mt-2">Find the perfect style for every occasion</p>
</div>
<div class="container mx-auto py-10">
    <h2 class="sr-only">Categories</h2>

    @if($categories->isEmpty())
        <p class="text-gray-600">No categories found.</p>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition text-center">
                    <span class="text-lg font-medium text-gray-800">{{ ucfirst($category) }}</span>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
