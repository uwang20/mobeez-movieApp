<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/main.css">
    <livewire:styles>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <title>Movie App</title>
  </head>
  <body class="font-sans custom-gray-2 text-white">
      <nav class="bg-white">
        <div class="container mx-auto flex justify-between md:flex-row items-center justify-between px-4 py-4">
          <ul class="flex justify-between md:flex-row items-center">
            <li class="mb-2 md:mb-0">
              <a class="flex items-center" href="{{route('movies.index')}}">
                <svg class="h-8 sm:h-10 md:h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 692.397 248.388"><defs><filter id="bovuta" width="442" height="187" x="250.397" y="61.388" filterUnits="userSpaceOnUse"><feOffset dy="3"/><feGaussianBlur result="blur" stdDeviation="3"/><feFlood/><feComposite in2="blur" operator="in"/><feComposite in="SourceGraphic"/></filter></defs><g data-name="MOBEEZ" transform="translate(-50.603 -1.612)"><path fill="#fff700" d="M193,176.841H8a8.009,8.009,0,0,1-8-8v-119a8.009,8.009,0,0,1,8-8H54.391L32.332,72.866h33.5L87.89,41.841H98.43L76.37,72.866h33.5l22.06-31.025h9.411l-22.06,31.025h33.5l22.06-31.025H193a8.009,8.009,0,0,1,8,8v119A8.009,8.009,0,0,1,193,176.841Z" data-name="Subtraction 5" transform="matrix(0.966, -0.259, 0.259, 0.966, 147.133, 36.955)"/><g filter="url(#bovuta)" transform="matrix(1, 0, 0, 1, 50.6, 1.61)"><text fill="#000000" data-name="MOBEEZ" font-family="Impact" font-size="139" transform="translate(259.4 207.39)"><tspan x="0" y="0">MOBEEZ</tspan></text></g><path fill="#000000" d="M134.456,241c-16.75-4-95,40-98,47s42.5,27.75,67,16S151.206,245,134.456,241Z" data-name="Path 5" transform="matrix(0.966, -0.259, 0.259, 0.966, 265.211, -194.657)"/><path fill="#000000" d="M42,241c16.75-4,95,40,98,47s-42.5,27.75-67,16S25.25,245,42,241Z" data-name="Path 6" transform="matrix(0.966, -0.259, 0.259, 0.966, -46.783, -111.058)"/></g></svg>
              </a>
            </li>
            <li class="text-black hidden md:block md:ml-8 lg:ml-16">
              <a href="{{route('movies.index')}}" class="font-semibold hover:text-yellow-500">Movie</a>
            </li>
            <li class="text-black hidden md:block md:ml-6">
              <a href="{{route('tvShows.index')}}" class="font-semibold hover:text-yellow-500">TV shows</a>
            </li>
            <li class="text-black hidden md:block md:ml-6">
              <a href="{{route('actors.index')}}" class="font-semibold hover:text-yellow-500">Actors</a>
            </li>
          </ul>
          <div class="flex items-center">
            <livewire:search-drop-down>
            <div class="ml-5">
              <a href="#">
                <img src="/img/avatar.png" alt="avatar" class="rounded-full w-8 h-8 border shadow-md">
              </a>
            </div>
          </div>
          <div class="relative block md:hidden" x-data="{open:false, hover:''}">
            <svg @click="open=!open" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
            width="40" height="40"
            viewBox="0 0 172 172"
            style=" fill:#000000;"><g transform="translate(0.516,0.516) scale(0.994,0.994)"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="none" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g id="original-icon 1" fill="#f1c40f" stroke="#f1c40f" stroke-linejoin="round" opacity="true"><path d="M154.8,40.13333c2.06765,-0.02924 3.99087,1.05709 5.03322,2.843c1.04236,1.78592 1.04236,3.99474 0,5.78066c-1.04236,1.78592 -2.96558,2.87225 -5.03322,2.843h-137.6c-2.06765,0.02924 -3.99087,-1.05709 -5.03322,-2.843c-1.04236,-1.78592 -1.04236,-3.99474 0,-5.78066c1.04236,-1.78592 2.96558,-2.87225 5.03322,-2.843zM154.8,80.26667c2.06765,-0.02924 3.99087,1.05709 5.03322,2.843c1.04236,1.78592 1.04236,3.99474 0,5.78066c-1.04236,1.78592 -2.96558,2.87225 -5.03322,2.843h-137.6c-2.06765,0.02924 -3.99087,-1.05709 -5.03322,-2.843c-1.04236,-1.78592 -1.04236,-3.99474 0,-5.78066c1.04236,-1.78592 2.96558,-2.87225 5.03322,-2.843zM154.8,120.4c2.06765,-0.02924 3.99087,1.05709 5.03322,2.843c1.04236,1.78592 1.04236,3.99474 0,5.78066c-1.04236,1.78592 -2.96558,2.87225 -5.03322,2.843h-137.6c-2.06765,0.02924 -3.99087,-1.05709 -5.03322,-2.843c-1.04236,-1.78592 -1.04236,-3.99474 0,-5.78066c1.04236,-1.78592 2.96558,-2.87225 5.03322,-2.843z"></path></g><path d="M0,172v-172h172v172z" fill="none" stroke="none" stroke-linejoin="miter"></path><g id="original-icon" fill="#f1c40f" stroke="none" stroke-linejoin="miter"><path d="M17.2,40.13333c-2.06765,-0.02924 -3.99087,1.05709 -5.03322,2.843c-1.04236,1.78592 -1.04236,3.99474 0,5.78066c1.04236,1.78592 2.96558,2.87225 5.03322,2.843h137.6c2.06765,0.02924 3.99087,-1.05709 5.03322,-2.843c1.04236,-1.78592 1.04236,-3.99474 0,-5.78066c-1.04236,-1.78592 -2.96558,-2.87225 -5.03322,-2.843zM17.2,80.26667c-2.06765,-0.02924 -3.99087,1.05709 -5.03322,2.843c-1.04236,1.78592 -1.04236,3.99474 0,5.78066c1.04236,1.78592 2.96558,2.87225 5.03322,2.843h137.6c2.06765,0.02924 3.99087,-1.05709 5.03322,-2.843c1.04236,-1.78592 1.04236,-3.99474 0,-5.78066c-1.04236,-1.78592 -2.96558,-2.87225 -5.03322,-2.843zM17.2,120.4c-2.06765,-0.02924 -3.99087,1.05709 -5.03322,2.843c-1.04236,1.78592 -1.04236,3.99474 0,5.78066c1.04236,1.78592 2.96558,2.87225 5.03322,2.843h137.6c2.06765,0.02924 3.99087,-1.05709 5.03322,-2.843c1.04236,-1.78592 1.04236,-3.99474 0,-5.78066c-1.04236,-1.78592 -2.96558,-2.87225 -5.03322,-2.843z"></path></g><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-linejoin="miter"></path></g></g></svg>
            <ul @mouseleave="hover=''" @click.away="open=false"  x-show="open"
                                          x-transition:enter="transition-all ease-out duration-100"
                                          x-transition:enter-start="opacity-0 scale-75"
                                          x-transition:enter-end="opacity-100 scale-100"
                                          x-transition:leave="transition-all ease-in duration-100"
                                          x-transition:leave-start="opacity-100 scale-100"
                                          x-transition:leave-end="opacity-0 scale-75"

             class="absolute right-0 overflow-hidden z-20 w-40 bg-white text-black border shadow rounded-md mt-2 transform origin-top-right">
              <li class="p-3" @mouseover="hover='movie'" :class="{'origin-left transform translate-x-2 transition-all duration-300 ease-out text-yellow-400':hover==='movie'}">
                <a href="{{route('movies.index')}}">Movie</a>
              </li>
              <li class="p-3"  @mouseover="hover='tv'" :class="{'origin-left transform translate-x-2 transition-all duration-300 ease-out text-yellow-400':hover==='tv'}">
                <a href="{{route('tvShows.index')}}">TV shows</a>
              </li>
              <li class="p-3"  @mouseover="hover='actor'" :class="{'origin-left transform translate-x-2 transition-all duration-300 ease-out text-yellow-400':hover==='actor'}">
                <a href="{{route('actors.index')}}">Actors</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      @yield('content')
      <livewire:scripts>
      @yield('script')
      @yield('alphineScript')
  </body>
</html>
