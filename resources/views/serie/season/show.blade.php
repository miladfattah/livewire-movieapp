<x-front-layout>
    @if(!empty($season))
        <main class="my-2">
            <section class="bg-gradient-to-r from-indigo-700 to-transparent">
                <div class="max-w-6xl mx-auto m-4 p-2">
                    <div class="flex">
                        <div class="w-3/12">
                            <div class="w-full">
                                <img class="w-full h-full rounded"
                                src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $season->poster_path}}">
                            </div>
                        </div>
                        <div class="w-8/12">
                            <div class="m-4 p-5">
                                <h1 class="flex text-white font-bold text-4xl">{{$serie->name}}</h1>
                                    Season : <strong>{{$season->name}}</strong>
                                </div>
                              
                            </div>
                            <div class="p-8 text-white">
                                <p>{{ $serie->overview }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-6xl mx-auto bg-gray-200 dark:bg-gray-900 p-2 rounded">
                <div class="flex justify-between">
                    <div class="w-7/12">
                        <h1 class="flex text-white font-bold text-xl">Episodes</h1>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                            @foreach ($season->episodes as $episode)
                                <x-movie-card>
                                    <a href="{{route('episode.show' , $episode->slug )}}">
                                        <x-slot:image>
                                                <img class=""
                                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $episode->season->poster_path }}">
                                        </x-slot:image>
                                        <span class="text-white">{{ $episode->name }}</span>
                                    </a>
                                </x-movie-card>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-4/12">
                        <h1 class="flex text-white font-bold text-xl">Latest series</h1>
                        <div class="grid grid-cols-3 gap-2">
                            @if(!empty($latest))
                                @foreach($latest as $lseason)
                                 <a href="{{route('season.show' , [$serie->slug , $lseason->slug])}}">
                                    <img class=""
                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $season->poster_path }}">
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