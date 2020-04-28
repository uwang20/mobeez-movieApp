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

        $popularActors = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
                        ->json()['results'];

        // dd($popularActors);

        $popularActors = collect($popularActors)->map(function ($actor){
          return collect($actor)->merge([
            'profile_path' => $actor['profile_path']
            ? 'https://image.tmdb.org/t/p/w235_and_h235_face'.$actor['profile_path']
            : 'https://ui-avatars.com/api/?size=235&name='.$actor['name'],
            'known_for' => collect($actor['known_for'])->where('media_type','tv')->pluck('name')
            ->union(collect($actor['known_for'])->where('media_type','movie')->pluck('title'))->implode(', '),
          ]);
        });

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
        //
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
