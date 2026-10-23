<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PLACEHOLDER_URL = 'https://www.youtube.com/embed/dQw4w9WgXcQ';

    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('podcast_youtube_url')->nullable()->default(null)->change();
        });

        DB::table('wedding_settings')
            ->where('podcast_youtube_url', self::PLACEHOLDER_URL)
            ->update(['podcast_youtube_url' => null]);
    }

    public function down(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('podcast_youtube_url')->nullable()->default(self::PLACEHOLDER_URL)->change();
        });
    }
};
