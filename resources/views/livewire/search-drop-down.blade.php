<div class="relative" x-data="{isOpen: true,hover:false}" @click.away="isOpen=false">
    <input  @keydown.escape.window="isOpen=false"
            @focus="isOpen=true"
            @keydown.shift.tab="isOpen=false"
            @keydown="isOpen=true"
            @click="isOpen=true"
            wire:model.debounce.300ms="search"
            type="text"
            class="text-black rounded-full bg-white border border-yellow-400 w-64 px-4 py-1 pl-8 focus:outline-none focus:shadow-outline placeholder-gray-800"
            placeholder="Search">
    <div class="absolute top-0">
        <svg @mouseover="hover=true" @mouseleave="hover=false"  class="fill-current w-3 text-black mt-2 ml-3"
                                                                :class="{'transform scale-125 transition duration-200 ease-linear' : hover===true}"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 194.793 257.621"><path d="M164.543,254.619l-38.5-66.683a6,6,0,0,1,1.309-7.573l-8.565-14.835a85.885,85.885,0,0,1-80.871-8.216A86.254,86.254,0,0,1,6.758,119.475a85.885,85.885,0,0,1,7.929-81.558A86.254,86.254,0,0,1,52.525,6.758a85.885,85.885,0,0,1,81.558,7.929,86.254,86.254,0,0,1,31.159,37.838,85.885,85.885,0,0,1-7.929,81.558,86.473,86.473,0,0,1-17.84,19.274l8.651,14.984a6,6,0,0,1,7.365,2.6l38.5,66.683a6,6,0,0,1-2.2,8.2l-19.053,11a6,6,0,0,1-8.2-2.2ZM37,86A49,49,0,1,0,86,37,49.055,49.055,0,0,0,37,86Z" data-name="Union 2"/></svg>
    </div>
        <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>
        @if (strlen($search) >= 2)
            @if (count($searchResults) > 0)
              @if(count($searchResults) <= 4)
                <div class="z-50 absolute bg-white text-black text-sm rounded w-64 mt-4 shadow-2xl" x-show="isOpen">
                    <ul>
                        @foreach ($searchResults as $result)
                            <li class="border-b border-gray-200 hover-gray hover:text-white">
                                <a @if($loop->last) @keydown.tab.exact="isOpen=false" @endif href="{{ route('movies.show', $result['id'])}} " class="flex items-center block px-3 py-3">
                                    @if($result['poster_path'])
                                        <img src="{{"https://image.tmdb.org/t/p/w92".$result['poster_path']}}" alt="poster" class="w-8">
                                    @else
                                        <img src="https://via.placeholder.com/50x75" alt="ph" class="w-8">
                                    @endif
                                    <span class="ml-4">{{$result['title']}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
              @else
                <div class="z-50 absolute bg-white text-black text-sm rounded w-64 mt-4 scroll-300 shadow-2xl" x-show="isOpen">
                    <ul>
                        @foreach ($searchResults as $result)
                            <li class="border-b border-gray-200 hover-gray hover:text-white">
                                <a href="{{ route('movies.show', $result['id'])}} " class="flex items-center block px-3 py-3">
                                    @if($result['poster_path'])
                                        <img src="{{"https://image.tmdb.org/t/p/w92".$result['poster_path']}}" alt="poster" class="w-8">
                                    @else
                                        <img src="https://via.placeholder.com/50x75" alt="ph" class="w-8">
                                    @endif
                                    <span class="ml-4">{{$result['title']}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
              @endif
            @else
                <div class="z-50 absolute bg-white text-black  text-sm rounded w-64 mt-4" x-show="isOpen">
                    <div class="px-3 py-3">no results for "{{$search}}"</div>
                </div>
            @endif
        @endif
</div>
