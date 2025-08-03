@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">Order #{{ $order->id }}</h1>
    <div class="bg-white shadow rounded-lg p-6 divide-y divide-gray-200">
        <div class="pb-4">
            <h2 class="text-xl font-semibold">Customer Details</h2>
            <p>Name: {{ $order->name }}</p>
            <p>Email: {{ $order->email }}</p>
            <p>Phone: {{ $order->phone }}</p>
            <p>Size: {{ $order->size }}</p>
            @if($order->delivery)
                <p>Delivery Address: {{ $order->location }}</p>
            @endif
+        <div class="py-4">
+            <h2 class="text-xl font-semibold">Items</h2>
+            <ul class="list-disc list-inside">
+                @foreach($order->items as $item)
+                    <li>{{ $item['quantity'] }}× {{ $item['name'] }} at ETB {{ number_format($item['price'],2) }} each</li>
+                @endforeach
+            </ul>
+        </div>
        <div class="py-4">
            <h2 class="text-xl font-semibold">Totals</h2>
            <p>Subtotal: ETB {{ number_format($order->subtotal,2) }}</p>
            <p>Total: ETB {{ number_format($order->total,2) }}</p>
            <p>Status: <span class="capitalize">{{ $order->status }}</span></p>
        </div>
    </div>
    <div class="mt-6">
        <a href="{{ route('orders.history') }}" class="text-blue-600 hover:underline">Back to orders</a>
    </div>
</div>
@endsection
