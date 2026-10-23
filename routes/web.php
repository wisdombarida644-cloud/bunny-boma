<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\McController;
use App\Http\Controllers\Admin\QaController;
use App\Http\Controllers\Admin\RsvpController;

// Public Website Routes
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/rsvp', [FrontController::class, 'rsvpStore'])->name('rsvp.store');
Route::post('/guestbook', [FrontController::class, 'guestbookStore'])->name('guestbook.store');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Gifts
    Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.index');
    Route::post('/gifts', [GiftController::class, 'store'])->name('gifts.store');
    Route::put('/gifts/{gift}', [GiftController::class, 'update'])->name('gifts.update');
    Route::delete('/gifts/{gift}', [GiftController::class, 'destroy'])->name('gifts.destroy');

    // MC
    Route::get('/mc', [McController::class, 'edit'])->name('mc.edit');
    Route::post('/mc', [McController::class, 'update'])->name('mc.update');

    // Q&A
    Route::get('/qa', [QaController::class, 'index'])->name('qa.index');
    Route::post('/qa', [QaController::class, 'store'])->name('qa.store');
    Route::put('/qa/{qa}', [QaController::class, 'update'])->name('qa.update');
    Route::delete('/qa/{qa}', [QaController::class, 'destroy'])->name('qa.destroy');

    // RSVPs
    Route::get('/rsvps', [RsvpController::class, 'index'])->name('rsvps.index');
    Route::get('/rsvps/export', [RsvpController::class, 'export'])->name('rsvps.export');
});
