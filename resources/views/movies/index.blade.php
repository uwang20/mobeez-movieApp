@extends('layouts.main')

@section('welcome-banner')
  <div class="container mx-auto h">

  </div>
@endsection


@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies mb-24" x-data="{tab:'popular'}">
            <h4 @click="tab='popular'" class="cursor-default uppercase tracking-wider text-xs sm:text-sm md:text-base lg:text-lg font-semibold p-2 flex inline-flex rounded-t-md"
                                      :class="{'bg-white text-black': tab==='popular'}">Popular Movies</h4>
            <h4 @click="tab='nowPlaying'" class="cursor-default uppercase tracSking-wider text-xs sm:text-sm md:text-base lg:text-lg font-semibold  p-2 flex inline-flex rounded-t-md"
                                          :class="{'bg-white text-black': tab==='nowPlaying'}">Now Playing</h4>
            <h4 @click="tab='upComing'" class="cursor-default uppercase tracSking-wider text-xs sm:text-sm md:text-base lg:text-lg font-semibold  p-2 flex inline-flex rounded-t-md"
                                          :class="{'bg-white text-black': tab==='upComing'}">Upcoming Movies</h4>
            <h4 @click="tab='topRated'" class="cursor-default uppercase tracSking-wider text-xs sm:text-sm md:text-base lg:text-lg font-semibold  p-2 flex inline-flex rounded-t-md"
                                          :class="{'bg-white text-black': tab==='topRated'}">Top Rated</h4>
            <div x-show="tab==='popular'" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6 mg:gap-6 lg:gap-6 border-rounded-10-corner-ltb p-2 sm:p-4 md:p-4 lg:p-4 bg-white">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
            <div x-show="tab==='nowPlaying'" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6 mg:gap-6 lg:gap-6 border-rounded-10-corner-ltb p-2 sm:p-4 md:p-4 lg:p-4 bg-white">
                @foreach ($nowPlayingMovies as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
            <div x-show="tab==='upComing'" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6 mg:gap-6 lg:gap-6 border-rounded-10-corner-ltb p-2 sm:p-4 md:p-4 lg:p-4 bg-white">
                @foreach ($upcomingMovies as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
            <div x-show="tab==='topRated'" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6 mg:gap-6 lg:gap-6 border-rounded-10-corner-ltb p-2 sm:p-4 md:p-4 lg:p-4 bg-white">
                @foreach ($topRatedMovies as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{-- <div class="container mx-auto px-4 pt-16">
    <div class="popular-movies">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($popularMovies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach

        </div>
    </div> <!-- end pouplar-movies -->

    <div class="now-playing-movies py-24">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($nowPlayingMovies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </div>
    </div> <!-- end now-playing-movies -->
</div> --}}
