<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display list of unique categories from shoe tags.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Shoe::all()
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        return view('categories.index', compact('categories'));
    }

    /**
     * Display shoes filtered by a category tag.
     *
     * @param  string  $category
     * @return \Illuminate\View\View
     */
    public function show($category)
    {
        $shoes = Shoe::whereJsonContains('tags', $category)
            ->latest()
            ->paginate(12);

        return view('categories.show', compact('shoes', 'category'));
    }
}
