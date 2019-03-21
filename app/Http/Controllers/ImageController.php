<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Departamento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Comment;
use App\Like;


class ImageController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::orderBy('created_at','desc')->paginate(5);
        return view('image.index')->with(compact(['images']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamento = Departamento::findOrFail($_GET['id']);
        return view('image.create')->with(compact(['departamento']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = new Image();
        $image->user_id = auth()->user()->id;
        $image->departamento_id = $request->departamento_id;
        $image_path = time().$request->image->getClientOriginalName();
            Storage::disk('images')->put($image_path,File::get($request->image));
        $image->image_path = $image_path;
        $image->description = $request->description;
        $image->save();

        return redirect()->route('image.index');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::with(['user','departamento'])->findOrFail($id);
        
        $ext =  explode(".", $image->image_path);
        $extencion = end($ext);
        return view('image.show')->with(compact(['image','extencion']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $image = Image::findOrFail($id);
        $comments = Comment::where('image_id',$image->id)->get();
        $likes = Like::where('image_id',$image->id)->get();
        if ($user && $image && $image->user->id == $user->id) {
            if ($comments && count($comments)>=1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
             if ($likes && count($likes)>=1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            Storage::disk('images')->delete($image->image_path);
            $image->delete();
            $message = array('message'=>'La publicación se ha borrado con éxito');
        }else{
            $message = array('message'=>'La publicación no se ha borrado, no tienes permiso para hacerlo');
        }
        return redirect()->route('image.index')->with(compact(['mensaje']));
    }
     public function getImage($file_name){
        $file = Storage::disk('images')->get($file_name);

        return new Response($file,200);
    }
}
