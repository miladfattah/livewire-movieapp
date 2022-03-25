<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagIndex extends Component
{
    public $modal = false ; 
    public $tag_name ;
    public $tag_id ; 

    public $search = '' ;
    public $sort = 'asc' ;
    public $perPage = 5 ;

    public $rules = [
        'tag_name' => ['required' , 'string'] , 
    ];

  
    public function showModal()
    {
        $this->reset('tag_name');
        $this->modal = true ; 
    }

    public function closeModal()
    {
        $this->modal = false ; 
    }

    public function createTag()
    {
        $this->validate();
        Tag::create([
            'tag_name' => $this->tag_name , 
            'slug' => Str::slug($this->tag_name)
        ]);
        $this->reset();
    }
    
    public function editModal($tagId)
    {
        $this->reset('tag_name');
        $this->tag_id = $tagId;
        $tag = Tag::find($tagId);
        $this->tag_name = $tag->tag_name;
        $this->modal = true;
    }

    public function updateTag()
    {
        $tag = Tag::findOrFail($this->tag_id);
        $tag->update([
            'tag_name' => $this->tag_name , 
            'slug' => Str::slug($this->tag_name)
        ]);
        $this->modal = false;
        $this->reset();
        $this->tags = Tag::query('id' , 'tag_name' , 'slug')->get();
    }

    public function deleteTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $tag->delete();
        $this->reset();
        $this->tags = Tag::query('id' , 'tag_name' , 'slug')->get();
    }

    public function render()
    {
        return view('livewire.admin.tag-index' , [
            'tags' => Tag::search($this->search)->orderBy($this->sort)->paginate($this->perPage)
        ]);
    }
}
