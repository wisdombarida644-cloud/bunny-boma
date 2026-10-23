<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mc;

class McController extends Controller
{
    public function edit()
    {
        $mc = Mc::firstOrCreate([], [
            'name' => 'Timi Agbaje',
            'role' => 'Meet our MC',
            'bio' => 'Bringing energy, warmth and unforgettable moments to the celebration.',
            'image_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop',
            'is_visible' => true
        ]);
        return view('admin.mc', compact('mc'));
    }

    public function update(Request $request)
    {
        $mc = Mc::firstOrCreate([]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string',
            'bio' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'x_url' => 'nullable|string',
            'website_url' => 'nullable|string',
            'is_visible' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('mc', 'public');
            $data['image_path'] = '/storage/' . $path;
        }

        $mc->update($data);

        return back()->with('success', 'MC details updated!');
    }
}
