<?php

namespace App\Http\Livewire\Admin;

use App\Models\Serie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
class SerieIndex extends Component
{
    use WithPagination  ;
    public $search = '' ; 
    public $sort = 'asc';
    public $perPage = 5 ;

    public $modal = false;
    public $serieTmdbId ;
    public $serieId ;

    public $name ; 
    public $created_year ;
    public $poster_path ;

    public $rules = [
        'name' => 'required' , 
        'created_year' => 'required' , 
    ];


    public function generateSerires()
    {
        $newSerie = Http::get("https://api.themoviedb.org/3/tv/{$this->serieTmdbId}?api_key=91746255cf87a6b08e747e6ee93edff5")->json();
        $serie = Serie::where('tmdb_id' , $this->serieTmdbId)->first();
        if(!$serie){
            Serie::create([
                'tmdb_id' => $newSerie['id'] , 
                'name' => $newSerie['name'] , 
                'slug' => Str::slug($newSerie['name']), 
                'created_year' => $newSerie['first_air_date'] ,
                'pooster' => $newSerie['poster_path']
            ]);
            $this->reset();
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Serie create']);
        }else{
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Serie exisit']);
        }
    }

    public function closeModal()
    {
        $this->modal = false ;
    }

    public function editModal($id)
    {
        $this->modal = true ; 
        $this->serieId = $id ; 
        $this->loadSerie();
    }

    public function loadSerie()
    {
        $serie = Serie::findOrFail($this->serieId);
        $this->name = $serie->name ; 
        $this->created_year = $serie->created_year ;
        $this->poster_path = $serie->pooster ;
    }

    public function updateSerie()
    {
        $this->validate();
        $serie = Serie::findOrFail($this->serieId);
        $serie->update([
            'name' => $this->name , 
            'slug' => Str::slug($this->name), 
            'created_year' => $this->created_year ,
            'pooster' => $this->poster_path
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Serie create']);
        $this->reset();
    }

    public function resetFilters()
    {
        $this->reset(['search' , 'sort' , 'perPage']);
    }

    public function deleteSerie($id)
    {
        $seire = Serie::findOrFail($id);
        $seire->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Serie deleted']);
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.admin.serie-index'  , [
            'series' => Serie::search($this->search)->orderBy($this->sort)->paginate($this->perPage)
        ]);
    }
}
