<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Guestbook;
use App\Models\Moment;
use App\Models\Rsvp;
use App\Models\WeddingSetting;

class DashboardController extends Controller
{
    public function index()
    {
        $setting = WeddingSetting::firstOrCreate([]);
        $photoCount = Gallery::count() + Moment::count();
        $cashGiftConfigured = filled($setting->bank_name)
            && filled($setting->account_name)
            && filled($setting->account_number);
        $rsvpCount = Rsvp::count();
        $attendingCount = Rsvp::where('attendance', 'yes')->sum('guests_count');
        $recentGuestbooks = Guestbook::latest()->take(5)->get();
        $pendingGuestbookCount = Guestbook::where('is_approved', false)->count();

        return view('admin.dashboard', compact(
            'setting',
            'photoCount',
            'cashGiftConfigured',
            'rsvpCount',
            'attendingCount',
            'recentGuestbooks',
            'pendingGuestbookCount'
        ));
    }
}
