@extends('layouts.app')

@section('title', 'Edit Shoe')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">Edit Shoe</h1>

    <form action="{{ route('admin.shoes.update', $shoe) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow p-6 rounded-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $shoe->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $shoe->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price (ETB)</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $shoe->price) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="mb-4">
            <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
            <input type="text" name="size" id="size" value="{{ old('size', $shoe->size) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags (comma separated)</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags', isset($shoe->tags) ? implode(',', $shoe->tags) : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Current Images</label>
            <div class="flex space-x-2 mt-2">
                @foreach($shoe->images ?? [] as $img)
                    <img src="{{ asset('storage/'.$img) }}" class="h-16 w-16 object-cover rounded" alt="Shoe">
                @endforeach
            </div>
        </div>

        <div class="mb-4">
            <label for="images" class="block text-sm font-medium text-gray-700">Add New Images (up to 5)</label>
            <input type="file" name="images[]" id="images" accept="image/*" multiple class="mt-1 block w-full">
            <p class="text-xs text-gray-500 mt-1">Uploading new images will append to current ones.</p>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">Update Shoe</button>
    </form>
</div>
@endsection
