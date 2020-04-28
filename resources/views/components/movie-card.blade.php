<div>
    <a href="{{ route('movies.show', $movie['id'])}}" class="rounded-md">
        <img src="{{$movie['poster_path']}}" alt="sample" class="rounded-md hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{ route('movies.show', $movie['id'])}} " class="text-lg mt-2 hover:text-yellow-400">{{$movie['title']}}</a>
        <div class="flex items-center text-gray-400">
            <span>
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 318.951 294.001"><path fill="#FFF700" d="M160.637,197l-115,97,55.194-141.1L0,89.013,126.684,86.8,160.637,0,194.13,85.624l124.821-2.179-99.158,67.786L275.638,294h0Z" data-name="Union 1"/></svg>
            </span>
            <span class="ml-1">{{$movie['vote_average']}}</span>
            <span class="mx-2">|</span>
            <span>{{$movie['release_date']}}</span>
        </div>
        <div class="text-gray-400 text-sm">
            {{$movie['genres']}}
        </div>
    </div>
</div>

 {{-- <div class="swiper-slide" style="background-image:url(./images/nature-1.jpg0)"></div> --}}
