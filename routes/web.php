<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/visi-misi', [HomeController::class, 'visionMission'])->name('vision-mission');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/partners', [HomeController::class, 'partners'])->name('partners');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management
    Route::get('profile',         [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile',         [ProfileController::class, 'update'])->name('profile.update');

    // Vision & Mission
    Route::get('/vision-mission', [VisionMissionController::class, 'edit'])->name('vision-mission.edit');
    Route::put('/vision-mission', [VisionMissionController::class, 'update'])->name('vision-mission.update');

    // Services
    Route::resource('services', ServiceAdminController::class);

    // Partners
    Route::resource('partners', PartnerController::class);

    // Gallery
    Route::resource('gallery', GalleryAdminController::class);
    Route::post('/gallery/upload', [GalleryAdminController::class, 'upload'])->name('gallery.upload');

    // Contact Messages
    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::patch('/messages/{message}/read', [ContactMessageController::class, 'markRead'])->name('messages.read');

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);

    // Team
    Route::resource('team', TeamMemberController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});
