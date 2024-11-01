<?php

use App\Http\Controllers\SecretController;
use Illuminate\Support\Facades\Route;

Route::get('/',fn () => view('index'))->name('index');
Route::get('/secrets',[SecretController::class,'index'])->name('secrets.index');
Route::get('/secrets/create',[SecretController::class,'create'])->name('secrets.create');
Route::post('/secrets',[SecretController::class,'store'])->name('secrets.store');
Route::get('/secrets/{secret}',[SecretController::class,'show'])->name('secrets.show');
Route::delete('/secrets/{secret}',[SecretController::class,'destroy'])->name('secrets.destroy');
