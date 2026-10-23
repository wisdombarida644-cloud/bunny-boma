<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order', 'asc')->get();
        return view('admin.gallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'category' => 'nullable|string',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('gallery', 'public');
                Gallery::create([
                    'image_path' => '/storage/' . $path,
                    'category' => $request->input('category', 'Pre-Wedding'),
                    'caption' => $file->getClientOriginalName(),
                    'sort_order' => Gallery::count() + 1,
                    'is_active' => true,
                ]);
            }
        }

        return back()->with('success', 'Photos uploaded successfully!');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'category' => 'required|string',
            'caption' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $gallery->update($data);

        return back()->with('success', 'Gallery item updated!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return back()->with('success', 'Photo removed!');
    }
}
