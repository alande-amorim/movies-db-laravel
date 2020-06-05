<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/movies', 'MoviesController@index')->name('movies.index');
Route::get('/movies/popular', 'MoviesController@list')->defaults('type', 'popular');
Route::get('/movies/now-playing', 'MoviesController@list')->defaults('type', 'now-playing');
Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/popular', 'TvController@list')->defaults('type', 'popular');
Route::get('/tv/top-rated', 'TvController@list')->defaults('type', 'top-rated');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');

Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page}', 'ActorsController@index');
Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');
