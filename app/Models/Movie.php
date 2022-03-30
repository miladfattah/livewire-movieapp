<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Movie extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
        ];
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }

    public function trailers()
    {
        return $this->morphMany(TrailerUrl::class , 'trailerable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class  , 'taggables' );
    }
}
