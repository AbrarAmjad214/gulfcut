<?php

use App\Http\Controllers\SiteController;
use App\Support\GulfCut;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about-us', [SiteController::class, 'about'])->name('about');
Route::get('/our-services', [SiteController::class, 'services'])->name('services');
Route::get('/contact-us', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact-us', [SiteController::class, 'send'])->middleware('throttle:5,10')->name('contact.send');
Route::get('/thank-you', [SiteController::class, 'thanks'])->name('thanks');
Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');
Route::get('/concrete-cutting-wall-saw-demolition-contractor', [SiteController::class, 'contractor'])->name('contractor');

// Old WordPress URLs. Trailing slashes are already stripped by RedirectTrailingSlash, so one hop each.
Route::permanentRedirect('/concrete-demolition', '/concrete-demolition-services-uae');
Route::permanentRedirect('/core-cutting', '/core-cutting-services-uae');

Route::get('/projects', [SiteController::class, 'projects'])->name('projects');
Route::get('/projects/{slug}', [SiteController::class, 'project'])->name('projects.show');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [SiteController::class, 'post'])->name('blog.show');

Route::get('/{slug}', [SiteController::class, 'show'])
    ->where('slug', implode('|', GulfCut::servicePages()))
    ->name('page');
