<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesListViewModel extends ViewModel
{

    public $movies;
    public $genres;
    public $type;

    public function __construct($movies, $genres, $type)
    {
        $this->movies = $movies;
        $this->genres = $genres;
        $this->type = $type;
    }

    public function title()
    {
        return $this->type === 'popular' ? 'Movies - Popular' : 'Movies - Now Playing';
    }

    public function movies()
    {
        return $this->formatMovies($this->movies);
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
        });
    }
}
