# Deployment guide

This is a Laravel 12 application. Deploy it to a PHP-capable host; a static host can serve only the separate root `index.html` prototype, not the Laravel CMS, RSVP, or guestbook routes. The requested website domain is `withthegospels.name.ng`, and the production environment example points `APP_URL` to `https://withthegospels.name.ng`. This repository change does **not** configure DNS, hosting, certificates, or deploy the site.

## Hosting requirements

- PHP 8.2 or newer with Laravel's required extensions and the selected database driver (`pdo_mysql` for MySQL or `pdo_pgsql` for PostgreSQL).
- Composer 2 and PHP-FPM, Apache, or a Laravel-compatible application runtime.
- Node.js 22 or a compatible Node version for the Vite production build.
- A persistent MySQL/PostgreSQL database for production. SQLite is suitable only for a small single-instance deployment with a persistent writable volume.
- A persistent writable `storage/` directory or compatible object storage for uploads. Memories/gallery photos, an optional MC portrait, background music, and the order-of-service PDF use the `public` disk.
- PHP and web-server upload limits above the app's largest file limit: 20 MB for background music and 10 MB for images or the order-of-service PDF. Set `upload_max_filesize`, `post_max_size`, and the server request-body limit accordingly.

Set the web server document root to the repository's **`public/` directory**. Do not expose the repository root, `.env`, `vendor/`, or `storage/` directly. Configure DNS for `withthegospels.name.ng` at the selected provider and require HTTPS before inviting guests. The root `index.html` is a hard-coded prototype, not the Laravel homepage.

## First deployment

1. Set the host's secrets and environment variables using `.env.production.example` as a checklist. Never commit the real `.env` file. At minimum configure `APP_URL=https://withthegospels.name.ng`, a stable `APP_KEY`, database credentials, and `APP_DEBUG=false`. Require HTTPS and keep `SESSION_SECURE_COOKIE=true`.
2. Install locked dependencies and build frontend assets:

   ```sh
   composer install --no-dev --prefer-dist --optimize-autoloader
   npm ci
   npm run build
   ```

3. Run migrations against the production database:

   ```sh
   php artisan migrate --force
   ```

4. On a new database, seed the confirmed wedding details and baseline Q&A/information once:

   ```sh
   php artisan db:seed --class=WeddingDatabaseSeeder --force
   ```

   The seed data uses Saturday, November 21, 2026 at 11:00 AM prompt, ATWIL EVENT CENTER in Akpajo, Port Harcourt, the November 7 RSVP deadline, the supplied family names, colors, WhatsApp number, and `#THEGOSPELS26`. It does not add sample couple photos, an MC, or guestbook messages. It intentionally does **not** create an admin login. Do not rerun the seeder over a live site expecting it to overwrite admin-managed content.

   For local or staging only, `php artisan db:seed --class=DemoPhotoSeeder` adds four labelled, inactive stock-photo entries to both Gallery Photos and Memories. This is not run by the default seeder. The images are remotely hosted, and demo-marked rows are excluded from the public site even if activated; never present them as the couple’s own photos.

5. Create the couple's admin account from the host shell. This interactive seeder prompts for the email, display name, and password (at least 12 characters) twice, then asks before creating or resetting the account. It never prints the password; share the chosen credentials privately with the couple. In production, `--force` is needed for Laravel's seeding confirmation, but the seeder still asks for its own confirmation:

   ```sh
   php artisan db:seed --class=AdminUserSeeder --force
   ```

   The existing `php artisan admin:create email@example.com "Wedding Admin"` command is an alternative.

6. Publish uploaded files and warm Laravel's caches:

   ```sh
   php artisan storage:link
   php artisan optimize:clear
   php artisan optimize
   ```

7. Sign in to **Admin → Wedding Settings** to review event details and add the couple's verified cash-gift account details if desired. Bank details are public; verify them carefully. The podcast URL and music file have not been supplied, so add only the couple's approved assets. Upload genuine photos in **Admin → Gallery Photos**; the first active server-uploaded photo anchors the center of the desktop triptych, while up to two taller photos frame it. Mobile hides the side panels and shows one center photo at a time. The first center image is preloaded at high priority; later center slides are requested only as the carousel advances. Other gallery and Memories images load lazily. New gallery uploads are resized to a maximum 1920 pixels and converted to WebP where the browser supports it; uploaded image responses are cached for a year. Use **Optimize existing photos** in **Admin → Gallery Photos** once to convert existing uploads; original source files are left in storage. The Open Graph and Twitter previews use the couple-provided portrait in a 1200×630 card at `public/images/og-wedding-couple.jpg`, independent of gallery order. **Admin → Memories** controls the separate Memories carousel. Keep `storage/app/public` persistent. New uploads are served through Laravel's `/media/...` route, so they do not depend on a public-storage symlink; legacy `/storage/...` URLs are also supported. `php artisan storage:link` remains recommended for any existing deployment.

Ensure `storage/` and `bootstrap/cache/` are writable by the PHP process. If using SQLite, create `database/database.sqlite` and place it on persistent storage before migrating. Do not regenerate `APP_KEY` on every deployment; changing it invalidates encrypted data and sessions.

## Updates and operations

For subsequent releases, build the assets, deploy the new code, run `php artisan migrate --force`, then refresh caches with `php artisan optimize:clear` and `php artisan optimize`. Keep the database, uploads, and `APP_KEY` persistent across releases. Back up the database and uploaded files; RSVP records contain guest names and phone numbers.

The default configuration stores sessions and cache in the database. The sample production environment uses `QUEUE_CONNECTION=sync`; if queued work is introduced, configure a queue backend and run a worker. The application does not send email or process or verify cash-gift transfers. Account details are displayed for guests to use with their own banking service.

Autoplay is best-effort: the podcast player requests muted autoplay and provides YouTube controls, while browsers may block background-music autoplay until the visitor taps the prominent **Play Music** control. Background music is paused when the podcast embed loads so the two tracks do not compete. Do not promise guaranteed audible autoplay.

RSVP and guestbook endpoints are rate-limited. Guestbook posts start unpublished; review and approve them in **Admin → Guestbook**. Login credentials are created separately with `AdminUserSeeder` or `admin:create`.

## Platform-specific setup

This guide is provider-neutral. Each host may require its own start command, PHP-FPM/Nginx configuration, build settings, persistent-volume settings, DNS records, and trusted-proxy configuration. Confirm those against the selected provider before launch. Do not use `php artisan serve` as the production web server.
