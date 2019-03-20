<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
   protected $table;
   protected $fillable = ['content'];

   public function user(){
   	 return $this->belongsTo(User::class);
   }
}
