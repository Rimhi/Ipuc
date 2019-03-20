<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $fillable = [
        'nombre', 'descripcion',
    ];

    public function users(){
    	return $this->belongsToMany(User::class,'assigned_departamento');
    }
    public function images(){
    	return $this->hasMany(Image::class);
    }
}
