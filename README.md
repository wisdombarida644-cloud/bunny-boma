# Chiamaka & Gospel Wedding Website

A single-page wedding website and Laravel CMS for Chiamaka Boma Ibekwe and Gospel Abina-Aziba MacBenneth Isikpi. The database-backed public site includes the family invitation, wedding details, Memories carousel, photo journal, name-and-phone RSVP, moderated Wishes board, persistent light/dark theme toggle, and optional cash-gift bank-transfer details. Its homepage hero layers a softly veiled romantic photo backdrop beneath an editorial stack of couple-uploaded photos, with a still centre portrait and gently drifting side frames. Admin users manage wedding settings, memories and gallery photos, podcast/music, Q&A, wishes moderation, and RSVP exports.

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
php artisan db:seed --class=AdminUserSeeder
php artisan serve
```

`composer setup` installs PHP and JS dependencies, creates a local SQLite database if needed, runs migrations and the wedding-details seeder, and builds assets. The separate `AdminUserSeeder` prompts for the admin email, display name, and a password (at least 12 characters) twice, then asks for confirmation. It creates or resets that account, stores only Laravel's password hash, and never displays the password. It is not part of the default seeders. Share the credentials privately with the couple; do not commit or send a real password in source code or chat. The existing `php artisan admin:create email@example.com "Wedding Admin"` command is also available.

To run tests:

```sh
php artisan test
```

### Optional demo photos

To populate the admin **Gallery Photos** and **Memories** screens in a local or staging database, run:

```sh
php artisan db:seed --class=DemoPhotoSeeder
```

This optional seeder is not called by `composer setup` or `DatabaseSeeder`. It creates four clearly labelled, inactive demo records in each section using remotely hosted stock images; it does not download files or test the actual image-upload flow. Demo-marked rows are excluded from the public site even if activated, so they cannot be mistaken for the couple’s photos. To test uploads themselves, sign in as an admin and upload a JPG, PNG, or WebP image up to 10 MB.

## Deployment

Use a PHP-capable host and set the web document root to `public/`. The root `index.html` is a static prototype; it is not connected to Laravel's database, RSVP, guestbook, or CMS. Review [DEPLOYMENT.md](DEPLOYMENT.md) for provider-neutral setup and release steps. The configured production URL is `https://withthegospels.name.ng`; DNS, hosting, and TLS still need to be set up with the chosen provider.

`WeddingDatabaseSeeder` contains the confirmed wedding details above and does not add fictional couple photos, MC details, or wishes. Upload approved real photos in **Admin → Gallery Photos**; active gallery photos appear in the photo journal and the first four feed the homepage portrait stack. Side frames gently float and cycle through uploads while the centre portrait stays still. The social preview uses the first active gallery photo when available and falls back to `public/images/og-wedding.jpg`, a crop of the image supplied with the design request. **Admin → Memories** controls the separate Memories carousel. A podcast URL and music file have not been supplied; background music stays disabled until a file is uploaded. Bank details have not been supplied; add them in **Admin → Wedding Settings** only after confirming the account. Any bank details entered there are public. The website does not process or verify transfers and does not send email.

Podcast and music autoplay are best-effort. Browsers may block audible playback; the podcast requests muted autoplay and exposes YouTube controls. A prominent **Play Music** control provides a manual fallback, and background music pauses when the podcast player loads to prevent overlapping audio.
