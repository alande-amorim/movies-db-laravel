<div class="relative">
    <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" placeholder="Search">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

    @if(strlen($search) > 2)
        @if($results->count() > 0)
            <ul id="search-results-list" class="absolute bg-gray-800 rounded w-64 mt-2 text-sm overflow-y-auto max-h-1/3">
                @foreach($results as $movie)
                <li class="border-b border-gray-700">
                    <a href="{{ route('movies.show', $movie['id']) }}" class="block hover:bg-gray-700 p-3 flex items-center">
                        @if($movie['poster_path'])
                            <img src="https://image.tmdb.org/t/p/w92/{{ $movie['poster_path'] }}" alt="poster" class="w-8">
                        @else
                            <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                        @endif
                        <span class="ml-2">{{ $movie['original_title'] }} {{ \Carbon\Carbon::parse($movie['release_date'])->format('(Y)') }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        @else
            <div class="absolute bg-gray-800 rounded w-64 mt-2 text-sm p-3">No results for: "{{ $search }}"</div>
        @endif
    @endif

</div>