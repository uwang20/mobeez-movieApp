@extends('layouts.main')

@section('content')
    <div class="movie-info shadow-2xl">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row z-10 bg-cover bg-center bg-no-repeat" style="background:linear-gradient(to right, rgb(51, 51, 51), rgba(51, 51, 51,0.9), rgba(51, 51, 51,0.7), rgba(51, 51, 51,0.5), rgb(51, 51, 51)), url({{$movie['backdrop_path']}});">
            <img src="{{$movie['poster_path']}}" alt="sample" class="width-poster">
            <div class="mt-8 md:ml-24">
                <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400">
                    <span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 318.951 294.001"><path fill="#FFF700" d="M160.637,197l-115,97,55.194-141.1L0,89.013,126.684,86.8,160.637,0,194.13,85.624l124.821-2.179-99.158,67.786L275.638,294h0Z" data-name="Union 1"/></svg>
                    </span>
                    <span class="ml-1">{{$movie['vote_average']}}</span>
                    <span class="mx-2">|</span>
                    <span class="ml-1">{{$movie['runtime']}}</span>
                    <span class="mx-2">|</span>
                    <span>{{$movie['release_date']}}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{$movie['genres']}}
                    </span>
                </div>
                <div class="mt-8">
                    <h2 class="text-2xl font-semibold">Overview</h2>
                    <p class="text-gray-400 mt-2">
                        {{$movie['overview']}}
                    </p>
                </div>
                <div class="mt-8">
                    <h2 class="text-2xl font-semibold">Featured Crew</h2>
                    <div class="mt-4 flex flex-wrap">
                        @foreach ($movie['crew'] as $crew)
                                <div class="mr-16 mb-4 md:mb-0">
                                    <h2 class="font-semibold">{{$crew['name']}}</h2>
                                    <p class="text-gray-400">{{$crew['job']}}</p>
                                </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-12" x-data="{showTrailer: false}">
                    <a @click="showTrailer=true" class="cursor-pointer flex inline-flex items-center bg-yellow-400 text-white rounded px-5 py-4 hover:bg-yellow-500 transition ease-in-out duration-150">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 346"><g transform="translate(-911 -390)"><path fill="#000000" d="M160.006,22.533a15,15,0,0,1,25.988,0L333.029,277.507A15,15,0,0,1,320.035,300H25.965a15,15,0,0,1-12.994-22.493Z" data-name="Polygon 3" transform="translate(1211 390) rotate(90)"/><path fill="#000000" d="M130,193,51,161l56.121-77.227L125.5,94.37,109,131l91,54L121.322,298.037,77.681,323.2Z" data-name="Intersection 3" transform="translate(911 368)"/><path fill="#000000" d="M11,320.035V25.965A15.017,15.017,0,0,1,25.533,10.951,19.508,19.508,0,0,1,39,29.5v287a19.507,19.507,0,0,1-13.467,18.548A15.014,15.014,0,0,1,11,320.035Z" data-name="Intersection 2" opacity=".3" transform="translate(900 390)"/></g></svg>
                        <span class="ml-2 text-black font-semibold">Play Trailer</span>
                    </a>
                    <!-- MODAL -->
                    <div x-show.transition.opacity="showTrailer" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" style="background-color: rgba(0,0,0,0.5)">
                      <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="custom-gray-3 rounded">
                          <div class="flex justify-end pr-4 pt-2">
                            <button class="text-3xl leading-none hover:text-gray-300" @click="showTrailer=false">&times</button>
                          </div>
                          <div class="modal-body px-8 py-8">
                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%;">
                              @if($movie['videos']['results'])
                                 <iframe allow="autoplay; encrypted-media"
                                         allowfullscreen
                                         class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                         src="https://www.youtube.com/embed/{{ $movie['trailer'] }}"
                                         width="560"
                                         height="315">
                                 </iframe>
                              @else
                                <div class="absolute top-0 left-0 w-full h-full">
                                  NO TRAILER SO FAR
                                </div>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="movie-cast custom-gray-3-border-bottom">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast <span class="text-base ml-2 font-blue-1"><a href="#">see full cast & crew</a></span> </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($movie['cast'] as $cast)
                        <div class="mt-8">
                            @if ($cast['profile_path'] == null)
                                <img src="https://via.placeholder.com/500x750" alt="">
                            @else
                                <a href="#">
                                    <img src="{{"https://image.tmdb.org/t/p/w500".$cast['profile_path']}}" alt="sample">
                                </a>
                            @endif
                            <div class="mt-2">
                                <h3 class="text-lg font-semibold">{{$cast['name']}}</h3>
                                <p class="text-sm text-gray-400">{{$cast['character']}}</p>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="movie-images border-b border-blue-400" x-data="{showImage:false, image:''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($movie['poster-images'] as $image)
                        <div class="mt-8">
                            <a  href="#"
                                @click.prevent="showImage=true
                                                image='{{"https://image.tmdb.org/t/p/original".$image['file_path']}}'"
                            >
                                <img src="{{"https://image.tmdb.org/t/p/original".$image['file_path']}}" alt="sample">
                            </a>
                        </div>
                @endforeach
            </div>
        </div>
        <!-- MODAL IMAGE -->
        <div x-show.transition.opacity="showImage" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" style="background-color: rgba(0,0,0,0.5)">
          <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
            <div class="custom-gray-3  rounded">
              <div class="flex justify-end pr-4 pt-2">
                <button class="text-3xl leading-none hover:text-gray-300" @click="showImage=false" @keydown.escape.window="showImage=false">&times</button>
              </div>
              <div class="modal-body px-8 py-8">
                  <img :src="image" alt="sample">
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
