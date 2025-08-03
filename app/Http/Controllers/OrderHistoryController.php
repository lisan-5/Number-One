<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderHistoryController extends Controller
{
    /**
     * Display the authenticated user's order history.
     */
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->latest()->paginate(10);
        return view('orders.history', compact('orders'));
    }

    /**
     * Show a specific order details.
     */
    public function show(Request $request, Order $order)
    {
        // Ensure the order belongs to the current user
        if ($order->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized.');
        }
        return view('orders.show', compact('order'));
    }
}
