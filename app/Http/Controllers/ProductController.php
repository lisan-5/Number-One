<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the shoes for all users and guests.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Shoe::query();
        // apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        // apply sorting
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
        }
        // Cache paginated results per unique URL for 5 minutes
        $cacheKey = 'products.index.' . md5($request->fullUrl());
        $shoes = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($query, $request) {
            return $query->paginate(12)->appends($request->query());
        });
        return response()
            ->view('products', compact('shoes'))
            ->header('Cache-Control', 'public, max-age=300');
    }
    /**
     * Display shoes filtered by tag.
     */
    public function tag(Request $request, $tag)
    {
        $query = Shoe::whereJsonContains('tags', $tag);
        // apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        // apply sorting
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
        }
        // Cache tag-filtered results per unique URL for 5 minutes
        $cacheKey = 'products.tag.' . $tag . '.' . md5($request->fullUrl());
        $shoes = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($query, $request) {
            return $query->paginate(12)->appends($request->query());
        });
        return response()
            ->view('products', compact('shoes', 'tag'))
            ->header('Cache-Control', 'public, max-age=300');
    }
    /**
     * Display the specified shoe details.
     */
    public function show(Shoe $shoe)
    {
        // Fetch related shoes by shared tags or random if none
        $tags = $shoe->tags ?? [];
        if (!empty($tags)) {
            $related = Shoe::where('id', '!=', $shoe->id)
                ->whereJsonContains('tags', $tags[0])
                ->inRandomOrder()
                ->limit(4)
                ->get();
        } else {
            $related = Shoe::where('id', '!=', $shoe->id)
                ->inRandomOrder()
                ->limit(4)
                ->get();
        }
        return view('products.show', compact('shoe', 'related'));
    }
}
