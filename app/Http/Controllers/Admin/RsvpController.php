<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rsvp;

class RsvpController extends Controller
{
    public function index()
    {
        $rsvps = Rsvp::latest()->get();
        $totalAttending = Rsvp::where('attendance', 'yes')->sum('guests_count');
        $totalDeclined = Rsvp::where('attendance', 'no')->count();
        return view('admin.rsvps', compact('rsvps', 'totalAttending', 'totalDeclined'));
    }

    public function export()
    {
        $rsvps = Rsvp::latest()->get();
        $filename = "rsvps_" . date('Y-m-d') . ".csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($rsvps) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Guests', 'Attendance', 'Message', 'Submitted At']);

            foreach ($rsvps as $r) {
                fputcsv($file, [$r->id, $r->name, $r->email, $r->phone, $r->guests_count, $r->attendance, $r->message, $r->created_at]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
