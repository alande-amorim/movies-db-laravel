<?php

namespace App\Http\Livewire;

use App\ViewModels\SearchViewModel;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{

    public $search = '';

    public function render()
    {
        $results = [];

        if (strlen($this->search) > 2) {
            $results = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/multi?query=' . $this->search)
                ->json()['results'];
        }

        return view('livewire.search-dropdown', new SearchViewModel($results));
    }
}
