<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoes = \App\Models\Shoe::all();
        return view('admin.shoes.index', compact('shoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shoes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'size' => 'required|string|max:50',
            'tags' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);
        // Parse tags into array
        if (!empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $img) {
                $paths[] = $img->store('images/shoes', 'public');
            }
            $data['images'] = $paths;
        }
        \App\Models\Shoe::create($data);
        // Clear product listing cache so new shoe appears immediately
        \Illuminate\Support\Facades\Cache::flush();
        return redirect()->route('admin.shoes.index')->with('success', 'Shoe created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Shoe $shoe)
    {
        return view('admin.shoes.show', compact('shoe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Shoe $shoe)
    {
        return view('admin.shoes.edit', compact('shoe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Shoe $shoe)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'size' => 'required|string|max:50',
            'tags' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);
        // Parse tags into array
        if (!empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }
        // Append new images to existing ones
        if ($request->hasFile('images')) {
            $paths = $shoe->images ?? [];
            foreach ($request->file('images') as $img) {
                $paths[] = $img->store('images/shoes', 'public');
            }
            $data['images'] = $paths;
        }
        $shoe->update($data);
        // Clear product listing cache so updates appear immediately
        \Illuminate\Support\Facades\Cache::flush();
        return redirect()->route('admin.shoes.index')->with('success', 'Shoe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Shoe $shoe)
    {
        if ($shoe->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($shoe->image);
        }
        $shoe->delete();
        // Clear product listing cache so deletions appear immediately
        \Illuminate\Support\Facades\Cache::flush();
        return redirect()->route('admin.shoes.index')->with('success', 'Shoe deleted successfully.');
    }
}
