@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">

        <!-- popular tv shows -->
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"><a href="{{ url('/tv/popular') }}">{{ $title }}</a></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($tvshows as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div><!-- end popular tv shows -->

    </div>
@endsection
