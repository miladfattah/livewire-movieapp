<div class="w-full mx-auto">

	<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
		<div class="p-4 flex justify-between items-center">
            <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model="search" type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
                <div class="flex justify-between mt-4 items-center">
                    <button wire:click="resetFilters"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">Reset
                        Filter
                    </button>
                        
                    <div>
                        <div class="flex justify-between space-x-4">
                            <select wire:model="perPage"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                                <option value="5">5 Per Page</option>
                                <option value="10">10 Per Page</option>
                                <option value="15">15 Per Page</option>
                            </select>
                        </div>
                    </div>
                </div>
    
            </div>
            <form class="flex space-x-4 shadow bg-white rounded-md m-2 p-2">
                <div class="p-1 flex items-center">
                    <label for="tmdb_id_g" class="block text-sm font-medium text-gray-700 mr-4">Movie Number</label>
                    <div class="relative rounded-md shadow-sm">
                        <input wire:model="movieTmdb"  id="tmdb_id_g" name="tmdb_id_g"
                            class="px-3 py-2 border border-gray-300 rounded" placeholder="Movie Number" />
                    </div>
                </div>
                <div class="p-1">
                    <button type="button" wire:click="generateMovie"
                        class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 transition duration-150 ease-in-out disabled:opacity-50">
                        <span>Generate</span>
                    </button>
                </div>
            </form>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortByColumn('title')">
                        <div class="flex items-center space-x-4">
                            <span>Title</span>
                            @if ($sortColumn == 'title' && $sortDirection == 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                            </svg>
                            @elseif($sortColumn == 'title' && $sortDirection == 'desc') 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortByColumn('rating')">
                        <div class="flex items-center space-x-4">
                            <span>Rating</span>
                            @if ($sortColumn == 'rating' && $sortDirection == 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                            </svg>
                            @elseif($sortColumn == 'rating' && $sortDirection == 'desc') 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortByColumn('visits')">
                        <div class="flex items-center space-x-4">
                            <span>Visits</span>
                            @if ($sortColumn == 'visits' && $sortDirection == 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                            </svg>
                            @elseif($sortColumn == 'visits' && $sortDirection == 'desc') 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </div>
                    </th>
                    <th class="px-4 py-3">Runtime</th>
                    <th class="px-4 py-3">Published</th>
                    <th class="px-4 py-3">Poster</th>
                    <th scope="col" class="px-6 py-3">
                       
                    </th>
                </tr>
            </thead>
            <tbody>
                
                @forelse ($movies as $table_movie)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" wire:key="key-{{$table_movie->id}}-index">
                    <td class="px-6 py-4">
                        <span wire:click="showDetailMovie({{$table_movie->id}})" class="text-indigo-600 hover:text-indigo-900">
                            {{$table_movie->title}}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{$table_movie->rating}}
                    </td>
                    <td class="px-6 py-4">
                        {{$table_movie->visits}}
                    </td>
                    <td class="px-4 py-3 text-ms font-semibold border">
                        {{ date('H:i', mktime(0, $table_movie->runtime)) }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($table_movie->is_public)
                        <span class="bg-green-200 opacity-80 rounded-full px-2">published</span>
                        @else
                        <span class="bg-red-200 opacity-50 rounded-full px-2">unPublished</span>
                        @endif
                    </td>  
                    <td class="px-4 py-3 text-ms font-semibold border">
                        <img class="h-12 w-12 rounded"
                            src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $table_movie->poster_path }}">
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="showTrailer({{$table_movie->id}})" class="px-2 py-1 text-xs text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Trailer</button>
                        <button wire:click="editModal({{$table_movie->id}})" class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md focus:bg-orange-600 focus:outline-none">Edit</button>
                        <button wire:click="deleteMovie({{$table_movie->id}})" class="px-2 py-1 text-xs text-white bg-red-500 rounded-md focus:bg-red-600 focus:outline-none">Delete</button>
                    </td>
                   @empty
                    <td class="px-6 py-4">
                        Empty
                    </td>
                </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Movie Edit</h1>
                <p class="text-gray-400 dark:text-gray-400">Fill up the form below to send us a message.</p>
           
            </div>
        </x-slot>
        <x-slot name="content">

            <div class="flex items-center w-full ">
                <div class="w-full"  x-data="{tag : 0}"  >
                    <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
                        <div class="w-full flex space-x-4">
                            <button  class="flex-1 px-5 py-2 border " x-on:click="tag = 0">Form</button>
                            <button class="flex-1 px-5 py-2 border "  x-on:click="tag = 1">Tag</button>
                            <button class="flex-1 px-5 py-2 border "  x-on:click="tag = 2">Cast</button>
                        </div>
                        <div class="m-7">
                            <div x-show="tag === 0">
                                <form>
                                    <div class="mb-6">
                                        <label for="title" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Cast title</label>
                                        <input wire:model="title" type="text" id="title"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                    </div>
                                    @error('title')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <label for="runtime" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Runtime</label>
                                        <input wire:model="runtime" type="text" id="runtime"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                    </div>
                                    @error('runtime')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <label for="lang" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Languange</label>
                                        <input wire:model="lang" type="text" id="lang"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                    </div>
                                    @error('lang')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <label for="vid_format" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Video Format</label>
                                        <input wire:model="videoFormat" type="text" id="vid_format"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                    </div>
                                    @error('videoFormat')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <label for="rating" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Rating</label>
                                        <input wire:model="rating" type="text" id="rating"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                    </div>
                                    @error('rating')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
                                    
                                    <div class="mb-6">
                                        <label for="posterPath" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Poster path</label>
                                        <input wire:model="posterPath" type="text" id="posterPath"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                    </div>
                                    @error('posterPath')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <label for="backdropPath" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Backdrop path</label>
                                        <input wire:model="backdropPath" type="text" id="backdropPath"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                    </div>
                                    @error('backdropPath')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <label for="overview" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Your overview</label>
                                        <textarea rows="5" id="overview" placeholder="Your overview" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" >{{$overview}}</textarea>
                                    </div>
                                    @error('overview')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <input wire:model="isPublic" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault">
                                          is public
                                        </label>
                                    </div>
                                    
                                    <div class="mb-6">
                                        <button wire:click="closeModal" type="button" class="px-3 py-2 text-white bg-yellow-500 rounded-md focus:bg-yellow-600 focus:outline-none">Cancel</button>
                                        <button wire:click="updateMovie" type="button" class="px-3 py-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div x-show="tag === 1">
                                <livewire:admin.movie-tag :movie="$movie" >
                            </div>
                            <div x-show="tag === 2">
                                <div>
                                    <input wire:model="queryCast" type="text" class="rounded w-full" placeholder="Serach Cast" >
                                    @if (!empty($queryCast))
                                        <div class="w-full">
                                            @if (!empty($casts))
                                                @foreach ($casts as $cast)
                                                <div 
                                                    wire:click="addCast({{$cast->id}} , {{$movie}})"
                                                    class="w-full p-2 m-2 bg-green-200 hover:bg-green-300  cursor-pointer"
                                                >
                                                    {{$cast->name}}
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">

            <div class="flex space-x-4">
             
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="trailerModal">
        <x-slot name="title">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Trailers</h1>
                <p class="text-gray-400 dark:text-gray-400">Fill up the form below to send us a message.</p>
           
            </div>
        </x-slot>
        <x-slot name="content">

            <div class="flex items-center w-full ">
                <div class="w-full">
                    <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
                  
                        <div class="m-7">
                                <form>
                                    <div class="mb-6">
                                        <label for="trailerName" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Name</label>
                                        <input wire:model="trailerName" type="text" id="trailerName"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                    </div>
                                    @error('trailerName')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <label for="embedHtml" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Your embedHtml</label>
                                        <textarea rows="5" id="embedHtml" wire:model="embedHtml" placeholder="Your embedHtml" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" ></textarea>
                                    </div>
                                    @error('embedHtml')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
    
                                    <div class="mb-6">
                                        <button wire:click="closeModal" type="button" class="px-3 py-2 text-white bg-yellow-500 rounded-md focus:bg-yellow-600 focus:outline-none">Cancel</button>
                                        <button wire:click="addTrailer" type="button" class="px-3 py-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Add</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">

            <div class="flex space-x-4">
                @if ($movie)
                    @foreach ($movie->trailers as $trailer)
                    <button wire:click="deleteTrailer({{$trailer->id}})" class="px-2 py-1 text-xs text-white bg-red-500 rounded-md focus:bg-red-600 focus:outline-none">{{$trailer->name}}</button>
                    @endforeach
                @endif
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="detailModal">
        <x-slot name="title">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Details</h1>
            </div>
        </x-slot>
        <x-slot name="content">

            <div class="flex items-center w-full ">
                <div class="w-full">
                    <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
                     
                        <div class="m-7">
                            <div>
                                <span>{{$detailTitle}}</span>
                            </div>
                            <div class="m-6">
                                <button wire:click="closeModal" type="button" class="px-3 py-2 text-white bg-yellow-500 rounded-md focus:bg-yellow-600 focus:outline-none">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>
</div>