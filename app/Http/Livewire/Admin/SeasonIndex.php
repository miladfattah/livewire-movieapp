<?php

namespace App\Http\Livewire\Admin;


use App\Models\Serie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Season; 

class SeasonIndex extends Component
{
    use WithPagination ;
    public $search = '' ; 
    public $sort = 'asc';
    public $perPage = 5 ;

    public $modal = false;
    public $seasonId ;

    public $name ; 
    public $seasonNumber ;
    public $poster_path ;

    public $rules = [
        'name' => 'required' , 
    ];

    public Serie $serie ; 

    public function generateSeason()
    {
        $season = Season::where('season_number', $this->seasonNumber)->exists();
        if($season){
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Season exists1']);
            return;
        }

        $apiSeason = Http::get("https://api.themoviedb.org/3/tv/{$this->serie->tmdb_id}/season/{$this->seasonNumber}?api_key=91746255cf87a6b08e747e6ee93edff5");
        if($apiSeason->ok()){
            $newSeason = $apiSeason->json();
            Season::create([
                'serie_id' => $this->serie->id , 
                'tmdb_id' => $newSeason['id'] , 
                'name' => $newSeason['name'] , 
                'slug' => Str::slug($newSeason['name']), 
                'season_number' => $newSeason['season_number'] ,
                'poster_path' => $newSeason['poster_path'] ? $newSeason['poster_path'] : $this->serie->pooster 
            ]);
            $this->reset('seasonNumber');
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Season create']);
        }else{
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Season exisit2']);
        }
    }

    public function closeModal()
    {
        $this->modal = false ;
    }

    public function editModal($id)
    {
        $this->modal = true ; 
        $this->seasonId = $id ; 
        $this->loadSeason();
    }

    public function loadSeason()
    {
        $season = Season::findOrFail($this->seasonId);
        $this->name = $season->name ; 
        $this->seasonNumber = $season->season_number ;
        $this->poster_path = $season->poster_path ;
    }

    public function updateSeason()
    {
        $this->validate();
        $season = Season::findOrFail($this->seasonId);
        $season->update([
            'name' => $this->name , 
            'slug' => Str::slug($this->name), 
            'season_number' => $this->seasonNumber ,
            'poster_path' => $this->poster_path
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'season updated']);
        $this->reset(['name' , 'seasonNumber' , 'poster_path' , 'seasonId' , 'modal']);
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
        $this->reset(['name' , 'seasonNumber' , 'poster_path' , 'seasonId']);
    }
    public function render()
    {
        return view('livewire.admin.season-index' , [
            'seasons' => Season::where('serie_id' , $this->serie->id)
                        ->orderBy('name' , $this->sort)
                        ->paginate($this->perPage)
        ]);
    }
}
