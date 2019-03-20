<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
 
    
    public function store($image_id)
    {

        $user = auth()->user();
        $isset_like = Like::where('user_id',$user->id)
                            ->where('image_id',$image_id)->count();
        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = $image_id;
            $like->save();
        }else{

        }
      
    
    }

   
    public function destroy($image_id)
    {
       $user = auth()->user();
        $isset_like = Like::where('user_id',$user->id)
                            ->where('image_id',$image_id)->first();
        if ($isset_like) {
            $isset_like->delete();
        }else{
            
        }
      
    }
    public function userfavoritos(){
        $user = auth()->user();
        $likes = Like::where('user_id',$user->id)->orderBy('id','desc')->paginate(10);
        return view('user.favoritos')->with(compact(['likes']));
    }
}
