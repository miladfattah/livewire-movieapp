<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Serie; 
use App\Models\Season; 
use App\Models\Episode;

class EpisodeIndex extends Component
{
    use WithPagination ;
    public Serie $serie ;
    public Season $season ;
    
    public $search = '' ; 
    public $sort = 'asc';
    public $perPage = 5 ;

    public $modal = false;
    public $episodeId ;

    public $name ; 
    public $episodeNumber ;
    public $overview ;
    public $isPublic ;

    public $rules = [
        'name' => 'required' , 
        'overview' => 'required' 
    ];


    public function generateEpisode()
    {
        $episodeExist = Episode::where('season_id' , $this->season->id )
                        ->where('episode_number', $this->episodeNumber)
                        ->exists();
        if($episodeExist){
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Episode exists']);
            return;
        }

        $apiEpisode = Http::get("https://api.themoviedb.org/3/tv/{$this->serie->tmdb_id}/season/{$this->season->season_number}/episode/{$this->episodeNumber}?api_key=91746255cf87a6b08e747e6ee93edff5");
        if($apiEpisode->ok()){
            $newEpisode = $apiEpisode->json();
            Episode::create([
                'season_id' => $this->season->id , 
                'tmdb_id' => $newEpisode['id'] , 
                'name' => $newEpisode['name'] , 
                'slug' => Str::slug($newEpisode['name']), 
                'episode_number' => $newEpisode['episode_number'] ,
                'overview' => $newEpisode['overview'] ,
                'is_public' => false , 
                'visits' => 1
            ]);

            $this->reset('episodeNumber');
            $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Episode create']);
        }else{
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Episode exisit2']);
        }
    }

    public function closeModal()
    {
        $this->modal = false ;
    }

    public function editModal($id)
    {
        $this->modal = true ; 
        $this->episodeId = $id ; 
        $this->loadEpisode();
    }

    public function loadEpisode()
    {
        $episode = Episode::findOrFail($this->episodeId);
        $this->name = $episode->name ; 
        $this->episodeNumber = $episode->episode_number ;
        $this->overview = $episode->overview ;
        $this->isPublic = $episode->is_public ;
    }

    public function updateEpisode()
    {
        $this->validate();
        $episode = Episode::findOrFail($this->episodeId);
        $episode->update([
            'name' => $this->name , 
            'slug' => Str::slug($this->name), 
            'episode_number' => $this->episodeNumber ,
            'overview' => $this->overview ,
            'is_public' => $this->isPublic 
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Episode updated']);
        $this->reset(['name' , 'episodeNumber' , 'overview' , 'isPublic' , 'episodeId' , 'modal' ]);
    }

    public function resetFilters()
    {
        $this->reset(['search' , 'sort' , 'perPage']);
    }

    public function deleteEpisode($id)
    {
        $episode = Episode::findOrFail($id);
        $episode->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'episode deleted']);
        $this->reset(['name' , 'episodeNumber' , 'overview', 'isPublic' , 'episodeId']);
    }
    
    public function render()
    {
        return view('livewire.admin.episode-index' , [
            // 'episodes' => Episode::where('season_id' , $this->season->id)
            //             ->orderBy('name' , $this->sort)
            //             ->paginate($this->perPage)
            'episodes' => Episode::search($this->search)
                                ->query(function($query){
                                    $query->orderBy('name' , $this->sort);
                                })
                                ->paginate($this->perPage)
        ]);
    }
}
