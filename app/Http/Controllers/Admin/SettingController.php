<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WeddingSetting;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = WeddingSetting::firstOrCreate([]);
        return view('admin.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = WeddingSetting::firstOrCreate([]);

        $data = $request->validate([
            'partner_one' => 'required|string|max:255',
            'partner_two' => 'required|string|max:255',
            'hashtag' => 'required|string|max:255',
            'wedding_date' => 'required|date',
            'wedding_time' => 'required|string',
            'venue_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'maps_url' => 'nullable|string',
            'arrival_time' => 'nullable|string',
            'ceremony_time' => 'nullable|string',
            'reception_time' => 'nullable|string',
            'podcast_youtube_url' => 'nullable|string',
            'podcast_title' => 'nullable|string',
            'podcast_desc' => 'nullable|string',
            'story_title' => 'nullable|string',
            'story_intro' => 'nullable|string',
            'dress_title' => 'nullable|string',
            'dress_note' => 'nullable|string',
            'order_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('order_pdf')) {
            $path = $request->file('order_pdf')->store('docs', 'public');
            $data['order_pdf_path'] = '/storage/' . $path;
        }

        $setting->update($data);

        return back()->with('success', 'Wedding settings updated successfully!');
    }
}
