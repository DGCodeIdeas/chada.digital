<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Multi-Page Architecture — Bootstrap 5 + Material Design 3
|--------------------------------------------------------------------------
| Home        → /
| Case Studies → /case-studies
| Services    → /services
| About       → /about
| Contact     → /contact
| Demo Lab    → /demos
| Preview     → /preview/{slug} (preserved)
| Sitemap     → /sitemap.xml (preserved)
*/

// Home
Route::get('/', [PageController::class, 'home'])->name('home');

// Case Studies
Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies.index');
Route::get('/case-study/{slug}', [CaseStudyController::class, 'show'])->name('case-study.show');

// Services
Route::get('/services', [PageController::class, 'services'])->name('services');

// About
Route::get('/about', [PageController::class, 'about'])->name('about');

// Contact
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/api/contact', [ContactController::class, 'store'])->name('contact.store');

// Demo Lab
Route::get('/demos', [PageController::class, 'demos'])->name('demos');

// Legacy showcase redirect
Route::get('/showcase', function () {
    return redirect()->route('case-studies.index', [], 301);
});

// Preview system (preserved — do not modify)
Route::get('/preview/{slug}', [PageController::class, 'preview'])->name('preview.show');
Route::get('/preview/{slug}/{subpage}', [PageController::class, 'previewSubpage'])->name('preview.subpage');

// Sitemap
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
