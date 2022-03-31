<x-front-layout>
    <main class="max-w-6xl mx-auto min-h-screen">
        <section class="bg-gray-200 dark:bg-gray-900 dark:text-white mt-4 p-2 rounded ">
            <div class=" m-2 p-2  text-2xl font-bold text-indigo-600 dark:text-indigo-300">
                <h1>Movies</h1>
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
        </section>

        <section class="bg-gray-200 dark:bg-gray-900 dark:text-white mt-4 p-2 rounded ">
            <div class=" m-2 p-2  text-2xl font-bold text-indigo-600 dark:text-indigo-300">
                <h1>Episodes</h1>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded">
                   
                @foreach ($episodes as $episode)
                    <x-movie-card>
                        <x-slot:image>
                            <a href="{{route('episode.show' , $episode->slug)}}">
                                <div class="aspect-w-2 aspect-h-3 h-4xl ">
                                    <img
                                    class="object-cover"
                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $episode->season->poster_path }}" alt="">
                                </div>
                                <div
                                    class="absolute x-10 left-2 top-2 h-6 w-12 bg-gray-800 group-hover:bg-gray-700 text-blue-400 text-center rounded">
                                    New
                                </div>
                            </a>
                        </x-slot:image>
                        <a href="{{route('episode.show' , $episode->slug)}}">
                            <div class="dark:text-white font-bold group-hover:text-blue-400">
                                {{ $episode->name }}
                            </div>
                        </a>
                    </x-movie-card>
                @endforeach
            </div>
        </section>

        <section class="bg-gray-200 dark:bg-gray-900 dark:text-white mt-4 p-2 rounded ">
            <div class=" m-2 p-2  text-2xl font-bold text-indigo-600 dark:text-indigo-300">
                <h1>Series</h1>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 rounded">
                @foreach ($series as $serie)
                    <x-movie-card>
                        <x-slot:image>
                            <a href="{{route('serie.show' , $serie->slug)}}">
                                <div class="aspect-w-2 aspect-h-3 h-4xl ">
                                    <img
                                    class="object-cover"
                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $serie->pooster }}" alt="">
                                </div>
                                <div
                                    class="absolute x-10 left-2 top-2 h-6 w-12 bg-gray-800 group-hover:bg-gray-700 text-blue-400 text-center rounded">
                                    New
                                </div>
                            </a>
                        </x-slot:image>
                        <a href="{{route('serie.show' , $serie->slug)}}">
                            <div class="dark:text-white font-bold group-hover:text-blue-400">
                                {{ $serie->name }}
                            </div>
                        </a>
                    </x-movie-card>
                @endforeach
            </div>
        </section>
    </main>
</x-front-layout>