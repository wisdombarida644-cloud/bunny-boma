<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('wedding_settings') || ! Schema::hasColumn('wedding_settings', 'story_sides')) {
            return;
        }

        $storySides = json_decode(
            file_get_contents(database_path('data/couple-story-sides.json')),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );
        $encodedStories = json_encode(
            $storySides,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
        );

        DB::table('wedding_settings')->update(['story_sides' => $encodedStories]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('wedding_settings') || ! Schema::hasColumn('wedding_settings', 'story_sides')) {
            return;
        }

        // Restore the legacy merged-story fallback rather than retaining corrected side-by-side copy.
        DB::table('wedding_settings')->update(['story_sides' => null]);
    }
};
