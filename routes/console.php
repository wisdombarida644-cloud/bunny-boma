<?php

use Illuminate\Foundation\Inspiring;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {email} {name}', function (string $email, string $name) {
    $email = strtolower(trim($email));

    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error('Please provide a valid email address.');

        return 1;
    }

    $password = $this->secret('Choose a password (at least 12 characters)');

    if (strlen($password) < 12) {
        $this->error('The password must contain at least 12 characters.');

        return 1;
    }

    if (! hash_equals($password, $this->secret('Confirm password'))) {
        $this->error('The passwords did not match.');

        return 1;
    }

    User::updateOrCreate(
        ['email' => $email],
        ['name' => trim($name), 'password' => $password]
    );

    $this->info("Admin account saved for {$email}.");

    return 0;
})->purpose('Create or reset an admin account securely');
