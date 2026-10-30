<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('family_one')->default('Mr Ikechukwu Ibekwe & Hon. Mrs Ibierembo Thompson-Ibekwe');
            $table->string('family_two')->default('Bishop & Pastor Mrs Lemuel MacSimple Isikpi');
            $table->date('rsvp_deadline')->default('2026-11-07');
            $table->string('whatsapp_phone', 50)->default('08147684895');
        });

        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('partner_one')->default('Chiamaka Boma Ibekwe')->change();
            $table->string('partner_two')->default('Gospel Abina-Aziba MacBenneth Isikpi')->change();
            $table->string('hashtag')->default('#THEGOSPELS26')->change();
            $table->date('wedding_date')->default('2026-11-21')->change();
            $table->string('wedding_time')->default('11:00')->change();
            $table->string('venue_name')->default('ATWIL EVENT CENTER')->change();
            $table->string('city')->default('Port Harcourt, Rivers State')->change();
            $table->string('arrival_time')->nullable()->default(null)->change();
            $table->string('ceremony_time')->default('11:00 AM')->change();
            $table->string('reception_time')->default('After ceremony')->change();
            $table->string('podcast_title')->default('The Gospels Wedding')->change();
            $table->string('story_title')->default('Two families, one joyful beginning.')->change();
            $table->string('story_intro')->default('Chiamaka and Gospel begin a new chapter surrounded by the love of their families.')->change();
            $table->string('dress_title')->default('Colors of the day')->change();
        });

        $demoWeddingQuery = DB::table('wedding_settings')
            ->where('partner_one', 'Benny')
            ->where('partner_two', 'Boma')
            ->where('wedding_date', '2026-09-26')
            ->where('venue_name', 'Harbour Point Event Centre');
        $hasDemoWedding = (clone $demoWeddingQuery)->exists();

        $demoWeddingQuery->update([
            'partner_one' => 'Chiamaka Boma Ibekwe',
            'partner_two' => 'Gospel Abina-Aziba MacBenneth Isikpi',
            'hashtag' => '#THEGOSPELS26',
            'wedding_date' => '2026-11-21',
            'wedding_time' => '11:00',
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
            'podcast_title' => 'The Gospels Wedding',
            'podcast_desc' => 'The families of Chiamaka and Gospel invite you to celebrate their wedding ceremony.',
            'story_title' => 'Two families, one joyful beginning.',
            'story_intro' => 'Chiamaka and Gospel begin a new chapter surrounded by the love of their families.',
            'story_content' => json_encode([
                'With gratitude to God and the love of their families, Chiamaka and Gospel invite you to celebrate their wedding ceremony.',
                'They look forward to sharing this special day with family and friends as they begin a new chapter together.',
            ], JSON_UNESCAPED_UNICODE),
            'dress_title' => 'Colors of the day',
            'dress_note' => 'Emerald green, beige, gold, and white.',
            'dress_colors' => json_encode([
                ['name' => 'Emerald Green', 'hex' => '#123C32'],
                ['name' => 'Beige', 'hex' => '#E8DDCC'],
                ['name' => 'Gold', 'hex' => '#D4AF37'],
                ['name' => 'White', 'hex' => '#FFFFFF'],
            ], JSON_UNESCAPED_UNICODE),
        ]);

        if ($hasDemoWedding) {
            $sampleMilestones = DB::table('timelines')
                ->whereIn('title', ['The Beginning', 'First Trip', 'The Yes, before The Yes', 'The Engagement', 'The Wedding'])
                ->whereIn('date_label', ['Dec 2021', 'Mar 2022', 'Aug 2023', 'Jan 2025', 'Sep 2026'])
                ->delete();

            if ($sampleMilestones > 0) {
                DB::table('timelines')->insert([
                    'date_label' => 'Nov 21, 2026',
                    'title' => 'Wedding Ceremony',
                    'desc' => 'Chiamaka and Gospel begin their new chapter.',
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('moments')
                ->whereIn('title', ['The Engagement', 'First Light', 'The In-Between', 'Family', 'Vows, Practised', 'Celebration'])
                ->whereIn('credit_name', ['Kate & Ethan • Lagos', 'Benny & Boma', 'Pre-wedding', 'Our people', 'The promise', 'Moments'])
                ->delete();

            DB::table('galleries')
                ->whereIn('caption', ['Golden hour, Lagos', 'Quiet morning', 'Unposed', 'Together', 'Joy', 'The yes', 'Evening', 'City walk', 'Laughter'])
                ->delete();

            DB::table('mcs')->where('name', 'Timi Agbaje')->delete();

            DB::table('qas')
                ->whereIn('question', [
                    'Are children invited?',
                    'What time should I arrive?',
                    'What should I wear?',
                    'Where is the venue?',
                    'Can I bring a plus one?',
                    'Is parking available?',
                    'Is the ceremony indoor or outdoor?',
                    'Can I take photographs?',
                ])
                ->whereIn('answer', [
                    'We love your little ones, but this celebration will be adults-only. We hope this gives you a chance to celebrate freely.',
                    'Please arrive by 4:00PM. Ceremony begins at 4:30PM prompt. Doors will close at 4:25PM.',
                    'Formal attire. Emerald, ivory, beige, and soft champagne are welcome. Please avoid white.',
                    'Harbour Point Event Centre, Victoria Island, Lagos. Valet available from 3:30PM.',
                    'Due to limited seating, we can only accommodate those formally invited. Thank you for understanding.',
                    'Yes, ample parking and valet service at the venue. Ride-share is encouraged.',
                    'Outdoor ceremony, indoor reception. Both spaces are fully covered.',
                    'We kindly ask for an unplugged ceremony. Our photographers will capture everything. Reception — photograph freely!',
                ])
                ->delete();

            DB::table('qas')->insert([
                ['question' => 'When is the wedding ceremony?', 'answer' => 'Saturday, November 21, 2026. The ceremony begins at 11:00 AM prompt.', 'sort_order' => 1, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['question' => 'Where is the wedding?', 'answer' => 'ATWIL EVENT CENTER, Akpajo, Port Harcourt, Rivers State.', 'sort_order' => 2, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['question' => 'What are the colors for the day?', 'answer' => 'Emerald green, beige, gold, and white.', 'sort_order' => 3, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['question' => 'How do I RSVP?', 'answer' => 'Please respond by November 7, 2026, using the RSVP form or WhatsApp 08147684895.', 'sort_order' => 4, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['question' => 'Will there be a reception?', 'answer' => 'The reception follows the ceremony.', 'sort_order' => 5, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
            ]);

            DB::table('infos')
                ->whereIn('title', ['Punctuality', 'Children', 'Photography', 'Parking'])
                ->whereIn('text', [
                    'Please arrive early so we can begin the ceremony on time. Late entry will not be permitted once the procession begins.',
                    'This will be an adult-only celebration. We appreciate your understanding.',
                    'Unplugged ceremony — please keep phones away. Reception is open for photos and videos.',
                    'Valet and self-parking available. Carpooling or ride-share recommended.',
                ])
                ->delete();

            DB::table('infos')->insert([
                ['title' => 'Ceremony', 'text' => 'Saturday, November 21, 2026 at 11:00 AM prompt.', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['title' => 'Venue', 'text' => 'ATWIL EVENT CENTER, Akpajo, Port Harcourt, Rivers State.', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['title' => 'Reception', 'text' => 'Reception to follow the ceremony.', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
                ['title' => 'RSVP', 'text' => 'Please respond by November 7, 2026. WhatsApp: 08147684895.', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ]);

            DB::table('guestbooks')
                ->whereIn('name', ['Amaka & Chidi', 'Tolu', 'Mama Boma'])
                ->whereIn('message', [
                    'May your home always be filled with laughter and love that chooses, every single day.',
                    'Two of the kindest people I know. This is so deserved. Can’t wait to dance.',
                    'My prayer has always been that love finds you gently. Today, it has.',
                ])
                ->delete();
        }
    }

    public function down(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('partner_one')->default('Benny')->change();
            $table->string('partner_two')->default('Boma')->change();
            $table->string('hashtag')->default('#TheGospels26')->change();
            $table->date('wedding_date')->default('2026-09-26')->change();
            $table->string('wedding_time')->default('16:00')->change();
            $table->string('venue_name')->default('Harbour Point Event Centre')->change();
            $table->string('city')->default('Lagos, Nigeria')->change();
            $table->string('arrival_time')->nullable(false)->default('04:00 PM')->change();
            $table->string('ceremony_time')->default('04:30 PM')->change();
            $table->string('reception_time')->default('06:00 PM')->change();
            $table->string('podcast_title')->default('How We Met')->change();
            $table->string('story_title')->default('Some stories are written. Ours was lived.')->change();
            $table->string('story_intro')->default('Two lives, one beautiful beginning.')->change();
            $table->string('dress_title')->default('Formal Attire')->change();
            $table->dropColumn(['family_one', 'family_two', 'rsvp_deadline', 'whatsapp_phone']);
        });
    }
};
