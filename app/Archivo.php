<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
	protected $table = 'files';
    protected $fillable = [
        'image_path'
    ];
    public function image(){
    	return $this->belongsTo(Image::class);
    }
}
