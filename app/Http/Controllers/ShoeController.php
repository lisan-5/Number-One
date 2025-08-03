<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;

class ShoeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $shoes = Shoe::latest()->paginate(10);
        return view('admin.shoes.index', compact('shoes'));
    }

    public function create()
    {
        return view('admin.shoes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'size' => 'required|string',
            'tags' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('shoes', 'public');
            }
        }
        $validated['images'] = $paths;

        // Process tags into array
        $validated['tags'] = $request->filled('tags')
            ? array_map('trim', explode(',', $request->input('tags')))
            : [];
        Shoe::create($validated);

        return redirect()->route('admin.shoes.index')->with('success', 'Shoe created successfully.');
    }

    public function edit(Shoe $shoe)
    {
        return view('admin.shoes.edit', compact('shoe'));
    }

    public function update(Request $request, Shoe $shoe)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'size' => 'required|string',
            'tags' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $paths = $shoe->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('shoes', 'public');
            }
        }
        $validated['images'] = $paths;

        // Process tags into array
        $validated['tags'] = $request->filled('tags')
            ? array_map('trim', explode(',', $request->input('tags')))
            : [];
        $shoe->update($validated);

        return redirect()->route('admin.shoes.index')->with('success', 'Shoe updated successfully.');
    }

    public function destroy(Shoe $shoe)
    {
        $shoe->delete();
        return redirect()->route('admin.shoes.index')->with('success', 'Shoe deleted successfully.');
    }
}
