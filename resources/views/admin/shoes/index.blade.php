@extends('layouts.app')

@section('title', 'Manage Shoes')

@section('content')
    <div class="container mx-auto py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Shoes</h1>
            <a href="{{ route('admin.shoes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add New Shoe</a>
        </div>
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif
        <table class="w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shoes as $shoe)
                    <tr>
                        <td class="border px-4 py-2">{{ $shoe->id }}</td>
                        <td class="border px-4 py-2">{{ $shoe->name }}</td>
                        <td class="border px-4 py-2">${{ number_format($shoe->price, 2) }}</td>
                        <td class="border px-4 py-2">
                            @if($shoe->image)
                                <img src="{{ asset('storage/'.$shoe->image) }}" class="h-12 w-12 object-cover rounded"> 
                            @endif
                        </td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('admin.shoes.edit', $shoe) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.shoes.destroy', $shoe) }}" method="POST" class="inline" onsubmit="return confirm('Delete this shoe?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">No shoes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
