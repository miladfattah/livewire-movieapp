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
    public $prePage = 5 ;

    public $modal = false;
    public $serieTmdbId ;


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

    public function updateSerie()
    {

    }
    


    public function render()
    {
        return view('livewire.admin.serie-index'  , [
            'series' => Serie::search($this->search)->orderBy($this->sort)->paginate($this->prePage)
        ]);
    }
}
