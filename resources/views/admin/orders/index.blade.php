@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Orders</h1>
    </div>
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    <table class="w-full bg-white shadow rounded-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Order #</th>
                <th class="px-4 py-2">Customer</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr class="@if($order->status === 'completed') bg-green-100 @elseif($order->status === 'rejected') bg-red-100 @endif">
                <td class="border px-4 py-2">{{ $order->id }}</td>
                <td class="border px-4 py-2">{{ $order->name }}</td>
                <td class="border px-4 py-2">{{ $order->email }}</td>
                <td class="border px-4 py-2">{{ number_format($order->total, 2) }} ETB</td>
                <td class="border px-4 py-2">{{ $order->created_at->format('Y-m-d') }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.orders.show', $order) }}" class="px-2 py-1 bg-blue-600 text-white rounded-md">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-2 text-center text-gray-600">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
