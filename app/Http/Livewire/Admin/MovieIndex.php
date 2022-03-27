<?php

namespace App\Http\Livewire\Admin;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class MovieIndex extends Component
{
    use WithPagination ;

    public $modal = false ;
    public $movieId ; 

    public $search = '' ;
    public $sortColumn = 'title' ;
    public $sortDirection = 'asc' ; 
    public $perPage = 5 ; 

    public $movieTmdb ; 
    public $title;
    public $runtime;
    public $lang;
    public $videoFormat;
    public $rating;
    public $posterPath;
    public $backdropPath;
    public $overview;
    public $isPublic;
    
    public $movie ; 

    public $rules = [
        'movie' => 'required' , 
        'title'  => 'required' ,  
        'runtime'  => 'required' , 
        'lang'   => 'required' , 
        'rating'   => 'required' , 
        'posterPath'   => 'required' , 
        'backdropPath'  => 'required' , 
        'overview'   => 'required' , 
        'isPublic'  => 'required'
    ];


    public function generateMovie()
    {
        $movie = Movie::where('tmdb_id' , $this->movieTmdb)
                        ->exists();
        if($movie){
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Movie exists1']);
            return;
        }

        $apiMovie = Http::get("https://api.themoviedb.org/3/movie/{$this->movieTmdb}?api_key=91746255cf87a6b08e747e6ee93edff5");
        if($apiMovie->ok()){
            $newMovie = $apiMovie->json();
          
            $created_movie =  Movie::create([
                'tmdb_id' => $newMovie['id'] , 
                'title' => $newMovie['title'] , 
                'release_date' => $newMovie['release_date'] ,
                'runtime' => $newMovie['runtime'] , 
                'lang' => $newMovie['original_language'], 
                'video_format' => 'video_format' ,
                'visits' => $newMovie['vote_count'] , 
                'slug' => Str::slug($newMovie['title']) ,
                'rating' => $newMovie['vote_average'] , 
                'poster_path' => $newMovie['poster_path'] , 
                'backdrop_path' => $newMovie['backdrop_path'] , 
                'overview' => $newMovie['overview'] 
            ]);
            $tmdb_genres = $newMovie['genres'];
            $tmdb_genres_ids = collect($tmdb_genres)->pluck('id');
            $genres = Genre::whereIn('tmdb_id' , $tmdb_genres_ids)->get();
            $created_movie->genres()->attach($genres); 
            $this->reset('movieTmdb');
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Movie create']);
        }else{
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Movie exisit2']);
        }
    }


    public function sortByColumn($column)
    {
        if($this->sortColumn == $column){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' ;
        }else{
            $this->sortDirection = 'asc' ;
        }
        $this->sortColumn = $column ;
    }

    public function closeModal()
    {
        $this->modal = false ;
    }

    public function editModal($id)
    {
        $this->movieId = $id ; 
        $this->movie = Movie::findOrFail($this->movieId);
        $this->modal = true ; 
        $this->loadMovie();
    }

    public function loadMovie()
    {
        $this->title = $this->movie->title ; 
        $this->runtime = $this->movie->runtime ;
        $this->lang = $this->movie->lang ;
        $this->videoFormat = $this->movie->video_format ;
        $this->rating  = $this->movie->rating ;
        $this->posterPath  = $this->movie->poster_path ;
        $this->backdropPath  = $this->movie->backdrop_path ;
        $this->overview  = $this->movie->overview ;
        $this->isPublic   = $this->movie->is_public ;
    }

    public function updateMovie()
    {
        $this->validate();
       
        $this->movie->update([
            'title' => $this->title , 
            'runtime' => $this->runtime  , 
            'lang' => $this->lang, 
            'video_format' => $this->videoFormat  ,
            'rating' => $this->rating , 
            'poster_path' => $this->posterPath , 
            'backdrop_path' => $this->backdropPath , 
            'overview' => $this->overview ,
            'is_public' => $this->isPublic
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Movie updated']);
        $this->reset();
    }

    public function resetFilters()
    {
        $this->reset(['search' , 'sortColumn' , 'perPage' , 'sortDirection']);
    }

    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Movie deleted']);
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.admin.movie-index' , [
            'movies' => Movie::search($this->search)
                                ->query(function($query){
                                    $query->orderBy($this->sortColumn , $this->sortDirection);
                                })
                                ->paginate($this->perPage)
        ]);
    }
}
