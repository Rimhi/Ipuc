<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Departamento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

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
    public function destroy(Image $image)
    {
        //
    }
     public function getImage($file_name){
        $file = Storage::disk('images')->get($file_name);

        return new Response($file,200);
    }
}
