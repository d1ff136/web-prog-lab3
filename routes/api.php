<?php

use App\Http\Controllers\Api\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/catalog', [CatalogController::class, 'index'])->name('api.catalog.index');
Route::get('/catalog/{slug}', [CatalogController::class, 'show'])->name('api.catalog.show');