<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table): void {
            $table->string('story_chiamaka_photo_path')->nullable();
            $table->string('story_benny_photo_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table): void {
            $table->dropColumn([
                'story_chiamaka_photo_path',
                'story_benny_photo_path',
            ]);
        });
    }
};
