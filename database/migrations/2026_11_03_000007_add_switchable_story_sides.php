<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('wedding_settings')) {
            return;
        }

        if (! Schema::hasColumn('wedding_settings', 'story_sides')) {
            Schema::table('wedding_settings', function (Blueprint $table): void {
                $table->json('story_sides')->nullable();
            });
        }

        $storyPath = database_path('data/couple-story-sides.json');
        $storySides = json_decode(
            file_get_contents($storyPath),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );
        $encodedStories = json_encode(
            $storySides,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
        );

        DB::table('wedding_settings')
            ->whereNull('story_sides')
            ->update(['story_sides' => $encodedStories]);
    }

    public function down(): void
    {
        if (Schema::hasTable('wedding_settings') && Schema::hasColumn('wedding_settings', 'story_sides')) {
            Schema::table('wedding_settings', function (Blueprint $table): void {
                $table->dropColumn('story_sides');
            });
        }
    }
};
