<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GuestbookController;
use App\Http\Controllers\Admin\McController;
use App\Http\Controllers\Admin\MemoryController;
use App\Http\Controllers\Admin\QaController;
use App\Http\Controllers\Admin\RsvpController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

// Public website and submission endpoints.
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/rsvp', [FrontController::class, 'rsvpStore'])
    ->middleware('throttle:10,1')
    ->name('rsvp.store');
Route::post('/guestbook', [FrontController::class, 'guestbookStore'])
    ->middleware('throttle:5,1')
    ->name('guestbook.store');

// Authentication.
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// All CMS routes require an authenticated user.
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/memories', [MemoryController::class, 'index'])->name('memories.index');
    Route::post('/memories', [MemoryController::class, 'store'])->name('memories.store');
    Route::put('/memories/{moment}', [MemoryController::class, 'update'])->name('memories.update');
    Route::delete('/memories/{moment}', [MemoryController::class, 'destroy'])->name('memories.destroy');

    Route::get('/mc', [McController::class, 'edit'])->name('mc.edit');
    Route::post('/mc', [McController::class, 'update'])->name('mc.update');

    Route::get('/qa', [QaController::class, 'index'])->name('qa.index');
    Route::post('/qa', [QaController::class, 'store'])->name('qa.store');
    Route::put('/qa/{qa}', [QaController::class, 'update'])->name('qa.update');
    Route::delete('/qa/{qa}', [QaController::class, 'destroy'])->name('qa.destroy');

    Route::get('/guestbook', [GuestbookController::class, 'index'])->name('guestbook.index');
    Route::patch('/guestbook/{guestbook}', [GuestbookController::class, 'update'])->name('guestbook.update');
    Route::delete('/guestbook/{guestbook}', [GuestbookController::class, 'destroy'])->name('guestbook.destroy');

    Route::get('/rsvps', [RsvpController::class, 'index'])->name('rsvps.index');
    Route::get('/rsvps/export', [RsvpController::class, 'export'])->name('rsvps.export');
});
