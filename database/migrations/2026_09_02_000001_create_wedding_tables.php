<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wedding_settings', function (Blueprint $table) {
            $table->id();
            $table->string('partner_one')->default('Benny');
            $table->string('partner_two')->default('Boma');
            $table->string('hashtag')->default('#TheGospels26');
            $table->date('wedding_date')->default('2026-09-26');
            $table->string('wedding_time')->default('16:00');
            $table->string('timezone')->default('Africa/Lagos');
            $table->string('venue_name')->default('Harbour Point Event Centre');
            $table->text('address')->nullable();
            $table->string('city')->default('Lagos, Nigeria');
            $table->text('maps_url')->nullable();
            $table->string('arrival_time')->default('04:00 PM');
            $table->string('ceremony_time')->default('04:30 PM');
            $table->string('reception_time')->default('06:00 PM');
            $table->string('order_pdf_path')->nullable();
            $table->string('podcast_youtube_url')->default('https://www.youtube.com/embed/dQw4w9WgXcQ');
            $table->string('podcast_title')->default('How We Met');
            $table->text('podcast_desc')->nullable();
            $table->string('story_title')->default('Some stories are written. Ours was lived.');
            $table->string('story_intro')->default('Two lives, one beautiful beginning.');
            $table->json('story_content')->nullable();
            $table->string('dress_title')->default('Formal Attire');
            $table->text('dress_note')->nullable();
            $table->json('dress_colors')->nullable();
            $table->timestamps();
        });

        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->string('date_label');
            $table->string('title');
            $table->text('desc')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('moments', function (Blueprint $table) {
            $table->id();
            $table->text('image_path');
            $table->string('title')->nullable();
            $table->text('caption')->nullable();
            $table->string('credit_name')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->text('image_path');
            $table->string('category')->default('Pre-Wedding');
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('mcs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->default('Meet our MC');
            $table->text('bio')->nullable();
            $table->text('image_path')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('x_url')->nullable();
            $table->string('website_url')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });

        Schema::create('qas', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('HOME');
            $table->string('price');
            $table->text('description')->nullable();
            $table->text('image_path')->nullable();
            $table->string('status')->default('AVAILABLE');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('rsvps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->integer('guests_count')->default(1);
            $table->string('attendance')->default('yes');
            $table->text('message')->nullable();
            $table->timestamps();
        });

        Schema::create('guestbooks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('message');
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guestbooks');
        Schema::dropIfExists('rsvps');
        Schema::dropIfExists('gifts');
        Schema::dropIfExists('infos');
        Schema::dropIfExists('qas');
        Schema::dropIfExists('mcs');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('moments');
        Schema::dropIfExists('timelines');
        Schema::dropIfExists('wedding_settings');
    }
};
