<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemoController;

/*
|--------------------------------------------------------------------------
| Multi-Page Architecture — Bootstrap 5 + Material Design 3
|--------------------------------------------------------------------------
| Home        → /
| Case Studies → /case-studies
| Services    → /services
| About       → /about
| Contact     → /contact
| Demo Lab    → /demo-lab
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

// Design Partner page
Route::get('/design-partner', function () {
    $meta = [
        'title' => 'Become a Design Partner | ' . config('brand.name'),
        'description' => 'No customer logos yet, we will not fake them. Become a design partner and work directly with the team building your project.',
        'og_image' => asset('og-image.jpg'),
    ];
    return view('pages.design-partner', compact('meta'));
})->name('design-partner');

// Contact
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/api/contact', [ContactController::class, 'store'])->name('contact.store');

// Demo Lab
Route::get('/demo-lab', [PageController::class, 'demos'])->name('demos');

// Demo content — serves demo HTML/CSS/JS/images dynamically through Laravel.
// Why: the production server (nginx) routes all requests through Laravel's
// front controller, so direct file access to public/demos/*.html returns
// 403 Forbidden. This route reads files from the filesystem and streams them
// through Laravel's response system, bypassing the web server's static-file
// restrictions. See DemoController for security details.
Route::get('/demo-content/{slug}/{path?}', [DemoController::class, 'serve'])
    ->where('path', '.*')
    ->name('demo.content');

// Legacy redirects
Route::get('/showcase', function () {
    return redirect()->route('case-studies.index', [], 301);
});

// Legacy /demos → /demo-lab
// The old /demos URL conflicted with the physical public/demos/ directory.
// nginx returned 403 on /demos/ because it tried to serve the directory
// listing instead of routing to Laravel. The route is now /demo-lab.
Route::get('/demos', function () {
    return redirect()->route('demos', [], 301);
})->name('demos.legacy');

// Preview system (preserved — do not modify)
Route::get('/preview/{slug}', [PageController::class, 'preview'])->name('preview.show');
Route::get('/preview/{slug}/{subpage}', [PageController::class, 'previewSubpage'])->name('preview.subpage');

// Sitemap
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
