<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class TvShowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $popularTvShows = Http::withToken(config('services.tmdb.token'))
                      ->get('https://api.themoviedb.org/3/tv/popular')
                      ->json()['results'];

      $airingTodayTvShows = Http::withToken(config('services.tmdb.token'))
                      ->get('https://api.themoviedb.org/3/tv/airing_today')
                      ->json()['results'];

      $onTvTvShows = Http::withToken(config('services.tmdb.token'))
                      ->get('https://api.themoviedb.org/3/tv/on_the_air')
                      ->json()['results'];

      $topRatedTvShows = Http::withToken(config('services.tmdb.token'))
                      ->get('https://api.themoviedb.org/3/tv/top_rated')
                      ->json()['results'];

      function genres(){
          $allMovieGenres = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/genre/tv/list')
                        ->json()['genres'];

          $allMovieGenres = collect($allMovieGenres)->merge([
            '16' => ['id' => '878', 'name' => 'Science Fiction']
          ]);

          return collect($allMovieGenres)->mapWithKeys(function ($genre){
              return [$genre['id'] => $genre['name']];
          });
      }

      function setTvShows($tvs){
        return collect($tvs)->map(function ($tv){
            $tvGenres = collect($tv['genre_ids'])->mapWithKeys(function ($value){
              return [$value => genres()->get($value)];
            })->implode(', ');
          return collect($tv)->merge([
            'poster_path' => $tv['poster_path']? 'https://image.tmdb.org/t/p/w220_and_h330_face'.$tv['poster_path']:'https://via.placeholder.com/220x330/F1C40F/000000?text='.$tv['name'],
            'vote_average' => $tv['vote_average'] * 10 .'%',
            'first_air_date' => Carbon::parse($tv['first_air_date'])->format('M d, Y'),
            'genres' => $tvGenres
          ]);
      });
      }

      // dump($airingTodayTvShows);
      // dump(genres());

      return view('tv.index',[
          'popularTvShows' => setTvShows($popularTvShows),
          'airingTodayTvShows' => setTvShows($airingTodayTvShows),
          'onTvTvShows' => setTvShows($onTvTvShows),
          'topRatedTvShows' => setTvShows($topRatedTvShows)
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
      $tvShow = Http::withToken(config('services.tmdb.token'))
                      ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')
                      ->json();

      $genres = collect($tvShow['genres'])->implode('name',', ');

      $tvShow = collect($tvShow)->merge([
          'backdrop_path' => 'https://image.tmdb.org/t/p/w1280'.$tvShow['backdrop_path'],
          'poster_path' => $tvShow['poster_path']? 'https://image.tmdb.org/t/p/w500'.$tvShow['poster_path'] : 'https://via.placeholder.com/500x750/F1C40F/000000?text='.$tvShow['name'],
          'vote_average' => $tvShow['vote_average'] * 10 .'%',
          'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
          // 'runtime' => $runtime,
          'genres' => $genres,
          'cast' => collect($tvShow['credits']['cast'])->take(10),
          'full-cast' => collect($tvShow['credits']['cast']),
          'crew' => collect($tvShow['credits']['crew'])->take(3),
          'full-crew' => collect($tvShow['credits']['crew']),
          'poster-images' => collect($tvShow['images']['backdrops'])->take(9),
          'trailer' => $tvShow['videos']['results']? $tvShow['videos']['results'][0]['key']: '',
          'trailer-list' => collect($tvShow['videos']['results']),
        ]);

        $tvShowSeasons = collect($tvShow['seasons'])->map(function ($season){
          return collect($season)->merge([
            'poster_path' => $season['poster_path']? 'https://image.tmdb.org/t/p/w150_and_h225_bestv2/'.$season['poster_path'] : 'https://via.placeholder.com/220x330/F1C40F/000000?text='.$season['name'],
            'air_date' => $season['air_date'],
            'episodes' => $season['episode_count'] .'EP'
          ]);
        });
        // dd($tvShowSeasons);

        $palette = Palette::fromFilename($tvShow['backdrop_path']);

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

        // dump($tvShow);
        return view('tv.show',[
          'tvShow' => $tvShow,
          'tvShowSeasons' => $tvShowSeasons,
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
