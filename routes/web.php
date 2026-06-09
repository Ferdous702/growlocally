<?php

use App\Http\Controllers\Admin\AuthController;
use App\Livewire\Admin\ContactManager;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\PortfolioCategoryManager;
use App\Livewire\Admin\PortfolioManager;
use App\Livewire\Admin\ServiceManager;
use App\Livewire\Admin\TestimonialManager;
use Illuminate\Support\Facades\Route;

// ── Auth ──────────────────────────────────────────────────────────────
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ── Admin Panel (auth-protected) ──────────────────────────────────────
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard',            Dashboard::class)->name('dashboard');
    Route::get('/services',             ServiceManager::class)->name('services');
    Route::get('/portfolio-categories', PortfolioCategoryManager::class)->name('portfolio-categories');
    Route::get('/portfolios',           PortfolioManager::class)->name('portfolios');
    Route::get('/testimonials',         TestimonialManager::class)->name('testimonials');
    Route::get('/contacts',             ContactManager::class)->name('contacts');
});
