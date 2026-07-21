<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/showcase', [PageController::class, 'showcase'])->name('showcase');
Route::redirect('/showcase.html', '/showcase', 301);
Route::get('/preview/{slug}', [PreviewController::class, 'show'])->name('preview.show');
Route::get('/preview/{slug}/{subpage}', [PreviewController::class, 'subpage'])
    ->where('subpage', '.*')
    ->name('preview.subpage');
Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
