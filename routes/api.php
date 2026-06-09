<?php

use App\Http\Controllers\Api\ContactInquiryController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TestimonialController;
use Illuminate\Support\Facades\Route;

// ── Public read-only endpoints (consumed by React frontend) ───────────
Route::get('/services',           [ServiceController::class, 'index']);
Route::get('/services/{slug}',    [ServiceController::class, 'show']);

Route::get('/portfolios',         [PortfolioController::class, 'index']);
Route::get('/portfolios/{slug}',  [PortfolioController::class, 'show']);

Route::get('/testimonials',       [TestimonialController::class, 'index']);

// ── Public write endpoint ─────────────────────────────────────────────
Route::post('/contact',           [ContactInquiryController::class, 'store']);
