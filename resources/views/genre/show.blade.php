<x-front-layout>
    <main class="max-w-6xl mx-auto min-h-screen">
        <section class="bg-gray-200 dark:bg-gray-900 dark:text-white mt-4 p-2 rounded ">
            <div class=" m-2 p-2  text-2xl font-bold text-indigo-600 dark:text-indigo-300">
                <h1>{{$genre->title}}</h1>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded">
              
                @foreach ($movies as $movie)
                    <x-movie-card>
                        <x-slot:image>
                            <a href="{{route('movie.show' , $movie->slug)}}">
                                <div class="aspect-w-2 aspect-h-3 h-4xl ">
                                    <img
                                    class="object-cover"
                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $movie->poster_path }}" alt="">
                                </div>
                                <div
                                    class="absolute x-10 left-2 top-2 h-6 w-12 bg-gray-800 group-hover:bg-gray-700 text-blue-400 text-center rounded">
                                    New
                                </div>
                                <div class="absolute inset-0 z-10  bg-gradient-to-t from-black to-transparent"></div>
                                <div class="absolute inset-y-0 left-5 z-10 invisible group-hover:visible flex items-center ">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-12 w-12 text-blue-700 bg-pink-700 rounded-full z-20" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div 
                                     class="absolute transition z-10 opacity-0 duration-500 ease-in-out transform group-hover:opacity-100 group-hover:translate-x-16 group-hover:pr-2 text-white font-bold">
                                        Play
                                    </div>
                                </div>
                                <div class="absolute z-10  bottom-2 left-2 text-indigo-200 text-sm font-bold group-hover:text-blue-700">
                                    @foreach ($movie->genres as $genre)
                                        {{$genre->title}} /
                                    @endforeach
                                </div>
                            </a>
                        </x-slot:image>
                        <a href="{{route('movie.show' , $movie->slug)}}">
                            <div class="dark:text-white font-bold group-hover:text-blue-400">
                                {{ $movie->title }}
                            </div>
                        </a>
                    </x-movie-card>
                @endforeach
            </div>
            <div class="px-3 ">
                {{$movies->links()}}
            </div>
        </section>
    </main>
</x-front-layout>