<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number', 64)->nullable();
            $table->text('cash_gift_note')->nullable();
            $table->string('background_music_path')->nullable();
            $table->boolean('background_music_enabled')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->dropColumn([
                'bank_name',
                'account_name',
                'account_number',
                'cash_gift_note',
                'background_music_path',
                'background_music_enabled',
            ]);
        });
    }
};
