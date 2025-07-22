<?php

use App\Http\Controllers\SectionController;
use App\Http\Controllers\UsefulLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'sections' => \App\Models\Section::with('links')->get()
    ]);
})->name('home');

// Rotas para Seções
Route::resource('sections', SectionController::class)->except(['show']);

// Rotas para Links Úteis
Route::resource('useful-links', UsefulLinkController::class)->except(['show']);