<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class jabatan extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'jabatan';
    protected $guarded =['id'];

     public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'jabatan'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
