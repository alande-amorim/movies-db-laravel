<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{

    public $tvshow;

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
    }

    public function tvshow()
    {
        $genresFormatted = collect($this->tvshow['genres'])->map(function ($item, $key) {
            return sprintf('<a href="#" class="genre text-gray-400 hover:text-gray-200 hover:underline">%s</a>', $item['name']);
        })->implode(', ');

        return collect($this->tvshow)->merge([
            'name' => $this->tvshow['name'] . Carbon::parse($this->tvshow['first_air_date'])->format(' (Y)'),
            'poster_path' => 'https://image.tmdb.org/t/p/w500' . $this->tvshow['poster_path'],
            'vote_average' => $this->tvshow['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => $genresFormatted,
            'crew' => collect($this->tvshow['credits']['crew'])->take(2),
            'cast' => collect($this->tvshow['credits']['cast'])->take(5)->map(function ($actor) {
                return collect($actor)->merge([
                    'profile_path' => $actor['profile_path'] ?
                        'https://image.tmdb.org/t/p/w300' . $actor['profile_path'] :
                        'https://ui-avatars.com/api/?size=300&name=' . $actor['name'],
                ]);
            }),
            'images' => collect($this->tvshow['images']['backdrops'])->take(2),
        ])->only([
            'poster_path',
            'id',
            'genres',
            'name',
            'vote_average',
            'overview',
            'first_air_date',
            'credits',
            'videos',
            'images',
            'crew',
            'cast',
            'created_by',
        ]);
    }
}
