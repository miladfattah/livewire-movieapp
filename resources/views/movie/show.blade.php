<x-front-layout>
    @if(!empty($movie))
        <main class="my-2">
            <section class="bg-gradient-to-r from-indigo-700 to-transparent">
                <div class="max-w-6xl mx-auto m-4 p-2">
                    <div class="flex">
                        <div class="w-3/12">
                            <div class="w-full">
                                <img class="w-full h-full rounded"
                                src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $movie->poster_path}}">
                            </div>
                        </div>
                        <div class="w-8/12">
                            <div class="m-4 p-5">
                                <h1 class="flex text-white font-bold text-4xl">{{$movie->title}}</h1>
                                <div class="flex- p-3 text-white ">
                                    <span>{{$movie->release_date}}</span>
                                    <span class="ml-2 space-x-1">
                                        @foreach ($movie->genres as $genre)
                                            <a class="font-bold hover:text-blue-500"
                                                href="{{ route('genre.show', $genre->slug) }}">
                                                {{ $genre->title }},
                                            </a>
                                        @endforeach
                                    </span>
                                    <span class="flex ">
                                        <span class="mr-2"> {{date('H:i' , mktime(0 , $movie->runtime))}}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>
                              
                            </div>
                            <div class="p-8 text-white">
                                <p>{{ $movie->overview }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-6xl mx-auto bg-gray-200 dark:bg-gray-900 p-2 rounded">
                <div class="flex justify-between">
                    <div class="w-7/12">
                        <h1 class="flex text-white font-bold text-xl">Movie Casts</h1>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                            @foreach ($movie->casts as $cast)
                                <x-movie-card>
                                    <x-slot:image>
                                        <a href="{{ route('cast.show', $cast->slug) }}">
                                            <img class=""
                                                src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $cast->poster_path }}">
                                        </a>
                                    </x-slot:image>
                                    <a href="{{ route('cast.show', $cast->slug) }}">
                                        <span class="text-white">{{ $cast->name }}</span>
                                    </a>
                                </x-movie-card>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-4/12">
                        <h1 class="flex text-white font-bold text-xl">Latest movies</h1>
                        <div class="grid grid-cols-3 gap-2">
                            @if(!empty($latest))
                                @foreach($latest as $lmovie)
                                 <a href="{{route('movie.show' , $lmovie->slug)}}">
                                 <img class="w-full h-full rounded-lg"
                                            src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $lmovie->poster_path }}">
                                 </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </main>
    @endif
</x-front-layout>