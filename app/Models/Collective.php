<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class Collective extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'user_id','members','category_id','slug','deleted_at'];

    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function owner($user_id){
        return auth()->user()->id === $user_id;
    }
    // permet d'aficher le titre(le slug) sur la barre d'url).
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
