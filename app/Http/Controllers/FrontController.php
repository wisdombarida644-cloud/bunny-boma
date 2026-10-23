<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeddingSetting;
use App\Models\Timeline;
use App\Models\Moment;
use App\Models\Gallery;
use App\Models\Mc;
use App\Models\Qa;
use App\Models\Info;
use App\Models\Gift;
use App\Models\Rsvp;
use App\Models\Guestbook;

class FrontController extends Controller
{
    public function index()
    {
        $setting = WeddingSetting::first();
        $timelines = Timeline::orderBy('sort_order', 'asc')->get();
        $moments = Moment::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $galleries = Gallery::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $mc = Mc::where('is_visible', true)->first();
        $qas = Qa::where('is_published', true)->orderBy('sort_order', 'asc')->get();
        $infos = Info::orderBy('sort_order', 'asc')->get();
        $gifts = Gift::orderBy('sort_order', 'asc')->get();
        $guestbooks = Guestbook::where('is_approved', true)->latest()->get();

        return view('index', compact(
            'setting',
            'timelines',
            'moments',
            'galleries',
            'mc',
            'qas',
            'infos',
            'gifts',
            'guestbooks'
        ));
    }

    public function rsvpStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'guests_count' => 'required|integer|min:1|max:10',
            'attendance' => 'required|string|in:yes,no',
            'message' => 'nullable|string',
        ]);

        $rsvp = Rsvp::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'RSVP received successfully!', 'rsvp' => $rsvp]);
        }

        return back()->with('success', 'Thank you for your RSVP!');
    }

    public function guestbookStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $entry = Guestbook::create([
            'name' => $validated['name'],
            'message' => $validated['message'],
            'is_approved' => true,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'entry' => $entry]);
        }

        return back()->with('success', 'Thank you for leaving a note!');
    }
}
