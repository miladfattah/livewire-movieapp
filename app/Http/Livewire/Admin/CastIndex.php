<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cast;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class CastIndex extends Component
{
    use WithPagination ;
    public $key = "91746255cf87a6b08e747e6ee93edff5";
    public $castTMDBId ; 
    public $castName ; 
    public $castPosterPath ; 
    public $castId ;
    public $modal = false ;

    protected $rules = [
        'castName' => 'required',
        'castPosterPath' => 'required'
    ];

    public function generateCast()
    {
        $newCast = Http::get("https://api.themoviedb.org/3/person/{$this->castTMDBId}?api_key={$this->key}");
        $cast = Cast::where('tmdb_id' , $newCast['id'])->first();
        if(!$cast){
            Cast::create([
                'tmdb_id' => $newCast['id'] ,
                'name' => $newCast['name'],
                'slug' => Str::slug($newCast['name']), 
                'poster_path' => $newCast['profile_path']
            ]);
        }else{
            $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Cast exisit']);
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
        $this->castId = $id;
        $this->loadCast();
        $this->modal = true;
    }

    public function loadCast(){
        $cast = Cast::findOrFail($this->castId);
        $this->castName = $cast->name ;
        $this->castPosterPath =  $cast->poster_path ;
    }

    public function updateCast()
    {
        $this->validate();
        $cast = Cast::findOrFail($this->castId);
        $cast->update([
            'name' => $this->castName,
            'poster_path' =>$this->castPosterPath
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Cast updated']);
        $this->reset();
    }

    public function deleteCast($id)
    {
        $cast = Cast::findOrFail($id);
        $cast->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Cast deleted']);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.cast-index' , [
            'casts' => Cast::all()
        ]);
    }
}
