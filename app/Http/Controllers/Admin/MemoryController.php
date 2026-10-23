<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Moment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemoryController extends Controller
{
    public function index()
    {
        $moments = Moment::orderBy('sort_order')->orderByDesc('created_at')->get();

        return view('admin.memories', compact('moments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:2000',
            'credit_name' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $imagePath = $request->file('image')->store('memories', 'public');
        if (! $imagePath) {
            return back()->withErrors(['image' => 'The photo could not be saved. Please try again.'])->withInput();
        }

        Moment::create([
            'image_path' => '/storage/'.$imagePath,
            'title' => $data['title'] ?? null,
            'caption' => $data['caption'] ?? null,
            'credit_name' => $data['credit_name'] ?? null,
            'sort_order' => $data['sort_order'] ?? ((int) Moment::max('sort_order') + 1),
            'is_active' => true,
        ]);

        return back()->with('success', 'Memory photo added.');
    }

    public function update(Request $request, Moment $moment)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:2000',
            'credit_name' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        unset($data['image']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('memories', 'public');
            if (! $imagePath) {
                return back()->withErrors(['image' => 'The replacement photo could not be saved. Please try again.'])->withInput();
            }

            $this->deleteUploadedImage($moment->image_path);
            $data['image_path'] = '/storage/'.$imagePath;
        }

        $moment->update($data);

        return back()->with('success', 'Memory updated.');
    }

    public function destroy(Moment $moment)
    {
        $this->deleteUploadedImage($moment->image_path);
        $moment->delete();

        return back()->with('success', 'Memory photo deleted.');
    }

    private function deleteUploadedImage(?string $imagePath): void
    {
        if ($imagePath && str_starts_with($imagePath, '/storage/')) {
            Storage::disk('public')->delete(substr($imagePath, strlen('/storage/')));
        }
    }
}
