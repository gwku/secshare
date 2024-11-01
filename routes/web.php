<?php

use App\Http\Controllers\SecretController;
use Illuminate\Support\Facades\Route;

Route::get('/',fn () => view('index'))->name('index');
Route::resource('secrets',SecretController::class)->except(['update']);
