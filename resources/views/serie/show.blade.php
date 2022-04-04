<x-front-layout>
    @if(!empty($serie))
        <main class="my-2">
            <section class="bg-gradient-to-r from-indigo-700 to-transparent">
                <div class="max-w-6xl mx-auto m-4 p-2">
                    <div class="flex">
                        <div class="w-3/12">
                            <div class="w-full">
                                <img class="w-full h-full rounded"
                                src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $serie->pooster}}">
                            </div>
                        </div>
                        <div class="w-8/12">
                            <div class="m-4 p-5">
                                <h1 class="flex text-white font-bold text-4xl">{{$serie->name}}</h1>
                                <div class="flex- p-3 text-white ">
                                    <span>{{$serie->created_year}}</span>
                      
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
                        <h1 class="flex text-white font-bold text-xl">Serie seasons</h1>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                            @foreach ($serie->seasons as $season)
                                <x-movie-card>
                                    <x-slot:image>
                                        <a href="">
                                            <img class=""
                                                src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $season->poster_path }}">
                                        </a>
                                    </x-slot:image>
                                    <a href=""">
                                        <span class="text-white">{{ $season->name }}</span>
                                    </a>
                                </x-movie-card>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-4/12">
                        <h1 class="flex text-white font-bold text-xl">Latest series</h1>
                        <div class="grid grid-cols-3 gap-2">
                            @if(!empty($latest))
                                @foreach($latest as $lserie)
                                 <a href="{{route('serie.show' , $lserie->slug)}}">
                                 <img class="w-full h-full rounded-lg"
                                            src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $lserie->pooster }}">
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