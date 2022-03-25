<?php

namespace App\Http\Livewire\Admin;

use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class MovieIndex extends Component
{
    use WithPagination ;

    public $modal = false ;
    public $movieId ; 

    public $movieTmdb ; 

    
    public $rules = [
        'name' => 'required' , 
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
            Movie::create([
                'tmdb_id' => $newMovie['id'] , 
                'title' => $newMovie['title'] , 
                'release_date' => $newMovie['release_date'] ,
                'runtime' => $newMovie['runtime'] , 
                'lang' => $newMovie['original_language'], 
                'video_format' => 'video_format' ,
                'visits' => $newMovie['vote_count'] , 
                'slug' => Str::slug($newMovie['title']) ,
                'ratingn' => 5 , 
                'poster_path' => $newMovie['poster_path'] , 
                'backdrop_path' => $newMovie['backdrop_path'] , 
                'overview' => $newMovie['overview'] 
            ]);

            $this->reset('movieTmdb');
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Movie create']);
        }else{
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Movie exisit2']);
        }
    }

    public function closeModal()
    {
        $this->modal = false ;
    }

    public function editModal($id)
    {
        $this->modal = true ; 
        $this->movieId = $id ; 
        $this->loadMovie();
    }

    public function loadMovie()
    {
        $movie = Movie::findOrFail($this->movieId);
        $this->title = $season->title ; 
        $this->seasonNumber = $season->season_number ;
        $this->poster_path = $season->poster_path ;
    }

    public function updateSeason()
    {
        $this->validate();
        $season = Season::findOrFail($this->movieId);
        $season->update([
            'name' => $this->name , 
            'slug' => Str::slug($this->name), 
            'season_number' => $this->seasonNumber ,
            'poster_path' => $this->poster_path
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'season updated']);
        $this->reset(['name' , 'seasonNumber' , 'poster_path' , 'movieId' , 'modal']);
    }

    public function resetFilters()
    {
        $this->reset(['search' , 'sort' , 'perPage']);
    }

    public function deleteSeason($id)
    {
        $season = Season::findOrFail($id);
        $season->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'season deleted']);
        $this->reset(['name' , 'seasonNumber' , 'poster_path' , 'movieId']);
    }
    
    public function render()
    {
        return view('livewire.admin.movie-index' , [
            'movies' => Movie::paginate()
        ]);
    }
}
