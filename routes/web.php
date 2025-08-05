<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

Route::get('/', [SiswaController::class, 'index']);

Route::get('/siswa/create',[SiswaController::class,'store']);

Route::post('/siswa/store',[SiswaController::class,'store']);

