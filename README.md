# Chiamaka & Gospel Wedding Website

A single-page wedding website and Laravel CMS for Chiamaka Boma Ibekwe and Gospel Abina-Aziba MacBenneth Isikpi. The database-backed public site includes the family invitation, wedding details, Memories carousel, photo journal, name-and-phone RSVP, moderated guestbook, and optional cash-gift bank-transfer details. Admin users manage wedding settings, memories and gallery photos, podcast/music, Q&A, guestbook moderation, and RSVP exports.

## Confirmed event details

- **Date:** Saturday, November 21, 2026
- **Time:** 11:00 AM prompt; reception to follow
- **Venue:** ATWIL EVENT CENTER, Akpajo, Port Harcourt, Rivers State
- **Families:** Mr Ikechukwu Ibekwe & Hon. Mrs Ibierembo Thompson-Ibekwe; Bishop & Pastor Mrs Lemuel MacSimple Isikpi
- **Colors:** Emerald green, beige, gold, white
- **RSVP by:** November 7, 2026
- **WhatsApp RSVP:** 08147684895
- **Website domain:** `withthegospels.name.ng`
- **Hashtag:** `#THEGOSPELS26`

## Stack

- Laravel 12 / PHP 8.2+
- Blade templates with inline site styling and interactions
- SQLite by default for local development; MySQL and PostgreSQL configurations are available
- Vite, Tailwind CSS 4, and Node.js for the frontend build

## Local setup

```sh
composer setup
php artisan admin:create admin@example.com "Wedding Admin"
php artisan serve
```

`composer setup` installs PHP and JS dependencies, creates a local SQLite database if needed, runs migrations and the wedding-details seeder, and builds assets. `admin:create` prompts for a new admin password (12+ characters). The default seeders do not create an admin account or add photos.

To run tests:

```sh
php artisan test
```

### Optional demo photos

To populate the admin **Gallery Photos** and **Memories** screens in a local or staging database, run:

```sh
php artisan db:seed --class=DemoPhotoSeeder
```

This optional seeder is not called by `composer setup` or `DatabaseSeeder`. It creates four clearly labelled demo records in each section, using remotely hosted stock images; it does not download files or test the actual image-upload flow. The records are active and appear on the public website, so do not seed them on the live site unless you intend to show demo photos. To test uploads themselves, sign in as an admin and upload a JPG, PNG, or WebP image up to 10 MB.

## Deployment

Use a PHP-capable host and set the web document root to `public/`. The root `index.html` is a static prototype; it is not connected to Laravel's database, RSVP, guestbook, or CMS. Review [DEPLOYMENT.md](DEPLOYMENT.md) for provider-neutral setup and release steps. The configured production URL is `https://withthegospels.name.ng`; DNS, hosting, and TLS still need to be set up with the chosen provider.

`WeddingDatabaseSeeder` contains the confirmed wedding details above and does not add fictional couple photos, MC details, or guestbook notes. Add approved real photos in **Admin → Memories** and **Admin → Gallery Photos**. A podcast URL and music file have not been supplied; background music stays disabled until a file is uploaded. Bank details have not been supplied; add them in **Admin → Wedding Settings** only after confirming the account. Any bank details entered there are public. The website does not process or verify transfers and does not send email.

Podcast and music autoplay are best-effort. Browsers may block audible playback; the podcast requests muted autoplay and exposes YouTube controls. A prominent **Play Music** control provides a manual fallback, and background music pauses when the podcast player loads to prevent overlapping audio.
