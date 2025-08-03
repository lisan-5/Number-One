@extends('layouts.app')

@section('title', 'Add New Shoe')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-semibold mb-6">Add New Shoe</h1>
        @if($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.shoes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                <input type="text" name="size" id="size" value="{{ old('size') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags (comma separated)</label>
                <input type="text" name="tags" id="tags" value="{{ old('tags') }}" placeholder="e.g. samba,play,master quality" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700">Images (up to 5)</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple class="mt-1 block w-full" />
                <p class="text-xs text-gray-500 mt-1">You can select multiple images to upload.</p>
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Create Shoe</button>
                <a href="{{ route('admin.shoes.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection
