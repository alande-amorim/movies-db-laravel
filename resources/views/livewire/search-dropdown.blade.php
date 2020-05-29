<div class="relative">
    <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" placeholder="Search">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>

    <ul class="absolute bg-gray-800 rounded w-64 mt-2 text-sm">
        @foreach($results as $movie)
            <li class="border-b border-gray-700">
                <a href="#" class="block hover:bg-gray-700 p-3">{{ $movie['original_title'] }} {{ \Carbon\Carbon::parse($movie['release_date'])->format('(Y)') }}</a>
            </li>
        @endforeach
    </ul>

</div>
