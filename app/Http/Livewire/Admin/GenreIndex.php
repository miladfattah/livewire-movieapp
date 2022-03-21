<?php

namespace App\Http\Livewire\Admin;


use App\Models\Genre;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class GenreIndex extends Component
{
    use WithPagination;
    public $key = "91746255cf87a6b08e747e6ee93edff5";
    public $tmdbId ; 
    public $title ; 
    public $genreId ;
    public $modal = false ;

    protected $rules = [
        'title' => 'required',
    ];

    public function generateGenre()
    {
        $newGenre = Http::get('https://api.themoviedb.org/3/genre/'. $this->tmdbId .'?api_key=91746255cf87a6b08e747e6ee93edff5&language=en-US
        ')->json();
        dd($newGenre);
        $genre = Genre::where('tmdb_id' , $newGenre['id'])->first();
        if(!$genre){
            Genre::create([
                'tmdb_id' => $newGenre['id'] ,
                'title' => $newGenre['name'],
                'slug' => Str::slug($newGenre['name']), 
            ]);
            $this->reset();
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre created']);
        }else{
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Genre exisit']);
        }
    }

    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function editModal($id)
    {
        $this->reset();
        $this->genreId = $id;
        $this->loadGenre();
        $this->modal = true;
    }

    public function loadGenre(){
        $genre = Genre::findOrFail($this->genreId);
        $this->title = $genre->title ;
    }

    public function updateGenre()
    {
        $this->validate();
        $genre = Genre::findOrFail($this->genreId);
        $genre->update([
            'title' => $this->title,
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre updated']);
        $this->reset();
    }

    public function deleteGenre($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre deleted']);
        $this->reset();
    }


    public function render()
    {
        return view('livewire.admin.genre-index' , [
            'genres' => Genre::paginate(5)
        ]);
    }
}
