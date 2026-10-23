<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gift;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::orderBy('sort_order', 'asc')->get();
        return view('admin.gifts', compact('gifts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gifts', 'public');
            $data['image_path'] = '/storage/' . $path;
        } else {
            $data['image_path'] = 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop';
        }

        $data['sort_order'] = Gift::count() + 1;
        Gift::create($data);

        return back()->with('success', 'Gift item added successfully!');
    }

    public function update(Request $request, Gift $gift)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gifts', 'public');
            $data['image_path'] = '/storage/' . $path;
        }

        $gift->update($data);

        return back()->with('success', 'Gift updated successfully!');
    }

    public function destroy(Gift $gift)
    {
        $gift->delete();
        return back()->with('success', 'Gift deleted!');
    }
}
