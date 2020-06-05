<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class SearchViewModel extends ViewModel
{

    public $results;

    public function __construct($results)
    {
        $this->results = $results;
    }

    public function results()
    {
        return collect($this->results)->map(function ($item) {

            if ($item['media_type'] === 'tv') {
                $title = sprintf('%s (%s)', $item['original_name'], Carbon::parse($item['first_air_date'])->format('(Y)'));
                $url = route('tv.show', $item['id']);
                $image = $item['backdrop_path'];
                $type = 'TV';
            } elseif ($item['media_type'] === 'movie') {
                $title = sprintf('%s (%s)', $item['original_title'], Carbon::parse($item['release_date'])->format('(Y)'));
                $url = route('movies.show', $item['id']);
                $image = $item['poster_path'];
                $type = 'Movie';
            } elseif ($item['media_type'] === 'person') {
                $title = $item['name'];
                $url = route('actors.show', $item['id']);
                $image = $item['profile_path'];
                $type = 'Person';
            } else {
                dd($item);
                return;
            }

            return collect($item)->merge([
                'title' => $title,
                'url' => $url,
                'image' => $image
                    ? 'https://image.tmdb.org/t/p/w92' . $image
                    : 'https://via.placeholder.com/50x75',
                'type' => $type,
            ]);
        });
    }
}
