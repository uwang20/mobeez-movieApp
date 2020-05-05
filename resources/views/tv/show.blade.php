@extends('layouts.main')

@section('content')
    <div class="tvShow-info shadow-2xl" style="background-color:{{ $color[0] }}">
        <div class="container mx-auto px-4 py-8 sm:py-16 flex flex-col md:flex-row z-10" style="background:linear-gradient(to right, {{ $color[1] }}, {{ $color[2] }}, {{ $color[3] }}, {{ $color[4] }}, {{ $color[1] }}), url({{$tvShow['backdrop_path']}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
            <img src="{{$tvShow['poster_path']}}" alt="sample" class="mx-auto rounded-md block sm:hidden md:block mx-auto sm:mr-8 w-72 sm:w-64 md:rem-18 lg:w-96">
            {{-- small --}}
            <div class="flex sm:flex-row justify-start block md:hidden">
              <img src="{{$tvShow['poster_path']}}" alt="sample" class="rounded-md mx-auto sm:mr-8 w-72 sm:w-64 hidden sm:block">
              <div class="hidden sm:block">
                <h2 class="text-3xl font-semibold">{{$tvShow['name']}}</h2>
                <div class="text-gray-400 md:text-sm lg:text-base">
                    <div class="flex items-center mt-2">
                      <span>
                          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 318.951 294.001"><path fill="#FFF700" d="M160.637,197l-115,97,55.194-141.1L0,89.013,126.684,86.8,160.637,0,194.13,85.624l124.821-2.179-99.158,67.786L275.638,294h0Z" data-name="Union 1"/></svg>
                      </span>
                      <span class="ml-1">{{$tvShow['vote_average']}}</span>
                    </div>
                    <div class="flex items-center mt-2">
                      <span class="mr-1 font-semibold">Release date:</span>
                      <span>{{$tvShow['first_air_date']}}</span>
                    </div>
                    <div class="flex mt-2">
                      <span class="mr-1 font-semibold">Genres:</span>
                      <span>{{$tvShow['genres']}}</span>
                    </div>
                    <div class="mt-3">
                        <h2 class="text-xl font-semibold text-white">Featured Crew</h2>
                        <div class="text-sm mt-1 flex flex-wrap">
                            @foreach ($tvShow['crew'] as $crew)
                                    <div class="mr-16 mb-4 md:mb-3 lg:mb-0">
                                        <h2 class="font-semibold text-white">{{$crew['name']}}</h2>
                                        <p class="text-gray-400">{{$crew['job']}}</p>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
              </div>
            </div>
            {{-- small end --}}
            <div class="mt-2 md:mt-8 ml-14 md:ml-8 lg:ml-20">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-semibold block sm:hidden md:block">{{$tvShow['name']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm lg:text-base block sm:hidden md:block">
                    <span class="inline-block">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 318.951 294.001"><path fill="#FFF700" d="M160.637,197l-115,97,55.194-141.1L0,89.013,126.684,86.8,160.637,0,194.13,85.624l124.821-2.179-99.158,67.786L275.638,294h0Z" data-name="Union 1"/></svg>
                    </span>
                    <span class="ml-1">{{$tvShow['vote_average']}}</span>
                    <span class="mx-2">|</span>
                    <span>{{$tvShow['first_air_date']}}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{$tvShow['genres']}}
                    </span>
                </div>
                <div class="mt-4 sm:mt-5 md:mt-4 lg:mt-8">
                    <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold">Overview</h2>
                    <p class="text-sm lg:text-base text-gray-400 md:mt-1 lg:mt-4">
                        {{$tvShow['overview']}}
                    </p>
                </div>
                <div class="mt-4 md:mt-4 lg:mt-8 block sm:hidden md:block">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-semibold">Featured Crew</h2>
                    <div class="text-sm lg:text-base md:mt-1 lg:mt-4 flex flex-wrap">
                        @foreach ($tvShow['crew'] as $crew)
                                <div class="mr-16 mb-4 md:mb-0">
                                    <h2 class="font-semibold">{{$crew['name']}}</h2>
                                    <p class="text-gray-400">{{$crew['job']}}</p>
                                </div>
                        @endforeach
                    </div>
                </div>
                <div class="sm:mt-4 md:mt-6 lg:mt-12" x-data="{showTrailer: false}">
                    <a @click="showTrailer=true" class="cursor-pointer flex inline-flex items-center bg-yellow-400 text-white rounded px-4 py-3 md:px-5 md:py-4 hover:bg-yellow-500 transition ease-in-out duration-150">
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
                              @if($tvShow['trailer'])
                                 <iframe allow="autoplay; encrypted-media"
                                         allowfullscreen
                                         class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                         src="https://www.youtube.com/embed/{{$tvShow['trailer']}}"
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

    <div class="seasons custom-gray-3-border-bottom">
        <div class="container mx-auto px-4 py-8 md:py-16">
            <h2 class="text-2xl md:text-4xl font-semibold">Seasons</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 gap-3 sm:gap-5">
                @foreach ($tvShowSeasons as $season)
                        <div class="flex sm:flex-col mt-4 sm:mt-8 text-gray-400">
                            <img src="{{$season['poster_path']}}" alt="" class="w-16 sm:w-full md:w-full lg:w-full">
                            <div class="ml-4 sm:ml-0 sm:text-center font-semibold">
                              <div>{{$season['name']}}</div>
                              <div class="font-normal text-sm">
                                ({{$season['episodes']}})
                              </div>
                              <div class="text-center font-normal text-sm">{{$season['air_date']}}</div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>



    <div class="tvShow-cast custom-gray-3-border-bottom">
        <div class="container mx-auto px-4 py-8 md:py-16">
            <h2 class="text-2xl md:text-4xl font-semibold">Cast<span class="text-base ml-2 font-blue-1"><a href="#">see full cast & crew</a></span></h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach ($tvShow['cast'] as $cast)
                        <div class="mt-8">
                            @if ($cast['profile_path'] == null)
                              @if($cast['gender'] == 1)
                                <img src="https://via.placeholder.com/500x750/FFBFD2/000000?text={{$cast['name']}}" alt="{{$cast['name']}}" class="rounded-md">
                              @elseif($cast['gender'] == 2)
                                <img src="https://via.placeholder.com/500x750/6CC5F6/000000?text={{$cast['name']}}" alt="{{$cast['name']}}" class="rounded-md">
                              @else
                                <img src="https://via.placeholder.com/500x750/F1C40F/000000?text={{$cast['name']}}" alt="{{$cast['name']}}" class="rounded-md">
                              @endif
                            @else
                                <a href="{{route('actors.show',$cast['id'])}}">
                                    <img src="{{"https://image.tmdb.org/t/p/w500".$cast['profile_path']}}" alt="sample" class="">
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
        <div class="container mx-auto px-4 py-8 md:py-16">
            <h2 class="text-2xl md:text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8">
           @foreach ($tvShow['poster-images'] as $image)
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
