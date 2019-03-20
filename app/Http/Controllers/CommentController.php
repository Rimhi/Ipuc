<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   
    public function store(Request $request)
    {
        $validate = $this->validate($request,[
            'imagen_id'=>'integer|required',
            'content'=>'string|required',
    ]);
        
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->content = $request->content;
        $comment->image_id = $request->imagen_id;
        $comment->save();
        return redirect()->route('image.show',$request->imagen_id);
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $comment = Comment::findOrFail($id);
        $image_id = $comment->image->id;
      

        if(auth()->user()->id == $comment->user->id || $comment->image->user->id == auth()->user()->id){
            $comment->delete();
            return redirect()->route('image.show',$image_id);
        }else{
            return redirect()->route('image.show',$image_id);
        }
    }
}
