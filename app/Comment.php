<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['content'];

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    } 

    public function image(){
    	return $this->belongsTo(Image::class,'image_id');
    }

    
}
