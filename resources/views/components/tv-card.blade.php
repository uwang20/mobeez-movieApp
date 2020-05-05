<div class="flex inline-flex sm:flex-col md:flex-col lg:flex-col custom-gray-2 rounded-md all-box-shadow">
    <a href="{{route('tvShows.show',$tvShow['id'])}}">
        <img src="{{$tvShow['poster_path']}}" alt="sample" class="hover:opacity-75 transition ease-in-out duration-150 w-24 sm:w-full md:w-full lg:w-full">
    </a>
    <div class="p-3 sm:p-3 md:p-3 lg:p-3">
        <a href="{{route('tvShows.show',$tvShow['id'])}}" class="text-lg mt-2 hover:text-yellow-400">{{$tvShow['name']}}</a>
        <div class="flex items-center text-gray-400">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                width="18" height="18"
                viewBox="0 0 172 172"
                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#f1c40f"><path d="M167.52945,67.05829c-0.7494,-2.3774 -2.84255,-4.13462 -5.32332,-4.4964l-48.55588,-7.05469l-21.73258,-44.00781c-2.22235,-4.49639 -9.61298,-4.49639 -11.86117,0l-21.70673,44.00781l-48.55589,7.05469c-2.48077,0.36178 -4.57392,2.09315 -5.34916,4.4964c-0.77524,2.40324 -0.12921,5.03906 1.67969,6.77043l35.14423,34.26563l-8.29507,48.34916c-0.41346,2.48077 0.59435,5.01322 2.63582,6.48617c2.04146,1.47296 4.72896,1.67969 6.95132,0.49099l43.4393,-22.81791l43.41346,22.81791c0.98197,0.51683 2.04147,0.7494 3.10096,0.7494c1.36959,0 2.71334,-0.41346 3.87621,-1.24038c2.04146,-1.49879 3.04928,-4.0054 2.63581,-6.48617l-8.29507,-48.34916l35.14423,-34.26563c1.80889,-1.75721 2.42908,-4.36719 1.65385,-6.77043z"></path></g></g></svg>
            </span>
            <span class="text-xs sm:text-sm md:text-sm lg:text-sm ml-1">{{$tvShow['vote_average']}}</span>
            <span class="mx-2">|</span>
            <span class="text-xs sm:text-sm md:text-sm lg:text-sm">{{$tvShow['first_air_date']}}</span>
        </div>
        <div class="text-gray-400 text-xs sm:text-sm md:text-sm lg:text-sm">
            {{$tvShow['genres']}}
        </div>
    </div>
</div>
