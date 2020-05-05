@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-actors mb-24">
            <h2 class="uppercase tracking-wider text-yellow-400 text-lg font-semibold mb-4">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 border-rounded-10-corner-ltb py-2 bg-white px-2">
              @foreach($popularActors as $actor)
                <div class="actor mt-8 custom-gray-2 all-box-shadow">
                    <a href="{{route('actors.show', $actor['id'])}}">
                        <img src="{{$actor['profile_path']}}" alt="sample" class="hover:opacity-75 w-full">
                    </a>
                    <div class="p-3 md:p-1">
                      <a href="{{route('actors.show', $actor['id'])}}" class="mt-2">{{$actor['name']}}</a>
                      <div class="text-sm truncate text-gray-400">
                          {{$actor['known_for']}}
                      </div>
                    </div>
                </div>
              @endforeach
            </div>
            <div class="page-load-status">
              <div class="flex justify-center">
                <div  class="infinite-scroll-request spinner my-8 text-4xl text-white">&nbsp;</div>
                <p class="infinite-scroll-last text-md text-gray-600 my-8">End of content</p>
              </div>
              <p class="infinite-scroll-error">No more conten</p>
            </div>
            {{-- <div class="mt-16 flex items-center justify-between">
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
            </div> --}}
        </div>
@endsection

@section('script')
  <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
  <script type="text/javascript">
        $('.grid').infiniteScroll({
            // options
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status'
            // history: false,
      });
    // var elem = document.querySelector('.grid');
    // var infScroll = new InfiniteScroll( elem, {
    //   // options
    //   path: '/actors/page/@{{#}}',
    //   append: '.actor',
    //   // history: false,
    // });
  </script>
@endsection
