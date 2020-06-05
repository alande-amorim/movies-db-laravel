<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true}" @click.away="isOpen = false">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
        placeholder="Search (Press &quot;/&quot; to focus)"
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 191 || event.keyCode === 111) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

    @if(strlen($search) > 2)
        @if($results->count() > 0)
            <ul
                id="search-results-list"
                class="absolute bg-gray-800 rounded w-64 mt-2 text-sm overflow-y-auto max-h-1/3 z-10"
                x-show.transition.opacity="isOpen"
            >
                @foreach($results as $item)
                    <li class="border-b border-gray-700">
                        <a
                            href="{{ $item['url'] }}"
                            class="block hover:bg-gray-700 p-3 flex items-center"
                            @if ($loop->last) @keydown.tab.exact="isOpen = false" @endif
                        >

                            <img src="{{ $item['image'] }}" alt="poster" class="w-8">
                            <div class="ml-2 flex flex-col">
                                <span class="text-xs text-gray-500">{{ $item['type'] }}</span>
                                <span>{{ $item['title'] }}</span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="absolute bg-gray-800 rounded w-64 mt-2 text-sm p-3">No results for: "{{ $search }}"</div>
        @endif
    @endif

</div>
