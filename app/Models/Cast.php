<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Cast extends Model
{
    use HasFactory;
    use Searchable;
    protected $guarded = [];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function movies()
    {
        return $this->belognToMany(Movie::class , 'cast_movie')->latest();
    }

}
