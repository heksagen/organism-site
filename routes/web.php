<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicSiteController;

/*
|--------------------------------------------------------------------------
| Public Site Routes
|--------------------------------------------------------------------------
| /          -> Landing page (new)
| /home      -> Existing DB-driven home (species list)
| /species/* -> Species pages
| /references-> References page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('public.landing');
})->name('landing');

Route::get('/home', [PublicSiteController::class, 'home'])->name('home');

Route::get('/species/{slug}', [PublicSiteController::class, 'species'])->name('species.show');
Route::get('/references', [PublicSiteController::class, 'references'])->name('references');
