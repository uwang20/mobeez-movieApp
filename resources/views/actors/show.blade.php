@extends('layouts.main')

@section('content')
    <div class="movie-info shadow-2xl">
        <div class="container mx-auto px-4 py-16 flex flex-row md:flex-col lg:flex-row">
          <div class="flex flex-col md:flex-row">
            <div class="flex-none">
              <img src="{{$actor['profile_path']}}" alt="sample" class="rounded-md mx-auto">
              <h2 class="mt-2 text-2xl font-semibold md:hidden lg:hidden xl:hidden text-center">{{$actor['name']}}</h2>
              <h2 class="text-2xl font-semibold my-4">Personal Info</h2>
              <div class="text-md text-gray-200 border-btm-black03 pb-4 mb-2">
                <p class="font-bold">Known for</p>
                <p>{{$actor['known_for_department']}}</p>
              </div>
              <div class="text-md text-gray-200 border-btm-black03 pb-4 mb-2">
                <p class="font-bold">Gender</p>
                <p>{{$actor['gender']}}</p>
              </div>
              <div class="text-md text-gray-200 border-btm-black03 pb-4 mb-2">
                <p class="font-bold">Birthday</p>
                <p>{{$actor['birthday']}}<span> ({{$actor['age']}} years old)</span></p>
              </div>
              <div class="text-md text-gray-200 border-btm-black03 pb-4 mb-2">
                <p class="font-bold">Place of Birth</p>
                <p>{{$actor['place_of_birth']}}</p>
              </div>
              <div class="text-md text-gray-200 border-btm-black03 pb-4 mb-2">
                <p class="font-bold">Known as</p>
                @foreach($actor['also_known_as'] as $otherName)
                  <p>{{$otherName}}</p>
                @endforeach
              </div>
              <div x-data="{showProfiles:false}" class="my-4">
                <a @click="showProfiles=true" href="#" class="font-bold">Profiles<span class="font-normal text-custom-gray-3 ml-2">images({{$images->count()}})</span></a>
                {{-- modal --}}
                <div x-show.transition.opacity="showProfiles" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" style="background-color: rgba(0,0,0,0.5)">
                  <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="custom-gray-3  rounded pb-4">
                      <div class="flex justify-between pr-4 py-4 items-start border-b border-black custom-gray-2">
                        <div class="ml-4 flex items-start">
                          <img src="{{$actor['profile_path']}}" class="w-20 rounded-md" alt="">
                          <div class="flex flex-col justify-between">
                            <p class="ml-4 text-4xl">{{$actor['name']}}</p>
                            <p class="pl-4 text-sm text-custom-gray-3">profiles ({{$images->count()}})</p>
                          </div>
                        </div>
                        <button class="text-3xl leading-none hover:text-gray-300" @click="showProfiles=false" @keydown.escape.window="showProfiles=false">&times</button>
                      </div>
                      <div class="modal-body px-8 py-4 scroll-400">
                        <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-5">
                          @foreach ($images as $image)
                            <div class="flex flex-col content-center">
                              <a href="#">
                                <img src="{{$image['file_path']}}" class="rounded-md hover:opacity-75" alt="movie">
                              </a>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- endmodal --}}
              </div>
            </div>
            <div class="mt-2 md:ml-20">
              <div class="flex lg:items-center flex-col lg:flex-row" x-data="{hoverIcon:''}">
                <h2 class="text-4xl font-semibold hidden md:block lg:block xl:block">{{$actor['name']}}</h2>
                <div class="flex items-center ml-0 mt-2 lg:mt-0 lg:ml-12">
                  {{-- facebook --}}
                  @if($social['facebook_id'])
                    <span @mouseover="hoverIcon='facebook'" @mouseleave="hoverIcon=''" class=""
                                                                                          :class="{'transform scale-125 transition ease-in duration-200':hoverIcon==='facebook'}"
                     title="Visit Facebook"><a href="https://www.facebook.com/{{$social['facebook_id']}}">
                      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                      width="30" height="30"
                      viewBox="0 0 172 172"
                      style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#FFE680"><path d="M30.96,13.76c-9.45834,0 -17.2,7.74166 -17.2,17.2v110.08c0,9.45834 7.74166,17.2 17.2,17.2h57.90219c0.37149,0.0614 0.75054,0.0614 1.12203,0h19.51797c0.37149,0.0614 0.75054,0.0614 1.12203,0h30.41578c9.45834,0 17.2,-7.74166 17.2,-17.2v-110.08c0,-9.45834 -7.74166,-17.2 -17.2,-17.2zM30.96,20.64h110.08c5.73958,0 10.32,4.58042 10.32,10.32v110.08c0,5.73958 -4.58042,10.32 -10.32,10.32h-27.52v-48.16h13.14187l4.81735,-24.08h-17.95922v-6.88c0,-1.91777 0.18249,-2.06768 0.8264,-2.48594c0.64392,-0.41826 2.63362,-0.95406 6.0536,-0.95406h10.32v-19.37015l-1.96187,-0.93391c0,0 -7.90182,-3.77594 -18.67813,-3.77594c-7.74,0 -14.09854,3.0838 -18.1675,8.17c-4.06896,5.0862 -5.9125,11.89667 -5.9125,19.35v6.88h-10.32v24.08h10.32v48.16h-55.04c-5.73958,0 -10.32,-4.58042 -10.32,-10.32v-110.08c0,-5.73958 4.58042,-10.32 10.32,-10.32zM110.08,51.6c7.15197,0 11.65252,1.57709 13.76,2.41203v7.90797h-3.44c-3.95883,0 -7.13127,0.32749 -9.80265,2.06265c-2.67138,1.73519 -3.95735,5.02888 -3.95735,8.25735v13.76h16.44078l-2.06265,10.32h-14.37813v55.04h-13.76v-55.04h-10.32v-10.32h10.32v-13.76c0,-6.30667 1.59646,-11.5362 4.4075,-15.05c2.81104,-3.5138 6.7725,-5.59 12.7925,-5.59z"></path></g></g></svg>
                    </a></span>
                  @endif
                  {{-- instagram  --}}
                  @if($social['instagram_id'])
                    <span @mouseover="hoverIcon='instagram'" @mouseleave="hoverIcon=''" class="@if($social['facebook_id']) ml-4 @else ml-0  @endif"
                                                                                          :class="{'transform scale-125 transition ease-in duration-200':hoverIcon==='instagram'}"
                     title="Visit Instagram"><a href="https://www.instagram.com/{{$social['instagram_id']}}">
                      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                      width="30" height="30"
                      viewBox="0 0 172 172"
                      style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#FFE680"><path d="M55.04,10.32c-24.65626,0 -44.72,20.06374 -44.72,44.72v61.92c0,24.65626 20.06374,44.72 44.72,44.72h61.92c24.65626,0 44.72,-20.06374 44.72,-44.72v-61.92c0,-24.65626 -20.06374,-44.72 -44.72,-44.72zM55.04,17.2h61.92c20.9375,0 37.84,16.9025 37.84,37.84v61.92c0,20.9375 -16.9025,37.84 -37.84,37.84h-61.92c-20.9375,0 -37.84,-16.9025 -37.84,-37.84v-61.92c0,-20.9375 16.9025,-37.84 37.84,-37.84zM127.28,37.84c-3.79972,0 -6.88,3.08028 -6.88,6.88c0,3.79972 3.08028,6.88 6.88,6.88c3.79972,0 6.88,-3.08028 6.88,-6.88c0,-3.79972 -3.08028,-6.88 -6.88,-6.88zM86,48.16c-20.85771,0 -37.84,16.98229 -37.84,37.84c0,20.85771 16.98229,37.84 37.84,37.84c20.85771,0 37.84,-16.98229 37.84,-37.84c0,-20.85771 -16.98229,-37.84 -37.84,-37.84zM86,55.04c17.13948,0 30.96,13.82052 30.96,30.96c0,17.13948 -13.82052,30.96 -30.96,30.96c-17.13948,0 -30.96,-13.82052 -30.96,-30.96c0,-17.13948 13.82052,-30.96 30.96,-30.96z"></path></g></g></svg>
                    </a></span>
                  @endif
                  {{-- twitter --}}
                  @if($social['twitter_id'])
                    <span @mouseover="hoverIcon='twitter'" @mouseleave="hoverIcon=''" class="@if($social['facebook_id'] || $social['instagram_id']) ml-4 @else ml-0  @endif"
                                                                                          :class="{'transform scale-125 transition ease-in duration-200':hoverIcon==='twitter'}"
                     title="Visit Twitter"><a href="https://www.twitter.com/{{$social['twitter_id']}}">
                      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                      width="30" height="30"
                      viewBox="0 0 172 172"
                      style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#FFE680"><path d="M117.7125,18.8125c-20.57281,0 -37.3025,16.72969 -37.3025,37.3025c0,1.23625 0.30906,2.44563 0.43,3.655c-25.43719,-2.43219 -47.93156,-14.68719 -63.21,-33.4325c-0.71219,-0.90031 -1.81406,-1.38406 -2.96969,-1.30344c-1.14219,0.08062 -2.16344,0.73906 -2.72781,1.73344c-3.21156,5.52281 -5.0525,11.87875 -5.0525,18.705c0,8.26406 2.95625,15.82938 7.525,22.0375c-0.88687,-0.38969 -1.85437,-0.60469 -2.6875,-1.075c-1.06156,-0.56437 -2.33812,-0.5375 -3.37281,0.08063c-1.03469,0.61812 -1.66625,1.73344 -1.67969,2.92937v0.43c0,12.67156 6.5575,23.67688 16.2325,30.4225c-0.1075,-0.01344 -0.215,0.02688 -0.3225,0c-1.1825,-0.20156 -2.37844,0.215 -3.17125,1.11531c-0.79281,0.90031 -1.04812,2.15 -0.69875,3.29219c3.84313,11.94594 13.6525,21.07 25.8,24.4025c-9.675,5.75125 -20.89531,9.1375 -33.0025,9.1375c-2.62031,0 -5.13312,-0.13437 -7.6325,-0.43c-1.6125,-0.215 -3.15781,0.72563 -3.69531,2.2575c-0.55094,1.53188 0.05375,3.23844 1.43781,4.085c15.52031,9.95719 33.94313,15.8025 53.75,15.8025c32.10219,0 57.28406,-13.41062 74.175,-32.5725c16.89094,-19.16187 25.6925,-44.04812 25.6925,-67.295c0,-0.98094 -0.08062,-1.935 -0.1075,-2.9025c6.30219,-4.82406 11.9325,-10.48125 16.34,-17.0925c0.87344,-1.27656 0.77938,-2.98312 -0.22844,-4.16562c-0.99438,-1.1825 -2.67406,-1.54531 -4.07156,-0.88688c-1.77375,0.79281 -3.84312,0.87344 -5.6975,1.505c2.44563,-3.26531 4.54188,-6.78594 5.805,-10.75c0.43,-1.35719 -0.04031,-2.84875 -1.15562,-3.73562c-1.11531,-0.87344 -2.67406,-0.98094 -3.89688,-0.24188c-5.87219,3.48031 -12.37594,5.92594 -19.2425,7.4175c-6.665,-6.235 -15.43969,-10.4275 -25.2625,-10.4275zM117.7125,25.6925c8.77469,0 16.70281,3.74906 22.2525,9.675c0.83313,0.86 2.05594,1.22281 3.225,0.9675c4.48813,-0.88687 8.74781,-2.19031 12.9,-3.87c-2.39187,3.225 -5.34812,5.97969 -8.815,8.0625c-1.57219,0.76594 -2.31125,2.58 -1.73344,4.23281c0.56437,1.63937 2.28437,2.59344 3.99094,2.21719c3.44,-0.41656 6.50375,-1.81406 9.7825,-2.6875c-2.94281,3.18469 -6.16781,6.06031 -9.675,8.6c-0.95406,0.69875 -1.47812,1.8275 -1.3975,3.01c0.05375,1.3975 0.1075,2.78156 0.1075,4.1925c0,21.5 -8.25062,44.84094 -23.9725,62.6725c-15.72187,17.83156 -38.8075,30.315 -69.015,30.315c-13.71969,0 -26.67344,-3.03687 -38.3775,-8.385c14.5125,-1.11531 27.89625,-6.24844 38.7,-14.7275c1.12875,-0.90031 1.57219,-2.40531 1.11531,-3.77594c-0.45688,-1.37063 -1.72,-2.31125 -3.15781,-2.35156c-11.34125,-0.20156 -20.84156,-6.79937 -25.9075,-16.125c0.18813,0 0.34938,0 0.5375,0c3.39969,0 6.75906,-0.43 9.89,-1.29c1.505,-0.44344 2.53969,-1.84094 2.48594,-3.41312c-0.05375,-1.57219 -1.16906,-2.91594 -2.70094,-3.25188c-12.24156,-2.4725 -21.41937,-12.44312 -23.5425,-24.8325c3.46688,1.19594 7.01438,2.13656 10.8575,2.2575c1.57219,0.09406 2.99656,-0.88687 3.48031,-2.37844c0.48375,-1.49156 -0.1075,-3.13094 -1.43781,-3.96406c-8.17,-5.46906 -13.545,-14.78125 -13.545,-25.37c0,-3.92375 1.02125,-7.525 2.365,-10.965c17.2,18.87969 41.28,31.41688 68.4775,32.7875c1.075,0.05375 2.12313,-0.38969 2.82188,-1.20937c0.69875,-0.83313 0.9675,-1.935 0.72562,-2.98313c-0.52406,-2.23062 -0.86,-4.59562 -0.86,-6.9875c0,-16.85062 13.57188,-30.4225 30.4225,-30.4225z"></path></g></g></svg>
                    </a></span>
                  @endif
                </div>

              </div>
              <div class="mt-8">
                  <h2 class="text-2xl font-semibold">Biography</h2>
                  <p class="text-gray-400 mt-2">
                    {{$actor['biography']}}
                  </p>
              </div>
              <div class="mt-8 border-b border-transparent lg:border-gray-300 pb-8">
                  <h2 class="text-2xl font-semibold">Known For</h2>
                  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 mt-4 justify-between">
                    @foreach ($knownMovies as $movie)
                      <div class="flex flex-col content-center">
                        <a href="{{route('movies.show',$movie['id'])}}">
                          <img src="{{$movie['poster_path']}}" class="rounded-md hover:opacity-75" alt="movie" title="{{$movie['title']}}">
                        </a>
                        <a href="{{route('movies.show',$movie['id'])}}" class="mt-2 text-gray-400 leading-normal text-center">{{$movie['title']}}</a>
                      </div>
                    @endforeach
                  </div>
              </div>
              <div class="mt-4 block md:hidden lg:block" x-data="{showMovie:true, showTv:false, tab:'movie'}">
                <div class="flex flex-col items-center">
                  <h2 class="text-2xl font-semibold">Acting</h2>
                  <div class="flex items-center inline-flex my-2 border-custom-gray-2 custom-gray-3 rounded">
                      <p @click="showMovie=true, showTv=false, tab='movie'" class="cursor-pointer px-4 border-r-custom-gray-2"
                                                                            :class="{'bg-yellow-400 text-black':tab==='movie'}">Movies</p>
                    <p @click="showMovie=false, showTv=true, tab='tv'"  class="cursor-pointer px-4"
                                                                        :class="{'bg-yellow-400 text-black':tab==='tv'}">TV shows</p>
                  </div>
                </div>
                <div class="actings mt-2 py-4 px-4 all-box-shadow all-border rounded-md">
                  @foreach($movieCredits as $movie)
                    <div x-show="showMovie" class="flex items-center my-2">
                      <p>{{$movie['release_year']}}</p>
                      <div class="mx-4">|</div>
                      <p class="text-custom-gray-3">
                      <a href="{{route('movies.show',$movie['id'])}}" class="cursor-default font-bold text-white">{{$movie['title']}}</a>
                       as
                      <span class="text-custom-gray-2 font-semibold">{{$movie['character']}}</span>
                      </p>
                    </div>
                  @endforeach
                  @foreach($tvShowCredits as $tvShow)
                    <div x-show="showTv" class="flex items-center my-2">
                      <p>{{$tvShow['first_air_year']}}</p>
                      <div class="mx-4">|</div>
                      <p class="text-custom-gray-3">
                      <a href="#" class="cursor-default font-bold text-white">{{$tvShow['name']}}</a>
                       as
                      <span class="text-custom-gray-2 font-semibold">{{$tvShow['character']}}</span>
                      </p>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <div class="mt-4 pt-8 hidden md:block lg:hidden border-t border-white" x-data="{showMovie:true, showTv:false, tab:'movie'}">
            <div class="flex flex-col items-center">
              <h2 class="text-2xl font-semibold">Acting</h2>
              <div class="flex items-center inline-flex my-2 border-custom-gray-2 custom-gray-3 rounded">
                  <p @click="showMovie=true, showTv=false, tab='movie'" class="cursor-pointer px-4 border-r-custom-gray-2"
                                                                        :class="{'bg-yellow-400 text-black':tab==='movie'}">Movies</p>
                <p @click="showMovie=false, showTv=true, tab='tv'"  class="cursor-pointer px-4"
                                                                    :class="{'bg-yellow-400 text-black':tab==='tv'}">TV shows</p>
              </div>
            </div>
            <div class="actings mt-2 py-4 px-4 all-box-shadow all-border rounded-md">
              @foreach($movieCredits as $movie)
                <div x-show="showMovie" class="flex items-center my-2">
                  <p>{{$movie['release_year']}}</p>
                  <div class="mx-4">|</div>
                  <p class="text-custom-gray-3">
                  <a href="{{route('movies.show',$movie['id'])}}" class="cursor-default font-bold text-white">{{$movie['title']}}</a>
                   as
                  <span class="text-custom-gray-2 font-semibold">{{$movie['character']}}</span>
                  </p>
                </div>
              @endforeach
              @foreach($tvShowCredits as $tvShow)
                <div x-show="showTv" class="flex items-center my-2">
                  <p>{{$tvShow['first_air_year']}}</p>
                  <div class="mx-4">|</div>
                  <p class="text-custom-gray-3">
                  <a href="#" class="cursor-default font-bold text-white">{{$tvShow['name']}}</a>
                   as
                  <span class="text-custom-gray-2 font-semibold">{{$tvShow['character']}}</span>
                  </p>
                </div>
              @endforeach
            </div>
          </div>


        </div>
    </div>
@endsection

@section('alphineScript')
  <script type="text/javascript">


        function showShows() {
           return {
             moviesShow: true,
             tvsShow: false,
             color: #000000
             showMovie() {
               this.tvsShow = false;
               this.moviesShow = true;
             },
             showTv(){
               this.tvsShow = true;
               this.moviesShow = false;
             }
           };
      }
  </script>
@endsection
