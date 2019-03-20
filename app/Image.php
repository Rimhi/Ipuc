<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'descripcion','user_id','departamento_id'
    ];


    public function comments(){
    	return $this->hasMany(Comment::class)->orderBy('id','desc');
    }
    public function likes(){
    	return $this->hasMany(Like::class);
    }
    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    } 
    public function departamento(){
    	return $this->belongsTo(Departamento::class);
    }
}
