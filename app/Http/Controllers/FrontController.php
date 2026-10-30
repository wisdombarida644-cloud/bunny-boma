<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Guestbook;
use App\Models\Info;
use App\Models\Mc;
use App\Models\Moment;
use App\Models\Qa;
use App\Models\Rsvp;
use App\Models\Timeline;
use App\Models\WeddingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {
        // Allow the site to render after migrations even before optional demo content is seeded.
        $setting = WeddingSetting::firstOrCreate([]);
        $timelines = Timeline::orderBy('sort_order', 'asc')->get();
        $moments = Moment::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('credit_name')->orWhere('credit_name', '!=', 'Demo stock image');
            })
            ->orderBy('sort_order', 'asc')
            ->get();
        $galleries = Gallery::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('category')->orWhere('category', '!=', 'Demo — replace before launch');
            })
            ->orderBy('sort_order', 'asc')
            ->get();
        $heroBackgroundPhotos = $galleries
            ->filter(fn (Gallery $gallery) => str_starts_with($gallery->image_path, '/media/gallery/')
                || str_starts_with($gallery->image_path, '/storage/gallery/'))
            ->take(8)
            ->values();
        $ogImageUrl = asset('images/og-wedding-couple.jpg');
        $mc = Mc::where('is_visible', true)->first();
        $qas = Qa::where('is_published', true)->orderBy('sort_order', 'asc')->get();
        $infos = Info::orderBy('sort_order', 'asc')->get();
        $guestbooks = Guestbook::where('is_approved', true)->latest()->get();
        $podcastVideoUrl = $this->safeYoutubeEmbedUrl($setting->podcast_youtube_url);

        $timezone = $setting->timezone ?: config('app.timezone');
        $address = $setting->address ?: 'Akpajo';
        $city = $setting->city ?: 'Port Harcourt, Rivers State';
        $whatsappDigits = preg_replace('/\D+/', '', (string) $setting->whatsapp_phone);
        if (str_starts_with($whatsappDigits, '0')) {
            $whatsappDigits = '234'.ltrim($whatsappDigits, '0');
        }
        $whatsappUrl = $whatsappDigits !== ''
            ? 'https://wa.me/'.$whatsappDigits.'?text='.rawurlencode('Hello, I would like to RSVP for '.$setting->partner_one.' and '.$setting->partner_two.'’s wedding.')
            : null;
        $dressColors = $setting->dress_colors ?: [
            ['name' => 'Emerald Green', 'hex' => '#123C32'],
            ['name' => 'Beige', 'hex' => '#E8DDCC'],
            ['name' => 'Gold', 'hex' => '#D4AF37'],
            ['name' => 'White', 'hex' => '#FFFFFF'],
        ];

        $weddingData = [
            'date' => (string) $setting->wedding_date,
            'time' => $setting->wedding_time,
            'timezone' => $timezone,
            'dateTime' => \Carbon\Carbon::parse(
                $setting->wedding_date.' '.($setting->wedding_time ?: '11:00'),
                $timezone
            )->toIso8601String(),
            'venue' => $setting->venue_name,
            'address' => $address,
            'city' => $city,
            'partnerOne' => $setting->partner_one,
            'partnerTwo' => $setting->partner_two,
            'hashtag' => $setting->hashtag,
            'familyOne' => $setting->family_one,
            'familyTwo' => $setting->family_two,
            'rsvpDeadline' => $setting->rsvp_deadline?->format('F j, Y'),
            'whatsappPhone' => $setting->whatsapp_phone,
            'whatsappUrl' => $whatsappUrl,
            'mapsUrl' => $setting->maps_url ?: 'https://maps.google.com/?q=ATWIL+EVENT+CENTER+Akpajo+Port+Harcourt',
            'dressColors' => $dressColors,
            'podcastUrl' => $podcastVideoUrl,
            'heroBackgroundPhotos' => $heroBackgroundPhotos->pluck('image_path')->all(),
            'heroPhotos' => $galleries->take(4)->map(fn (Gallery $gallery) => [
                'image_path' => $gallery->image_path,
                'caption' => $gallery->caption,
            ])->values()->all(),
            'moments' => $moments->map(fn (Moment $moment) => [
                'image_path' => $moment->image_path,
                'title' => $moment->title,
                'caption' => $moment->caption,
                'credit_name' => $moment->credit_name,
            ])->values()->all(),
            'gallery' => $galleries->map(fn (Gallery $gallery) => [
                'image_path' => $gallery->image_path,
                'category' => $gallery->category,
                'caption' => $gallery->caption,
            ])->values()->all(),
        ];

        return view('index', compact(
            'setting',
            'timelines',
            'moments',
            'galleries',
            'heroBackgroundPhotos',
            'mc',
            'qas',
            'infos',
            'guestbooks',
            'weddingData',
            'ogImageUrl'
        ));
    }

    public function rsvpStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Please provide your name and phone number.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()->to(route('home').'#rsvp')
                ->withErrors($validator, 'rsvp')
                ->withInput($request->only('name', 'phone'));
        }

        $validated = $validator->validated();
        $rsvp = Rsvp::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            // Keep compatibility with older production databases where email is still NOT NULL.
            'email' => '',
            'guests_count' => 1,
            'attendance' => 'yes',
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your RSVP has been received. Thank you!',
                'rsvp' => $rsvp,
            ]);
        }

        return redirect()->to(route('home').'#rsvp')
            ->with('rsvp_success', 'Your RSVP has been received. Thank you!');
    }

    public function guestbookStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Please provide your name and a wish for the couple.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()->to(route('home').'#wishes')
                ->withErrors($validator, 'wishes')
                ->withInput($request->only('name', 'message'));
        }

        $validated = $validator->validated();
        $entry = Guestbook::create([
            'name' => $validated['name'],
            'message' => $validated['message'],
            'is_approved' => false,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your wish has been received and will appear after approval.',
                'entry' => $entry,
            ]);
        }

        return redirect()->to(route('home').'#wishes')
            ->with('success', 'Thank you for your wish. It will be shared after approval.');
    }

    private function safeYoutubeEmbedUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $parts = parse_url($url);

        if (! is_array($parts)) {
            return null;
        }

        $host = strtolower($parts['host'] ?? '');
        $allowedHosts = [
            'youtube.com',
            'www.youtube.com',
            'youtube-nocookie.com',
            'www.youtube-nocookie.com',
        ];

        if (! in_array($host, $allowedHosts, true)
            || ! preg_match('~^/embed/([A-Za-z0-9_-]{11})$~', $parts['path'] ?? '', $matches)) {
            return null;
        }

        return 'https://www.youtube-nocookie.com/embed/'.$matches[1];
    }
}
