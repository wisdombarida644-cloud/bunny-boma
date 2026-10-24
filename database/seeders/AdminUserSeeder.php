<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use LogicException;

/**
 * Interactively creates or resets the couple's shared CMS admin account.
 * Intentionally not included in DatabaseSeeder so setup never creates credentials silently.
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (! $this->command) {
            throw new LogicException('Run this seeder through Artisan so it can prompt securely for credentials.');
        }

        $email = strtolower(trim((string) $this->command->ask('Admin email')));
        $name = trim((string) $this->command->ask('Admin display name', 'Wedding Admin'));

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->command->error('Please provide a valid email address.');

            return;
        }

        if ($name === '' || strlen($name) > 255) {
            $this->command->error('The display name is required and must be 255 characters or fewer.');

            return;
        }

        $password = (string) $this->command->secret('Choose a password (at least 12 characters)');

        if (strlen($password) < 12) {
            $this->command->error('The password must contain at least 12 characters.');

            return;
        }

        $confirmation = (string) $this->command->secret('Confirm password');

        if (! hash_equals($password, $confirmation)) {
            $this->command->error('The passwords did not match.');

            return;
        }

        if (! $this->command->confirm("Create or reset the admin account for {$email}?", false)) {
            $this->command->warn('No admin account was changed.');

            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => $password]
        );

        $this->command->info("Admin account is ready for {$email}. The password was not displayed.");
    }
}
