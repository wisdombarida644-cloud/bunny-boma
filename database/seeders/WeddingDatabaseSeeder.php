<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WeddingSetting;
use App\Models\Timeline;
use App\Models\Moment;
use App\Models\Gallery;
use App\Models\Mc;
use App\Models\Qa;
use App\Models\Info;
use App\Models\Gift;
use App\Models\Guestbook;

class WeddingDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@bennyandboma.com'],
            [
                'name' => 'Benny & Boma Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Wedding Settings
        if (WeddingSetting::count() === 0) {
            WeddingSetting::create([
                'partner_one' => 'Benny',
                'partner_two' => 'Boma',
                'hashtag' => '#TheGospels26',
                'wedding_date' => '2026-09-26',
                'wedding_time' => '16:00',
                'timezone' => 'Africa/Lagos',
                'venue_name' => 'Harbour Point Event Centre',
                'address' => '4 Wilmot Point Road, Off Ahmadu Bello Way, Victoria Island',
                'city' => 'Lagos, Nigeria',
                'maps_url' => 'https://maps.google.com/?q=Harbour+Point+Lagos',
                'arrival_time' => '04:00 PM',
                'ceremony_time' => '04:30 PM',
                'reception_time' => '06:00 PM',
                'order_pdf_path' => null,
                'podcast_youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'podcast_title' => 'How We Met — Benny & Boma',
                'podcast_desc' => 'Listen as we tell the story of the first conversation that never really ended.',
                'story_title' => 'Some stories are written. Ours was lived.',
                'story_intro' => 'Two lives, one beautiful beginning.',
                'story_content' => [
                    'We met on a quiet Thursday that didn’t know it was about to become the first page of everything. Benny was late, Boma was early — and somehow, we both arrived exactly on time for each other.',
                    'What followed wasn’t a whirlwind. It was slower, truer. Conversations that stretched past midnight, laughter that made strangers turn around, prayers whispered separately that sounded strangely alike.',
                    'In a city that never stops moving, we found a stillness. A place where we could be fully ourselves — unedited, unhurried, unafraid. Benny taught Boma how to pause. Boma taught Benny how to dream louder.',
                    'This wedding is not just a day. It is a vow we have been practising for years — to choose kindness, to choose presence, to choose each other, again and again.'
                ],
                'dress_title' => 'Formal Attire',
                'dress_note' => '“Please dress in a way that makes you feel your most beautiful — we want you to feel as good as you look.”',
                'dress_colors' => [
                    ['name' => 'Emerald', 'hex' => '#123C32'],
                    ['name' => 'Ivory', 'hex' => '#F7F4EE'],
                    ['name' => 'Beige', 'hex' => '#E8DDCC'],
                    ['name' => 'Champagne', 'hex' => '#B8A27A']
                ]
            ]);
        }

        // Timeline
        if (Timeline::count() === 0) {
            $timelines = [
                ['date_label' => 'Dec 2021', 'title' => 'The Beginning', 'desc' => 'First conversation, first laugh.', 'sort_order' => 1],
                ['date_label' => 'Mar 2022', 'title' => 'First Trip', 'desc' => 'A weekend that felt like a lifetime.', 'sort_order' => 2],
                ['date_label' => 'Aug 2023', 'title' => 'The Yes, before The Yes', 'desc' => 'We knew, long before we said it.', 'sort_order' => 3],
                ['date_label' => 'Jan 2025', 'title' => 'The Engagement', 'desc' => 'On a quiet beach, with only the waves as witness.', 'sort_order' => 4],
                ['date_label' => 'Sep 2026', 'title' => 'The Wedding', 'desc' => 'The day we begin forever.', 'sort_order' => 5],
            ];
            foreach ($timelines as $t) Timeline::create($t);
        }

        // Moments
        if (Moment::count() === 0) {
            $moments = [
                ['image_path' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1200&auto=format&fit=crop', 'title' => 'The Engagement', 'caption' => 'On a quiet beach, the question that changed everything.', 'credit_name' => 'Kate & Ethan • Lagos', 'sort_order' => 1],
                ['image_path' => 'https://images.unsplash.com/photo-1520854221256-17451ccdf07b?q=80&w=1200&auto=format&fit=crop', 'title' => 'First Light', 'caption' => 'Morning light, slow coffee, and plans that felt like prayers.', 'credit_name' => 'Benny & Boma', 'sort_order' => 2],
                ['image_path' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=1200&auto=format&fit=crop', 'title' => 'The In-Between', 'caption' => 'Not posing. Just being. That’s where love lives.', 'credit_name' => 'Pre-wedding', 'sort_order' => 3],
                ['image_path' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=1200&auto=format&fit=crop', 'title' => 'Family', 'caption' => 'Two families becoming one story.', 'credit_name' => 'Our people', 'sort_order' => 4],
                ['image_path' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=1200&auto=format&fit=crop', 'title' => 'Vows, Practised', 'caption' => 'We’ve been writing these vows for years without knowing.', 'credit_name' => 'The promise', 'sort_order' => 5],
                ['image_path' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=1200&auto=format&fit=crop', 'title' => 'Celebration', 'caption' => 'Joy that doesn’t need a reason.', 'credit_name' => 'Moments', 'sort_order' => 6],
            ];
            foreach ($moments as $m) Moment::create($m);
        }

        // Gallery
        if (Gallery::count() === 0) {
            $galleries = [
                ['image_path' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1200&auto=format&fit=crop', 'category' => 'Engagement', 'caption' => 'Golden hour, Lagos', 'sort_order' => 1],
                ['image_path' => 'https://images.unsplash.com/photo-1520854221256-17451ccdf07b?q=80&w=800&auto=format&fit=crop', 'category' => 'Pre-Wedding', 'caption' => 'Quiet morning', 'sort_order' => 2],
                ['image_path' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=1200&auto=format&fit=crop', 'category' => 'Love Story', 'caption' => 'Unposed', 'sort_order' => 3],
                ['image_path' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=800&auto=format&fit=crop', 'category' => 'Family', 'caption' => 'Together', 'sort_order' => 4],
                ['image_path' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=1200&auto=format&fit=crop', 'category' => 'Wedding', 'caption' => 'Joy', 'sort_order' => 5],
                ['image_path' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=800&auto=format&fit=crop', 'category' => 'Proposal', 'caption' => 'The yes', 'sort_order' => 6],
            ];
            foreach ($galleries as $g) Gallery::create($g);
        }

        // MC
        if (Mc::count() === 0) {
            Mc::create([
                'name' => 'Timi Agbaje',
                'role' => 'Meet our MC',
                'bio' => 'Bringing energy, warmth and unforgettable moments to the celebration. Timi is a storyteller, host, and friend who believes every wedding should feel like home.',
                'image_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop',
                'instagram_url' => 'https://instagram.com',
                'x_url' => 'https://x.com',
                'website_url' => '#',
                'is_visible' => true
            ]);
        }

        // QAs
        if (Qa::count() === 0) {
            $qas = [
                ['question' => 'Are children invited?', 'answer' => 'We love your little ones, but this celebration will be adults-only. We hope this gives you a chance to celebrate freely.', 'sort_order' => 1],
                ['question' => 'What time should I arrive?', 'answer' => 'Please arrive by 4:00PM. Ceremony begins at 4:30PM prompt. Doors will close at 4:25PM.', 'sort_order' => 2],
                ['question' => 'What should I wear?', 'answer' => 'Formal attire. Emerald, ivory, beige, and soft champagne are welcome. Please avoid white.', 'sort_order' => 3],
                ['question' => 'Where is the venue?', 'answer' => 'Harbour Point Event Centre, Victoria Island, Lagos. Valet available from 3:30PM.', 'sort_order' => 4],
                ['question' => 'Can I bring a plus one?', 'answer' => 'Due to limited seating, we can only accommodate those formally invited. Thank you for understanding.', 'sort_order' => 5],
                ['question' => 'Is parking available?', 'answer' => 'Yes, ample parking and valet service at the venue. Ride-share is encouraged.', 'sort_order' => 6],
                ['question' => 'Can I take photographs?', 'answer' => 'We kindly ask for an unplugged ceremony. Our photographers will capture everything. Reception — photograph freely!', 'sort_order' => 7],
            ];
            foreach ($qas as $q) Qa::create($q);
        }

        // Info
        if (Info::count() === 0) {
            $infos = [
                ['title' => 'Punctuality', 'text' => 'Please arrive early so we can begin the ceremony on time. Late entry will not be permitted once the procession begins.', 'sort_order' => 1],
                ['title' => 'Children', 'text' => 'This will be an adult-only celebration. We appreciate your understanding.', 'sort_order' => 2],
                ['title' => 'Photography', 'text' => 'Unplugged ceremony — please keep phones away. Reception is open for photos and videos.', 'sort_order' => 3],
                ['title' => 'Parking', 'text' => 'Valet and self-parking available. Carpooling or ride-share recommended.', 'sort_order' => 4],
            ];
            foreach ($infos as $info) Info::create($info);
        }

        // Gifts
        if (Gift::count() === 0) {
            $gifts = [
                ['name' => 'Our First Home — Cookware Set', 'category' => 'HOME', 'price' => '₦250,000', 'description' => 'Help us fill our kitchen with warmth and meals shared with loved ones.', 'image_path' => 'https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=600&auto=format&fit=crop', 'status' => 'AVAILABLE', 'sort_order' => 1],
                ['name' => 'Honeymoon — Zanzibar Escape', 'category' => 'TRAVEL', 'price' => '₦600,000', 'description' => 'Sunrise, slow mornings, and a new chapter by the sea.', 'image_path' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=600&auto=format&fit=crop', 'status' => 'AVAILABLE', 'sort_order' => 2],
                ['name' => 'Dining Table for Gatherings', 'category' => 'HOME', 'price' => '₦400,000', 'description' => 'A table where stories, laughter and future family will gather.', 'image_path' => 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?q=80&w=600&auto=format&fit=crop', 'status' => 'FULLY GIFTED', 'sort_order' => 3],
                ['name' => 'Photography Album — Heirloom', 'category' => 'PERSONAL', 'price' => '₦180,000', 'description' => 'Preserve these moments in a handcrafted album.', 'image_path' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop', 'status' => 'AVAILABLE', 'sort_order' => 4],
                ['name' => 'Weekend Retreat', 'category' => 'EXPERIENCE', 'price' => '₦300,000', 'description' => 'A quiet getaway after the celebration.', 'image_path' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=600&auto=format&fit=crop', 'status' => 'AVAILABLE', 'sort_order' => 5],
                ['name' => 'Art for Our Walls', 'category' => 'PERSONAL', 'price' => '₦220,000', 'description' => 'A piece that reminds us of this season.', 'image_path' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?q=80&w=600&auto=format&fit=crop', 'status' => 'AVAILABLE', 'sort_order' => 6],
            ];
            foreach ($gifts as $g) Gift::create($g);
        }

        // Guestbook
        if (Guestbook::count() === 0) {
            $guestbooks = [
                ['name' => 'Amaka & Chidi', 'message' => 'May your home always be filled with laughter and love that chooses, every single day.'],
                ['name' => 'Tolu', 'message' => 'Two of the kindest people I know. This is so deserved. Can’t wait to dance.'],
                ['name' => 'Mama Boma', 'message' => 'My prayer has always been that love finds you gently. Today, it has.'],
            ];
            foreach ($guestbooks as $gb) Guestbook::create($gb);
        }
    }
}
