<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'movies/index');
Route::view('/movie', 'movies/show');
