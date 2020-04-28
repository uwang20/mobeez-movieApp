@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-actors mb-24">
            <h2 class="uppercase tracking-wider text-yellow-400 text-lg font-semibold mb-4">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 border-rounded-10-corner-ltb py-2">
              @foreach($popularActors as $actor)
                <div class="mt-8">
                    <a href="#">
                        <img src="{{$actor['profile_path']}}" alt="sample">
                    </a>
                    <div class="mt-2">{{$actor['name']}}</div>
                    <div class="text-sm truncate text-gray-400">
                        {{$actor['known_for']}}
                    </div>
                </div>
              @endforeach
            </div>
            <div class="mt-16 flex items-center justify-between">
              @if($previous)
                <a href="/actors/page/{{$previous}}">Previous</a>
              @else
                <div></div>
              @endif
              @if($next)
                <a href="/actors/page/{{$next}}">Next</a>
              @else
                <div></div>
              @endif
            </div>
        </div>
@endsection
