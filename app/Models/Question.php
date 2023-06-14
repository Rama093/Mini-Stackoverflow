<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'body','collective_id', 'user_id','votes','category_id','slug','deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function commentaire(){
        return $this->hasMany(Commentaire::class);
    }

    public function collective(){
        return $this->belongsTo(Collective::class)->withDefault([
            'titre' => 'Collective non défini'
        ]);
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
