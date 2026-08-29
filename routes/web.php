<?php

use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
// V4: case studies are a core homepage section.
// Relinked per Redesign(5).md — Q9 resolved: KEEP + POPULATE.
Route::get('/work', [CaseStudyController::class, 'index'])->name('work');
Route::get('/case-study/{slug}', [CaseStudyController::class, 'show'])->name('case-study.show');
Route::redirect('/showcase', '/work', 301);
Route::redirect('/showcase.html', '/work', 301);
Route::get('/preview/{slug}', [PreviewController::class, 'show'])->name('preview.show');
Route::get('/preview/{slug}/{subpage}', [PreviewController::class, 'subpage'])
    ->where('subpage', '.*')
    ->name('preview.subpage');
Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
