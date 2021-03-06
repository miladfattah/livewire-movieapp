<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tag extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    public function toSearchableArray()
    {
        return [
            'tag_name' => $this->name,
        ];
    }

    public function movie()
    {
        return $this->morphedByMany(Movie::class , 'taggables');
    }
}
