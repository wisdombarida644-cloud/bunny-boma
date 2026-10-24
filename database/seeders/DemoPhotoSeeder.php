<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Moment;
use Illuminate\Database\Seeder;

/**
 * Optional photo fixtures for local/staging admin and layout testing.
 * These remote stock photos are deliberately not included in DatabaseSeeder.
 */
class DemoPhotoSeeder extends Seeder
{
    private const PHOTOS = [
        [
            'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1600&auto=format&fit=crop',
            'number' => '01',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1520854221256-17451ccdf07b?q=80&w=1600&auto=format&fit=crop',
            'number' => '02',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=1600&auto=format&fit=crop',
            'number' => '03',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=1600&auto=format&fit=crop',
            'number' => '04',
        ],
    ];

    public function run(): void
    {
        foreach (self::PHOTOS as $index => $photo) {
            $number = $photo['number'];
            $sortOrder = $index + 1;
            $galleryCaption = "DEMO ONLY — sample stock photo {$number} (not the couple)";
            $memoryTitle = "DEMO ONLY — sample memory {$number}";

            Gallery::updateOrCreate(
                ['caption' => $galleryCaption],
                [
                    'image_path' => $photo['image'],
                    'category' => 'Demo — replace before launch',
                    'sort_order' => $sortOrder,
                    'is_active' => false,
                ]
            );

            Moment::updateOrCreate(
                ['title' => $memoryTitle],
                [
                    'image_path' => $photo['image'],
                    'caption' => 'Stock image for admin testing only. This is not a photo of Chiamaka and Gospel.',
                    'credit_name' => 'Demo stock image',
                    'sort_order' => $sortOrder,
                    'is_active' => false,
                ]
            );
        }
    }
}
