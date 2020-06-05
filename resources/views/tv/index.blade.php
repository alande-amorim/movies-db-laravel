@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">

        <!-- popular tv shows -->
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"><a href="{{ url('/tv/popular') }}">TV - Popular</a></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTvShows as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div><!-- end popular tv shows -->

        <!-- top rated tv shows -->
        <div class="top-rated-shows py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"><a href="{{ url('/tv/top-rated') }}">TV - Top Rated</a></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topRatedTvShows as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div><!-- end top rated tv shows -->

    </div>
@endsection
