<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'wedding_time' => 'required|date_format:H:i',
            'timezone' => 'required|timezone',
            'venue_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:2000',
            'city' => 'nullable|string|max:255',
            'maps_url' => 'nullable|url|max:2048',
            'arrival_time' => 'nullable|string|max:100',
            'ceremony_time' => 'nullable|string|max:100',
            'reception_time' => 'nullable|string|max:100',
            'podcast_youtube_url' => [
                'nullable',
                'url',
                'max:2048',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (! $value) {
                        return;
                    }

                    $parts = parse_url($value);
                    $host = strtolower(is_array($parts) ? ($parts['host'] ?? '') : '');
                    $allowedHosts = [
                        'youtube.com',
                        'www.youtube.com',
                        'youtube-nocookie.com',
                        'www.youtube-nocookie.com',
                    ];

                    if (! in_array($host, $allowedHosts, true)
                        || ! preg_match('~^/embed/[A-Za-z0-9_-]{11}$~', is_array($parts) ? ($parts['path'] ?? '') : '')) {
                        $fail('Please provide a standard YouTube embed URL.');
                    }
                },
            ],
            'podcast_title' => 'nullable|string|max:255',
            'podcast_desc' => 'nullable|string|max:2000',
            'story_title' => 'nullable|string|max:255',
            'story_intro' => 'nullable|string|max:2000',
            'dress_title' => 'nullable|string|max:255',
            'dress_note' => 'nullable|string|max:2000',
            'family_one' => 'required|string|max:255',
            'family_two' => 'required|string|max:255',
            'rsvp_deadline' => 'required|date|before:wedding_date',
            'whatsapp_phone' => 'required|string|max:50',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:64',
            'cash_gift_note' => 'nullable|string|max:2000',
            'background_music_enabled' => 'sometimes|boolean',
            'background_music_file' => 'nullable|file|mimes:mp3,wav,ogg,m4a,aac|max:20480',
            'remove_background_music' => 'sometimes|boolean',
            'order_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->boolean('background_music_enabled')
            && ! $request->hasFile('background_music_file')
            && ! filled($setting->background_music_path)) {
            return back()
                ->withErrors(['background_music_file' => 'Upload a background music track before enabling playback.'])
                ->withInput();
        }

        $data['background_music_enabled'] = $request->boolean('background_music_enabled');
        unset($data['background_music_file'], $data['remove_background_music']);

        if ($request->hasFile('order_pdf')) {
            $path = $request->file('order_pdf')->store('docs', 'public');
            if (! $path) {
                return back()->withErrors(['order_pdf' => 'The PDF could not be saved. Please try again.'])->withInput();
            }
            $data['order_pdf_path'] = '/media/'.$path;
        }

        if ($request->hasFile('background_music_file')) {
            $path = $request->file('background_music_file')->store('audio', 'public');
            if (! $path) {
                return back()->withErrors(['background_music_file' => 'The audio file could not be saved. Please try again.'])->withInput();
            }
            $this->deleteStoredPublicFile($setting->background_music_path);
            $data['background_music_path'] = '/media/'.$path;
        } elseif ($request->boolean('remove_background_music')) {
            $this->deleteStoredPublicFile($setting->background_music_path);
            $data['background_music_path'] = null;
            $data['background_music_enabled'] = false;
        }

        $setting->update($data);

        return back()->with('success', 'Wedding settings updated successfully!');
    }

    private function deleteStoredPublicFile(?string $publicPath): void
    {
        foreach (['/media/', '/storage/'] as $prefix) {
            if ($publicPath && str_starts_with($publicPath, $prefix)) {
                Storage::disk('public')->delete(substr($publicPath, strlen($prefix)));

                return;
            }
        }
    }
}
