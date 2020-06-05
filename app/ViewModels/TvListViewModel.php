<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvListViewModel extends ViewModel
{
    public $tvshows;
    public $genres;
    public $type;

    public function __construct($tvshows, $genres, $type)
    {
        $this->tvshows = $tvshows;
        $this->genres = $genres;
        $this->type = $type;
    }

    public function title()
    {
        return $this->type === 'popular' ? 'TV - Popular' : 'TV - Top Rated';
    }

    public function tvshows()
    {
        return $this->formatTv($this->tvshows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
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
        });
    }
}
