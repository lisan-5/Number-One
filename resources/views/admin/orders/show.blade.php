@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">Order #{{ $order->id }}</h1>
    <div class="bg-white shadow rounded-lg p-6">
        <p><strong>Name:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Size:</strong> {{ $order->size }}</p>
        <p><strong>Delivery:</strong> {{ $order->delivery ? 'Yes' : 'No' }}</p>
        @if($order->delivery)
            <p><strong>Location:</strong> {{ $order->location }}</p>
            <p><strong>Instructions:</strong> {{ $order->instructions }}</p>
        @endif
        <h2 class="text-2xl font-semibold mt-6 mb-4">Items</h2>
        <ul class="list-disc pl-6">
            @foreach($order->items as $item)
                <li>{{ $item['name'] }} x{{ $item['quantity'] }} — {{ number_format($item['total'], 2) }} ETB</li>
            @endforeach
        </ul>
        <p class="mt-4"><strong>Subtotal:</strong> {{ number_format($order->subtotal, 2) }} ETB</p>
        <p><strong>Total:</strong> {{ number_format($order->total, 2) }} ETB</p>
        <p><strong>Status:</strong>
            <span class="@if($order->status === 'completed') text-green-600 @elseif($order->status === 'rejected') text-red-600 @else text-gray-600 @endif">
                {{ ucfirst($order->status) }}
            </span>
        </p>
    </div>
    <div class="mt-4 space-x-2">
        <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="inline">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="completed">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">Mark Completed</button>
        </form>
        <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="inline">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="rejected">
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Mark Rejected</button>
        </form>
    </div>
    <div class="mt-6">
        <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:underline">Back to Orders</a>
    </div>
</div>
@endsection
