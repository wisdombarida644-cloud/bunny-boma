<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Guestbook;
use App\Models\Moment;
use App\Models\User;
use Database\Seeders\DemoPhotoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_without_seeded_demo_content(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('The Beginning of Forever')
            ->assertSee('Will you celebrate')
            ->assertSee('Memories')
            ->assertSee('Wishes')
            ->assertSee('Leave a wish for the couple')
            ->assertSee('themeToggle', false)
            ->assertSee(asset('favicon.svg'))
            ->assertSee(asset('favicon-32x32.png'))
            ->assertSee(asset('apple-touch-icon.png'))
            ->assertSee(asset('site.webmanifest'))
            ->assertSee(asset('images/og-wedding.jpg'))
            ->assertSee(asset('images/hero-love-bg.jpg'))
            ->assertSee('Our memory album is taking shape.')
            ->assertSee('Chiamaka Boma Ibekwe')
            ->assertSee('Gospel Abina-Aziba MacBenneth Isikpi')
            ->assertSee('Mr Ikechukwu Ibekwe')
            ->assertSee('Bishop & Pastor Mrs Lemuel MacSimple Isikpi')
            ->assertSee('November 21, 2026')
            ->assertSee('November 7, 2026')
            ->assertSee('ATWIL EVENT CENTER')
            ->assertSee('Port Harcourt, Rivers State')
            ->assertSee('08147684895')
            ->assertSee('Emerald Green')
            ->assertSee('Beige')
            ->assertSee('Gold')
            ->assertSee('White')
            ->assertSee('#THEGOSPELS26')
            ->assertSee('Cash gifts')
            ->assertDontSee('Gift Registry')
            ->assertDontSee('dQw4w9WgXcQ')
            ->assertDontSee('images.unsplash.com');
    }

    public function test_demo_photo_seeder_is_opt_in_and_idempotent(): void
    {
        $this->assertSame(0, Gallery::count());
        $this->assertSame(0, Moment::count());

        $this->seed(DemoPhotoSeeder::class);

        $this->assertSame(4, Gallery::where('category', 'Demo — replace before launch')->count());
        $this->assertSame(4, Moment::where('credit_name', 'Demo stock image')->count());
        $this->assertDatabaseHas('galleries', [
            'caption' => 'DEMO ONLY — sample stock photo 01 (not the couple)',
            'is_active' => false,
        ]);
        $this->assertDatabaseHas('moments', [
            'title' => 'DEMO ONLY — sample memory 01',
            'is_active' => false,
        ]);

        $this->seed(DemoPhotoSeeder::class);

        $this->assertSame(4, Gallery::where('category', 'Demo — replace before launch')->count());
        $this->assertSame(4, Moment::where('credit_name', 'Demo stock image')->count());

        Gallery::where('category', 'Demo — replace before launch')->update(['is_active' => true]);
        Moment::where('credit_name', 'Demo stock image')->update(['is_active' => true]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Our memory album is taking shape.')
            ->assertDontSee('DEMO ONLY — sample stock photo')
            ->assertDontSee('images.unsplash.com');
    }

    public function test_uploaded_gallery_photos_are_used_in_homepage_hero(): void
    {
        Gallery::create([
            'image_path' => '/media/gallery/chiamaka-gospel.jpg',
            'category' => 'Wedding',
            'caption' => 'Couple photo',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('src="/media/gallery/chiamaka-gospel.jpg"', false)
            ->assertSee(asset('/media/gallery/chiamaka-gospel.jpg'))
            ->assertSee('Couple photo');
    }

    public function test_public_storage_fallback_serves_uploaded_audio_and_images(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('audio/wedding-track.mp3', 'audio-test-data');
        Storage::disk('public')->put('gallery/couple-photo.jpg', 'image-test-data');

        $this->get('/media/audio/wedding-track.mp3')
            ->assertOk()
            ->assertHeader('Content-Type', 'audio/mpeg');
        $this->get('/storage/gallery/couple-photo.jpg')
            ->assertOk()
            ->assertHeader('Content-Type', 'image/jpeg');
        $this->get('/media/private/secret.mp3')->assertNotFound();
    }

    public function test_admin_can_manage_family_names_rsvp_deadline_and_whatsapp_contact(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.settings.update'), [
                'partner_one' => 'Chiamaka Boma Ibekwe',
                'partner_two' => 'Gospel Abina-Aziba MacBenneth Isikpi',
                'hashtag' => '#THEGOSPELS26',
                'wedding_date' => '2026-11-21',
                'wedding_time' => '11:00',
                'timezone' => 'Africa/Lagos',
                'venue_name' => 'ATWIL EVENT CENTER',
                'address' => 'Akpajo',
                'city' => 'Port Harcourt, Rivers State',
                'maps_url' => 'https://maps.google.com/?q=ATWIL+EVENT+CENTER',
                'arrival_time' => null,
                'ceremony_time' => '11:00 AM',
                'reception_time' => 'After ceremony',
                'family_one' => 'Mr Ikechukwu Ibekwe & Hon. Mrs Ibierembo Thompson-Ibekwe',
                'family_two' => 'Bishop & Pastor Mrs Lemuel MacSimple Isikpi',
                'rsvp_deadline' => '2026-11-07',
                'whatsapp_phone' => '08147684895',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('wedding_settings', [
            'family_one' => 'Mr Ikechukwu Ibekwe & Hon. Mrs Ibierembo Thompson-Ibekwe',
            'family_two' => 'Bishop & Pastor Mrs Lemuel MacSimple Isikpi',
            'rsvp_deadline' => '2026-11-07',
            'whatsapp_phone' => '08147684895',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('November 7, 2026')
            ->assertSee('08147684895')
            ->assertSee('wa.me/2348147684895');
    }

    public function test_rsvp_requires_and_saves_only_name_and_phone(): void
    {
        $this->from(route('home'))
            ->post(route('rsvp.store'), [
                'name' => 'Ada Guest',
                'phone' => '+2348000000000',
            ])
            ->assertRedirect(route('home').'#rsvp')
            ->assertSessionHas('rsvp_success', 'Your RSVP has been received. Thank you!');

        $this->assertDatabaseHas('rsvps', [
            'name' => 'Ada Guest',
            'phone' => '+2348000000000',
            'email' => '',
            'guests_count' => 1,
            'attendance' => 'yes',
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Your RSVP has been received. Thank you!');

        $this->actingAs(User::factory()->create())
            ->get(route('admin.rsvps.index'))
            ->assertOk()
            ->assertSee('Ada Guest')
            ->assertSee('+2348000000000');

        $this->from(route('home'))
            ->post(route('rsvp.store'), ['name' => 'No Phone'])
            ->assertRedirect(route('home').'#rsvp')
            ->assertSessionHasErrorsIn('rsvp', ['phone']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('No Phone')
            ->assertSee('aria-invalid="true"', false);

        $this->from(route('home'))
            ->post(route('rsvp.store'), ['phone' => '+2348000000000'])
            ->assertRedirect(route('home').'#rsvp')
            ->assertSessionHasErrorsIn('rsvp', ['name']);
    }

    public function test_cash_gift_details_are_managed_in_settings_and_shown_publicly(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.settings.update'), [
                'partner_one' => 'Benny',
                'partner_two' => 'Boma',
                'hashtag' => '#TheGospels26',
                'wedding_date' => '2027-06-15',
                'wedding_time' => '16:00',
                'timezone' => 'Africa/Lagos',
                'venue_name' => 'Harbour Point',
                'address' => 'Port Harcourt',
                'city' => 'Port Harcourt, Nigeria',
                'maps_url' => '',
                'arrival_time' => '10:30 AM',
                'ceremony_time' => '11:00 AM',
                'reception_time' => 'After ceremony',
                'family_one' => 'Mr Ikechukwu Ibekwe & Hon. Mrs Ibierembo Thompson-Ibekwe',
                'family_two' => 'Bishop & Pastor Mrs Lemuel MacSimple Isikpi',
                'rsvp_deadline' => '2027-05-15',
                'whatsapp_phone' => '08147684895',
                'podcast_youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'podcast_desc' => 'Our story',
                'bank_name' => 'Example Bank',
                'account_name' => 'Benny and Boma',
                'account_number' => '0123456789',
                'cash_gift_note' => 'Thank you for celebrating with us.',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('wedding_settings', [
            'bank_name' => 'Example Bank',
            'account_name' => 'Benny and Boma',
            'account_number' => '0123456789',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Example Bank')
            ->assertSee('0123456789')
            ->assertSee('Thank you for celebrating with us.');
    }

    public function test_guest_wishes_require_approval_before_publication(): void
    {
        $this->post(route('guestbook.store'), [
            'name' => 'Ada Guest',
            'message' => 'Congratulations to you both.',
        ])
            ->assertRedirect(route('home').'#wishes')
            ->assertSessionHas('success', 'Thank you for your wish. It will be shared after approval.');

        $entry = Guestbook::where('name', 'Ada Guest')->firstOrFail();
        $this->assertFalse((bool) $entry->is_approved);

        $this->get('/')->assertDontSee('Congratulations to you both.');
    }

    public function test_memories_manager_requires_authentication_and_is_available_to_admins(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
        $this->get(route('admin.memories.index'))->assertRedirect(route('login'));
        $this->get(route('login'))
            ->assertOk()
            ->assertSee(asset('favicon.svg'))
            ->assertSee(asset('apple-touch-icon.png'));

        $this->actingAs(User::factory()->create())
            ->get(route('admin.memories.index'))
            ->assertOk()
            ->assertSee(asset('favicon.svg'))
            ->assertSee(asset('site.webmanifest'))
            ->assertSee('Add a memory photo')
            ->assertSee('public Memories carousel')
            ->assertSee('adminMenuToggle', false)
            ->assertSee('sidebarBackdrop', false);
    }

    public function test_admin_can_approve_a_guestbook_note(): void
    {
        $admin = User::factory()->create();
        $entry = Guestbook::create([
            'name' => 'Ada Guest',
            'message' => 'A note awaiting review.',
            'is_approved' => false,
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.guestbook.update', $entry), ['is_approved' => '1'])
            ->assertRedirect();

        $this->assertDatabaseHas('guestbooks', [
            'id' => $entry->id,
            'is_approved' => true,
        ]);
    }
}
