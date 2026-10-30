<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guestbook;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    public function index()
    {
        $guestbooks = Guestbook::latest()->paginate(25);
        $pendingCount = Guestbook::where('is_approved', false)->count();

        return view('admin.guestbooks', compact('guestbooks', 'pendingCount'));
    }

    public function update(Request $request, Guestbook $guestbook)
    {
        $validated = $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $guestbook->update([
            'is_approved' => (bool) $validated['is_approved'],
        ]);

        return back()->with('success', $guestbook->is_approved
            ? 'Guestbook note approved.'
            : 'Guestbook note hidden.');
    }

    public function destroy(Guestbook $guestbook)
    {
        $guestbook->delete();

        return back()->with('success', 'Guestbook note deleted.');
    }
}
