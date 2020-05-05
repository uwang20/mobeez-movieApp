<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/movie/popular')
                        ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/movie/now_playing')
                        ->json()['results'];

        $upcomingMovies = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/movie/upcoming'.'?region=US')
                        ->json()['results'];

        $topRatedMovies = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/movie/top_rated')
                        ->json()['results'];


        function genres(){
          $allMovieGenres = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/genre/movie/list')
                        ->json()['genres'];

          return collect($allMovieGenres)->mapWithKeys(function ($genre){
              return [$genre['id'] => $genre['name']];
          });
        }

        function setMovies($movies){
          return collect($movies)->map(function ($movie){
              $movieGenres = collect($movie['genre_ids'])->mapWithKeys(function ($value){
                return [$value => genres()->get($value)];
              })->implode(', ');
            return collect($movie)->merge([
              'poster_path' => $movie['poster_path']? 'https://image.tmdb.org/t/p/w220_and_h330_face'.$movie['poster_path']:'https://via.placeholder.com/220x330/F1C40F/000000?text='.$movie['title'],
              'vote_average' => $movie['vote_average'] * 10 .'%',
              'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
              'genres' => $movieGenres
            ]);
        });
        }

        // dump($upcomingMovies);

        return view('movies.index',[
            'popularMovies' => setMovies($popularMovies),
            'nowPlayingMovies' => setMovies($nowPlayingMovies),
            'upcomingMovies' => setMovies($upcomingMovies),
            'topRatedMovies' => setMovies($topRatedMovies)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
                        ->json();

                        // dd($movie);

        $hour = floor($movie['runtime'] / 60);
        $min = $movie['runtime'] - 60*$hour;

        $runtime = $hour.'h '.$min.'min';

        $genres = collect($movie['genres'])->implode('name',', ');

        $movie = collect($movie)->merge([
            'backdrop_path' => 'https://image.tmdb.org/t/p/w1280'.$movie['backdrop_path'],
            'poster_path' => 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
            'vote_average' => $movie['vote_average'] * 10 .'%',
            'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
            'runtime' => $runtime,
            'genres' => $genres,
            'cast' => collect($movie['credits']['cast'])->take(10),
            'full-cast' => collect($movie['credits']['cast']),
            'crew' => collect($movie['credits']['crew'])->take(3),
            'full-crew' => collect($movie['credits']['crew']),
            'poster-images' => collect($movie['images']['backdrops'])->take(9),
            'trailer' => $movie['videos']['results'][0]['key'],
            'trailer-list' => collect($movie['videos']['results'])
          ]);

          $palette = Palette::fromFilename($movie['backdrop_path']);

          $topFive = $palette->getMostUsedColors(5);
          $extractor = new ColorExtractor($palette);
          $color = $extractor->extract(1);
          $mainColor = Color::fromIntToRgb($color[0]);

          $mainRgbOrig = 'rgb('.$mainColor['r'].','.$mainColor['g'].','.$mainColor['b'].')';
          $black = 'rgb(0,0,0)';
          $black09 = 'rgba(0,0,0,0.9)';
          $black07 = 'rgba(0,0,0,0.7)';
          $black05 = 'rgba(0,0,0,0.5)';

          $mainRgb = collect([$mainRgbOrig,$black,$black09,$black07,$black05]);

          dump($movie);

        return view('movies.show',[
            'movie' => $movie,
            'color' => $mainRgb
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
