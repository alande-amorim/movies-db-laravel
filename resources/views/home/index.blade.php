@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">

        <!-- popular movies -->
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"><a href="{{ url('movies/popular') }}">Movies - Popular</a></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div><!-- end popular movies -->

        <!-- popular tv shows -->
        <div class="top-rated-shows py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"><a href="{{ url('tv/popular') }}">TV - Popular</a></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTvShows as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div><!-- end rated tv shows -->

    </div>
@endsection
