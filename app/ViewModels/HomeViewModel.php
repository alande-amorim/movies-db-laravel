<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class HomeViewModel extends ViewModel
{

    public $popularMovies;
    public $popularTvShows;
    public $genres;

    public function __construct($popularMovies, $popularTvShows, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->popularTvShows = $popularTvShows;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function popularTvShows()
    {
        return $this->formatTv($this->popularTvShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($moviesArray)
    {

        return collect($moviesArray)->map(function ($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [
                    $value => sprintf('<a href="#" class="text-gray-400 hover:text-gray-200 hover:underline">%s</a>', $this->genres()->get($value))
                ];
            })->implode(', ');

            $posterPath = $movie['poster_path']
                ? 'https://image.tmdb.org/t/p/w342' . $movie['poster_path']
                : 'https://via.placeholder.com/224x336';

            return collect($movie)->merge([
                'poster_path' => $posterPath,
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'id',
                'genre_ids',
                'title',
                'vote_average',
                'overview',
                'release_date',
                'poster_path',
                'genres',
            ]);
        })->take(15);
    }

    private function formatTv($tv)
    {
        return collect($tv)->map(function ($tvShow) {
            $genresFormatted = collect($tvShow['genre_ids'])->mapWithKeys(function ($value) {
                return [
                    $value => sprintf('<a href="#" class="text-gray-400 hover:text-gray-200 hover:underline">%s</a>', $this->genres()->get($value))
                ];
            })->implode(', ');

            return collect($tvShow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500' . $tvShow['poster_path'],
                'vote_average' => $tvShow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'id',
                'genre_ids',
                'name',
                'vote_average',
                'overview',
                'first_air_date',
                'poster_path',
                'genres',
            ]);
        })->take(15);
    }
}
