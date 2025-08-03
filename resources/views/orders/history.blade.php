@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">My Order History</h1>
    @if($orders->isEmpty())
        <p>You have not placed any orders yet.</p>
    @else
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-6 py-3">Order #</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-t">
                    <td class="px-6 py-4">#{{ $order->id }}</td>
                    <td class="px-6 py-4">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 capitalize">{{ $order->status }}</td>
                    <td class="px-6 py-4">ETB {{ number_format($order->total,2) }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
