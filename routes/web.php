<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getAllUser', [AdminControllers::class, 'getAllUser']);
