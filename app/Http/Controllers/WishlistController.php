<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Shoe;

class WishlistController extends Controller
{
    /**
     * Display the authenticated user's wishlist.
     */
    public function index(Request $request)
    {
        $items = $request->user()->wishlist()->with('shoe')->paginate(12);
        return view('wishlist.index', compact('items'));
    }

    /**
     * Toggle a shoe in the user's wishlist.
     */
    public function toggle(Request $request, Shoe $shoe)
    {
        $user = $request->user();
        $existing = Wishlist::where('user_id', $user->id)->where('shoe_id', $shoe->id)->first();
        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Removed from wishlist.');
        }
        Wishlist::create([
            'user_id' => $user->id,
            'shoe_id' => $shoe->id,
        ]);
        return back()->with('success', 'Added to wishlist!');
    }
}
