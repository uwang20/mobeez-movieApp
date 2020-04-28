<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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
              'poster_path' => 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
              'vote_average' => $movie['vote_average'] * 10 .'%',
              'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
              'genres' => $movieGenres
            ]);
        });
        }

        return view('movies.index',[
            'popularMovies' => setMovies($popularMovies),
            'nowPlayingMovies' => setMovies($nowPlayingMovies)
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
            'trailer' => collect($movie['videos']['results'][0]['key']),
            'trailer-list' => collect($movie['videos']['results'])
          ]);

          // dd($movie);

        return view('movies.show',[
            'movie' => $movie
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
