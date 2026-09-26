<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about-us', [SiteController::class, 'about'])->name('about');
Route::get('/our-services', [SiteController::class, 'services'])->name('services');
Route::get('/contact-us', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact-us', [SiteController::class, 'send'])->name('contact.send');

Route::get('/{slug}', [SiteController::class, 'show'])
    ->where('slug', 'wall-saw-cutting|floor-saw-cutting|core-cutting|concrete-scanning|wire-saw-cutting|concrete-slab-3d-scanning|concrete-slab-core-cutting|concrete-staircase-demolition|concrete-slab-demolition|concrete-wall-core-cutting|concrete-demolition|concrete-beam-cutting|concrete-beam-core-cutting|concrete-demolition-services-uae|core-cutting-services-uae|concrete-cutting-services-uae')
    ->name('page');
