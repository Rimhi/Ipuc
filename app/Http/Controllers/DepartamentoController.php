<?php

namespace App\Http\Controllers;

use App\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Comment;
use App\Like;

class DepartamentoController extends Controller
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
        $departamentos = Departamento::all();
        return view('departamento.index')->with(compact(['departamentos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('departamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Departamento= Departamento::create($request->all());
        return  redirect()->route('departamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $departamento = Departamento::with(['users','images'])->findOrFail($id);
       return view('departamento.show')->with(compact(['departamento']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamento = Departamento::with(['users','images'])->findOrFail($id);
       return view('departamento.edit')->with(compact(['departamento']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $departamento = Departamento::findOrFail($id);
        $image_path = time().$request->image->getClientOriginalName();
        Storage::disk('departamentos')->put($image_path,File::get($request->image));
        $departamento->image = $image_path;
        $departamento->update($request->all());
        return view('departamento.show')->with(compact(['departamento']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        $user = auth()->user();
        $image = Image::findOrFail($id);
        $comments = Comment::where('image_id',$image->id)->get();
        $likes = Like::where('image_id',$image->id)->get();
        if ($user && $image && $image->user->id == $user->id) {
            if ($comments && count($comments)=>1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
             if ($likes && count($likes)=>1) {
                foreach ($likes as like) {
                    $like->delete();
                }
            }
            Storage::disk('images')->delete($image->image_path);
            $image->delete()
            $message = array('message'=>'La publicación se ha borrado con éxito');
        }else{
            $message = array('message'=>'La publicación no se ha borrado, no tienes permiso para hacerlo');
        }
        return redirect()->route('departamento.index')->with(compact(['mensaje']));*/
    }
     public function getImage($file_name){
        $file = Storage::disk('departamentos')->get($file_name);

        return new Response($file,200);
    }
}
