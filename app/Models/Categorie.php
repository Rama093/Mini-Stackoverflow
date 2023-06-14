<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Categorie extends Model
{
    use HasFactory;

    public function questions(){
        return $this->hasMany(Question::class,'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
