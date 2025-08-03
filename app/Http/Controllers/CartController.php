<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index(Request $request)
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
        // No shipping applied
        $total = $subtotal;

        return view('cart', compact('items', 'subtotal', 'total'));
    }

    /**
     * Add an item to the cart (session).
     */
    public function add(Request $request)
    {
        $request->validate([
            'shoe_id' => 'required|exists:shoes,id',
        ]);
        $cart = $request->session()->get('cart', []);
        $id = $request->input('shoe_id');
        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Added to cart!');
    }
    /**
     * Remove an item from the cart (session).
     */
    public function remove(Request $request)
    {
        $request->validate([
            'shoe_id' => 'required|exists:shoes,id',
        ]);
        $cart = $request->session()->get('cart', []);
        $id = $request->input('shoe_id');
        if (isset($cart[$id])) {
            $cart[$id]--;
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
            $request->session()->put('cart', $cart);
        }
        return back()->with('success', 'Item removed from cart.');
    }
}
