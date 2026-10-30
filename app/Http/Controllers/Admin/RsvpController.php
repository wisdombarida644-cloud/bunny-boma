<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rsvp;

class RsvpController extends Controller
{
    public function index()
    {
        $rsvps = Rsvp::latest()->get();

        return view('admin.rsvps', compact('rsvps'));
    }

    public function export()
    {
        $rsvps = Rsvp::latest()->get();
        $filename = 'rsvps_'.date('Y-m-d').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'no-cache, must-revalidate',
            'Expires' => '0',
        ];

        $callback = function () use ($rsvps) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Phone', 'Submitted At']);

            $safeCell = static function (?string $value): string {
                $value ??= '';

                // Prevent spreadsheet programs from interpreting guest-submitted cells as formulas.
                return preg_match('/^[\x00-\x20]*[=+\-@]/', $value) ? "'{$value}" : $value;
            };

            foreach ($rsvps as $rsvp) {
                fputcsv($file, [
                    $rsvp->id,
                    $safeCell($rsvp->name),
                    $safeCell($rsvp->phone),
                    $rsvp->created_at?->toDateTimeString(),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
