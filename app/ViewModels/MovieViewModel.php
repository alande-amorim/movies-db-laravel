<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{

    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        $genresFormatted = collect($this->movie['genres'])->map(function ($item, $key) {
            return sprintf('<a href="#" class="genre text-gray-400 hover:text-gray-200 hover:underline">%s</a>', $item['name']);
        })->implode(', ');

        return collect($this->movie)->merge([
            'title' => $this->movie['title'] . Carbon::parse($this->movie['release_date'])->format(' (Y)'),
            'poster_path' => 'https://image.tmdb.org/t/p/w500' . $this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => $genresFormatted,
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'cast' => collect($this->movie['credits']['cast'])->take(5)->map(function ($actor) {
                return collect($actor)->merge([
                    'profile_path' => $actor['profile_path'] ?
                        'https://image.tmdb.org/t/p/w300' . $actor['profile_path'] :
                        'https://ui-avatars.com/api/?size=300&name=' . $actor['name'],
                ]);
            }),
            'images' => collect($this->movie['images']['backdrops'])->take(2),
        ])->only([
            'poster_path',
            'id',
            'genres',
            'title',
            'vote_average',
            'overview',
            'release_date',
            'credits',
            'videos',
            'images',
            'crew',
            'cast',
        ]);
    }
}
