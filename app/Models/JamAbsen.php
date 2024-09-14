<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class JamAbsen extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'jam_absen';
    protected $guarded =['id'];

     public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
