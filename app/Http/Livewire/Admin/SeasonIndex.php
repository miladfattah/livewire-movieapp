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
    public Serie $serie ; 
    public $seasonNumber ;

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
  
    public function render()
    {
        return view('livewire.admin.season-index' , [
            'seasons' => Season::paginate(5)
        ]);
    }
}
