<?php

namespace App\Http\Controllers;

use App\ViewModels\TvListViewModel;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];

        $topRatedTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];

        $genres =  Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        return view(
            'tv.index',
            new TvViewModel($popularTv, $topRatedTv, $genres)
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
        $tvshow = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        return view(
            'tv.show',
            new TvShowViewModel($tvshow)
        );
    }

    /**
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function list($type)
    {
        if ($type === 'popular') {
            $tvShows = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/tv/popular')
                ->json()['results'];
        } else {
            $tvShows = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/tv/top_rated')
                ->json()['results'];
        }

        $genres =  Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        return view(
            'tv.list',
            new TvListViewModel($tvShows, $genres, $type)
        );
    }
}
