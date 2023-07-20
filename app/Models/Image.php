<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    
    //Relacion One to Many
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    //Relacion One to Many
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    //Relacion de Many to One
    //busca en la otra tabla los objetos cuyo id = use_id
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
