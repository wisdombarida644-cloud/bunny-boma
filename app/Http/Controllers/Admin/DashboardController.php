<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingSetting;
use App\Models\Gallery;
use App\Models\Gift;
use App\Models\Rsvp;
use App\Models\Guestbook;
use App\Models\Qa;

class DashboardController extends Controller
{
    public function index()
    {
        $setting = WeddingSetting::first();
        $galleryCount = Gallery::count();
        $giftCount = Gift::count();
        $giftedCount = Gift::where('status', 'FULLY GIFTED')->count();
        $qaCount = Qa::count();
        $rsvpCount = Rsvp::count();
        $attendingCount = Rsvp::where('attendance', 'yes')->sum('guests_count');
        $recentGuestbooks = Guestbook::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'setting',
            'galleryCount',
            'giftCount',
            'giftedCount',
            'qaCount',
            'rsvpCount',
            'attendingCount',
            'recentGuestbooks'
        ));
    }
}
