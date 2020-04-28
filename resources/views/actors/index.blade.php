@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-actors mb-24">
            <h2 class="uppercase tracking-wider text-yellow-400 text-lg font-semibold mb-4">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 scroll-600 border-rounded-10-corner-ltb px-4 py-4 custom-gray-3 shadow-2xl">
                <div class="mt-8">
                    <a href="#">
                        <img src="/img/sample.jpg" alt="sample">
                    </a>
                    <div class="mt-2">Name</div>
                    <div class="text-sm truncate text-gray-400">
                        <a href="#">movie 1</a>
                        <a href="#">movie 2</a>
                        <a href="#">movie 3</a>
                    </div>
                </div>
            </div>
        </div>
@endsection