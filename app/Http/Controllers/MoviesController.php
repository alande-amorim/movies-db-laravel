<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesListViewModel;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];

        $genres =  Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        return view(
            'movies.index',
            new MoviesViewModel($popularMovies, $nowPlayingMovies, $genres)
        );
    }

    public function list($type)
    {

        if ($type === 'popular') {
            $movies = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/popular')
                ->json()['results'];
        } else {
            $movies = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/now_playing')
                ->json()['results'];
        }

        $genres =  Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        return view(
            'movies.list',
            new MoviesListViewModel($movies, $genres, $type)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        return view(
            'movies.show',
            new MovieViewModel($movie)
        );
    }
}
