<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Show checkout form with cart details.
     */
    public function create(Request $request)
    {
        $sessionCart = $request->session()->get('cart', []);
        $shoes = Shoe::whereIn('id', array_keys($sessionCart))->get();

        $items = $shoes->map(function ($shoe) use ($sessionCart) {
            $qty = $sessionCart[$shoe->id] ?? 0;
            return (object) [
                'shoe' => $shoe,
                'quantity' => $qty,
                'total' => $shoe->price * $qty,
            ];
        });

        $subtotal = $items->sum('total');
        $total = $subtotal;

        return view('checkout', compact('items', 'subtotal', 'total'));
    }

    /**
     * Process checkout submission.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'size' => 'required|string|max:50',
            'delivery' => 'sometimes|boolean',
            // Location only validated when delivery is on
            'location' => 'sometimes|required_if:delivery,1|nullable|string|max:255',
            'instructions' => 'sometimes|nullable|string|max:500',
        ]);

        // Prepare order data
        $sessionCart = $request->session()->get('cart', []);
        $shoes = Shoe::whereIn('id', array_keys($sessionCart))->get();

        $items = $shoes->map(function ($shoe) use ($sessionCart) {
            $qty = $sessionCart[$shoe->id] ?? 0;
            return [
                'id' => $shoe->id,
                'name' => $shoe->name,
                'price' => $shoe->price,
                'quantity' => $qty,
                'total' => $shoe->price * $qty,
            ];
        })->toArray();

        $subtotal = collect($items)->sum('total');
        $total = $subtotal;

        // Save order
        // Save order with association to authenticated user
        Order::create([
            'user_id' => $request->user()->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'size' => $data['size'],
            'delivery' => $data['delivery'] ?? false,
            'location' => $data['location'] ?? null,
            'instructions' => $data['instructions'] ?? null,
            'items' => $items,
            'subtotal' => $subtotal,
            'total' => $total,
            'status' => $data['status'] ?? 'pending',
        ]);
        // TODO: send notifications

        // Clear cart
        $request->session()->forget('cart');

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
