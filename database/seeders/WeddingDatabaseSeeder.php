<?php

namespace Database\Seeders;

use App\Models\Info;
use App\Models\Qa;
use App\Models\Timeline;
use App\Models\WeddingSetting;
use Illuminate\Database\Seeder;

class WeddingDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (WeddingSetting::count() === 0) {
            WeddingSetting::create([
                'partner_one' => 'Chiamaka Boma Ibekwe',
                'partner_two' => 'Gospel Abina-Aziba MacBenneth Isikpi',
                'hashtag' => '#THEGOSPELS26',
                'wedding_date' => '2026-11-21',
                'wedding_time' => '11:00',
                'timezone' => 'Africa/Lagos',
                'venue_name' => 'ATWIL EVENT CENTER',
                'address' => 'Akpajo',
                'city' => 'Port Harcourt, Rivers State',
                'maps_url' => 'https://maps.google.com/?q=ATWIL+EVENT+CENTER+Akpajo+Port+Harcourt',
                'arrival_time' => null,
                'ceremony_time' => '11:00 AM',
                'reception_time' => 'After ceremony',
                'family_one' => 'Mr Ikechukwu Ibekwe & Hon. Mrs Ibierembo Thompson-Ibekwe',
                'family_two' => 'Bishop & Pastor Mrs Lemuel MacSimple Isikpi',
                'rsvp_deadline' => '2026-11-07',
                'whatsapp_phone' => '08147684895',
                'order_pdf_path' => null,
                'podcast_youtube_url' => null,
                'podcast_title' => 'The Gospels Wedding',
                'podcast_desc' => 'The families of Chiamaka and Gospel invite you to celebrate their wedding ceremony.',
                'story_title' => 'Two families, one joyful beginning.',
                'story_intro' => 'Chiamaka and Gospel begin a new chapter surrounded by the love of their families.',
                'story_content' => [
                    'With gratitude to God and the love of their families, Chiamaka and Gospel invite you to celebrate their wedding ceremony.',
                    'They look forward to sharing this special day with family and friends as they begin a new chapter together.',
                ],
                'dress_title' => 'Colors of the day',
                'dress_note' => 'Emerald green, beige, gold, and white.',
                'dress_colors' => [
                    ['name' => 'Emerald Green', 'hex' => '#123C32'],
                    ['name' => 'Beige', 'hex' => '#E8DDCC'],
                    ['name' => 'Gold', 'hex' => '#D4AF37'],
                    ['name' => 'White', 'hex' => '#FFFFFF'],
                ],
            ]);
        }

        // Include only confirmed public dates; personal story milestones can be added in admin.
        if (Timeline::count() === 0) {
            Timeline::create([
                'date_label' => 'Nov 21, 2026',
                'title' => 'Wedding Ceremony',
                'desc' => 'Chiamaka and Gospel begin their new chapter.',
                'sort_order' => 1,
            ]);
        }

        if (Qa::count() === 0) {
            $qas = [
                ['question' => 'When is the wedding ceremony?', 'answer' => 'Saturday, November 21, 2026. The ceremony begins at 11:00 AM prompt.', 'sort_order' => 1],
                ['question' => 'Where is the wedding?', 'answer' => 'ATWIL EVENT CENTER, Akpajo, Port Harcourt, Rivers State.', 'sort_order' => 2],
                ['question' => 'What are the colors for the day?', 'answer' => 'Emerald green, beige, gold, and white.', 'sort_order' => 3],
                ['question' => 'How do I RSVP?', 'answer' => 'Please respond by November 7, 2026, using the RSVP form or WhatsApp 08147684895.', 'sort_order' => 4],
                ['question' => 'Will there be a reception?', 'answer' => 'The reception follows the ceremony.', 'sort_order' => 5],
            ];

            foreach ($qas as $qa) {
                Qa::create($qa);
            }
        }

        if (Info::count() === 0) {
            $infos = [
                ['title' => 'Ceremony', 'text' => 'Saturday, November 21, 2026 at 11:00 AM prompt.', 'sort_order' => 1],
                ['title' => 'Venue', 'text' => 'ATWIL EVENT CENTER, Akpajo, Port Harcourt, Rivers State.', 'sort_order' => 2],
                ['title' => 'Reception', 'text' => 'Reception to follow the ceremony.', 'sort_order' => 3],
                ['title' => 'RSVP', 'text' => 'Please respond by November 7, 2026. WhatsApp: 08147684895.', 'sort_order' => 4],
            ];

            foreach ($infos as $info) {
                Info::create($info);
            }
        }

        // Memories, gallery photos, MC information, and guestbook notes are intentionally
        // left empty until the couple supplies real content and guest messages are approved.
    }
}
