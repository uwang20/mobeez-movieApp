<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/main.css">
    <livewire:styles>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <title>Movie App</title>
  </head>
  <body class="font-sans custom-gray-2 text-white">
      <nav class="custom-black-1">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-4">
          <ul class="flex flex-col md:flex-row items-center">
            <li class="mb-2 md:mb-0">
              <a class="flex items-center" href="{{route('movies.index')}}">
                <svg class="h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 692.397 248.388"><defs><filter id="bovuta" width="442" height="187" x="250.397" y="61.388" filterUnits="userSpaceOnUse"><feOffset dy="3"/><feGaussianBlur result="blur" stdDeviation="3"/><feFlood/><feComposite in2="blur" operator="in"/><feComposite in="SourceGraphic"/></filter></defs><g data-name="MOBEEZ" transform="translate(-50.603 -1.612)"><path fill="#fff700" d="M193,176.841H8a8.009,8.009,0,0,1-8-8v-119a8.009,8.009,0,0,1,8-8H54.391L32.332,72.866h33.5L87.89,41.841H98.43L76.37,72.866h33.5l22.06-31.025h9.411l-22.06,31.025h33.5l22.06-31.025H193a8.009,8.009,0,0,1,8,8v119A8.009,8.009,0,0,1,193,176.841Z" data-name="Subtraction 5" transform="matrix(0.966, -0.259, 0.259, 0.966, 147.133, 36.955)"/><g filter="url(#bovuta)" transform="matrix(1, 0, 0, 1, 50.6, 1.61)"><text fill="#fff" data-name="MOBEEZ" font-family="Impact" font-size="139" transform="translate(259.4 207.39)"><tspan x="0" y="0">MOBEEZ</tspan></text></g><path fill="#fff" d="M134.456,241c-16.75-4-95,40-98,47s42.5,27.75,67,16S151.206,245,134.456,241Z" data-name="Path 5" transform="matrix(0.966, -0.259, 0.259, 0.966, 265.211, -194.657)"/><path fill="#fff" d="M42,241c16.75-4,95,40,98,47s-42.5,27.75-67,16S25.25,245,42,241Z" data-name="Path 6" transform="matrix(0.966, -0.259, 0.259, 0.966, -46.783, -111.058)"/></g></svg>
              </a>
            </li>
            <li class="mb-2 md:ml-16">
              <a href="{{route('movies.index')}}" class="hover:text-blue-300">Movie</a>
            </li>
            <li class="mb-2 md:ml-6">
              <a href="#" class="hover:text-blue-300">TV shows</a>
            </li>
            <li class="mb-2 md:ml-6">
              <a href="{{route('actors.index')}}" class="hover:text-blue-300">Actors</a>
            </li>
          </ul>
          <div class="flex items-center">
            <livewire:search-drop-down>
            <div class="ml-5">
              <a href="#">
                <img src="/img/avatar.png" alt="avatar" class="rounded-full w-8 h-8">
              </a>
            </div>
          </div>
        </div>
      </nav>

      @yield('content')
      <livewire:scripts>
  </body>
</html>
