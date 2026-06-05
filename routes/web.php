<?php

use App\Http\Controllers\SpelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/spel/', [SpelController::class, 'spelSpelen']);

Route::post('/timm', [SpelController::class, 'timpost'])->name('timm');
