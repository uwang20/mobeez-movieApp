<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;



class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
                        ->json()['results'];

        // dd($popularActors);

        $popularActors = collect($popularActors)->map(function ($actor){
          return collect($actor)->merge([
            'profile_path' => $actor['profile_path']
            ? 'https://image.tmdb.org/t/p/w235_and_h235_face'.$actor['profile_path']
            : (($actor['gender']==1)? 'https://ui-avatars.com/api/?background=FFBED2&size=235&name='.$actor['name'] : ($actor['gender']==2?'https://ui-avatars.com/api/?background=6CC5F6&size=235&name='.$actor['name']
            :'https://ui-avatars.com/api/?background=F1C40F&size=235&name='.$actor['name'])),
            'known_for' => collect($actor['known_for'])->where('media_type','tv')->pluck('name')
            ->union(collect($actor['known_for'])->where('media_type','movie')->pluck('title'))->implode(', '),
          ]);
        })->dump();

        function next($page){
          return ($page < 500)? $page + 1: null;
        }

        function previous($page){
          return ($page > 1)? $page - 1: null;
        }

        return view('actors.index',[
          'popularActors' => $popularActors,
          'next' => next($page),
          'previous' => previous($page)
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
        $actor = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id)
                        ->json();

        $social = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')
                        ->json();

        $movieCredits = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.'/movie_credits')
                        ->json();

        $combinedCredits = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
                        ->json();

        $images = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.'/images')
                        ->json();

        $actor = collect($actor)->merge([
          'profile_path' => $actor['profile_path']? 'https://image.tmdb.org/t/p/w300_and_h450_bestv2'.$actor['profile_path']
           : ($actor['gender']==1? 'https://ui-avatars.com/api/?background=FFBED2&size=300&name='.$actor['name'] : ($actor['gender']==2?'https://ui-avatars.com/api/?background=6CC5F6&size=235&name='.$actor['name']
           :'https://ui-avatars.com/api/?background=F1C40F&size=235&name='.$actor['name'])),
          'birthday' => Carbon::parse($actor['birthday'])->format('M d, Y'),
          'gender' => $actor['gender'] == 1? 'Female':($actor['gender'] == 2? 'Male':'Unknown'),
          'age' => Carbon::parse($actor['birthday'])->age,
          'biography' => $actor['biography']? $actor['biography'] : 'The TMDB has no biography for '. $actor['name'] .'.'
        ]);

        $movieCredits = collect($combinedCredits['cast'])->where('media_type','movie')->map(function ($movie){
          if(isset($movie['release_date'])){
            $releaseDate = $movie['release_date'];
          }else{
            $releaseDate = '';
          }

          if(isset($movie['title'])){
            $title = $movie['title'];
          }else{
            $title = 'Untitled';
          }

          return collect($movie)->merge([
            'release_date' => $releaseDate,
            'release_year' => $releaseDate? Carbon::parse($releaseDate)->format('Y') : '-----',
            'title' => $title,
            'character' => isset($movie['character'])? $movie['character']:'-----'
          ]);
        })->sortByDesc('release_date');

        // dd($movieCredits);

        $tvShowCredits = collect($combinedCredits['cast'])->where('media_type','tv')->map(function ($tv_show){
          if(isset($tv_show['first_air_date'])){
            $firstAirDate = $tv_show['first_air_date'];
          }else{
            $firstAirDate = '';
          }

          if(isset($tv_show['title'])){
            $title = $tv_show['title'];
          }else{
            $title = 'Untitled';
          }

          return collect($tv_show)->merge([
            'first_air_date' => $firstAirDate,
            'first_air_year' => $firstAirDate? Carbon::parse($firstAirDate)->format('Y') : '-----',
            'title' => $title,
            'character' => isset($tv_show['character'])? $tv_show['character']:'-----'
          ]);
        })->sortByDesc('first_air_date');

        $knownMovies = collect($combinedCredits['cast'])->where('media_type','movie')->sortByDesc('popularity')->take(6)->map(function ($movie){
          return collect($movie)->merge([
            'poster_path' => $movie['poster_path']? 'https://image.tmdb.org/t/p/w150_and_h225_bestv2/'.$movie['poster_path'] : 'https://via.placeholder.com/150x225/F1C40F/000000?text='.$movie['title']
          ]);
        });

        $images = collect($images['profiles'])->map(function ($profile){
          return collect($profile)->merge([
            'file_path' => $profile['file_path']? 'https://image.tmdb.org/t/p/original/'.$profile['file_path'] : 'https://via.placeholder.com/500x750/F1C40F/000000?text='.$profile['name']
          ]);
        });

        dump($images);

        return view('actors.show',[
          'actor' => $actor,
          'social' => $social,
          'movieCredits' => $movieCredits,
          'tvShowCredits' => $tvShowCredits,
          'knownMovies' => $knownMovies,
          'images' => $images
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
