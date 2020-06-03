<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{

    public $popularActors;
    public $page;

    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors()
    {
        return collect($this->popularActors)->map(function ($actor) {

            $movies = collect($actor['known_for'])->where('media_type', 'movie')->pluck('title', 'id')->union(
                collect($actor['known_for'])->where('media_type', 'tv')->pluck('name', 'id')
            )->map(function ($movie, $key) {
                return sprintf(
                    '<a href="%s" class="text-gray-400 hover:text-gray-200 hover:underline">%s</a>',
                    route('movies.show', $key),
                    $movie
                );
            })->implode(', ');

            $profilePath = $actor['profile_path'] ?
                'https://image.tmdb.org/t/p/w235_and_h235_face/' . $actor['profile_path'] :
                'https://ui-avatars.com/api/?size=235&name=' . $actor['name'];

            return collect($actor)->merge([
                'profile_path' => $profilePath,
                'movies' => $movies,
            ])->only([
                'id', 'name', 'movies', 'profile_path'
            ]);
        })->dump();
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
