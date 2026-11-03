<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const LEGACY_INTRO = 'Chiamaka and Gospel begin a new chapter surrounded by the love of their families.';

    private const LEGACY_CONTENT = [
        'With gratitude to God and the love of their families, Chiamaka and Gospel invite you to celebrate their wedding ceremony.',
        'They look forward to sharing this special day with family and friends as they begin a new chapter together.',
    ];

    private const STORY_INTRO = 'A friendship rooted in faith, carried by laughter, and guided by God.';

    private const STORY_CONTENT = [
        'In March 2024, Benny moved from Bayelsa to Rivers State to begin again. At a youth service on April 21, Chiamaka’s lively announcements caught his attention. They talked after church and exchanged numbers; though Benny kept reaching out, his messages stayed unread—for a while.',
        'On May 22, they crossed paths again outside the church after Benny found the gates locked for a youth meeting. Their brief chat grew into a close friendship of laughter, prayer, faith-filled conversations, and shared Kingdom purpose. Through healing and growth, they began to recognize God’s hand in their story.',
        'A little after 2 a.m. on June 29, 2024, Benny asked Chiamaka to marry him during a video call. She said yes, and the best friends made their relationship official. They kept learning, forgiving, and growing together; Chiamaka moved to CCI first, and Benny followed in September 2025 after handing over his church responsibilities.',
        'On Valentine’s Day 2026, Benny proposed again at the Young and Free Conference before more than 3,000 young people. Now they look forward to a lifetime—and a day extra—of love, faith, laughter, and purpose, grateful to God for bringing them this far.',
    ];

    public function up(): void
    {
        $this->replaceStoryIfMatches(
            self::LEGACY_INTRO,
            self::LEGACY_CONTENT,
            self::STORY_INTRO,
            self::STORY_CONTENT,
        );
    }

    public function down(): void
    {
        $this->replaceStoryIfMatches(
            self::STORY_INTRO,
            self::STORY_CONTENT,
            self::LEGACY_INTRO,
            self::LEGACY_CONTENT,
        );
    }

    private function replaceStoryIfMatches(
        string $expectedIntro,
        array $expectedContent,
        string $replacementIntro,
        array $replacementContent,
    ): void {
        if (! Schema::hasTable('wedding_settings')) {
            return;
        }

        $setting = DB::table('wedding_settings')->orderBy('id')->first();

        if (! $setting || $setting->story_intro !== $expectedIntro) {
            return;
        }

        $currentContent = json_decode((string) ($setting->story_content ?? '[]'), true);

        if ($currentContent !== $expectedContent) {
            return;
        }

        DB::table('wedding_settings')
            ->where('id', $setting->id)
            ->update([
                'story_intro' => $replacementIntro,
                'story_content' => json_encode($replacementContent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            ]);
    }
};
