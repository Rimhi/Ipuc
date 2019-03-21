<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\User;
use App\Estado;
use App\Departamento;

class UserController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function config(){

    	return view('user.config');
    }
    public function update(Request $request){
    	$id = auth()->user()->id;
    	$validar =  $this->validate($request,[
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'apellido' =>['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'cedula' =>['required', 'integer'],
            'telefono'=>['required', 'string','min:10','max:10'],

        ]);
        if ($validar) {
    		$user = auth()->user();
          
            $image_path = time().$request->image->getClientOriginalName();
            Storage::disk('users')->put($image_path,File::get($request->image));
            $user->image = $image_path;
    		$user->update($request->all());
    		$exito = 'Actualizacion exitosa!';
        	return view('user.config')->with(compact(['exito']));
        }else{
        	$error = 'No se ha podido realizar tu actualizacion por favor verifica los campos';
        	return view('user.config')->with(compact(['error']));
        }
    	
    }
    public function getImage($file_name){
        $file = Storage::disk('users')->get($file_name);

        return new Response($file,200);
    }
    public function perfil($id){
        $user = User::findOrFail($id);

        return view('user.perfil')->with(compact(['user']));
    }
    public function estado(Request $request){
        $es = Estado::where('user_id',auth()->user()->id)->count();
        if ($es == 0) {
            $estado = new Estado();
            $estado->user_id = auth()->user()->id;
            $estado->content = $request->content;
            $estado->save();
        }else{
           
            $estado = Estado::where('user_id',auth()->user()->id)->get();
            $estado->first()->fill($request->all())->save();
        }
        
        return redirect()->route('user.perfil',auth()->user()->id);
    }
    public function cargo(){
        $users = User::all();

        return view('user.cargo')->with(compact(['users']));
    }
    public function getUser($id){
        foreach (auth()->user()->departamento  as $departamento) {
            # code...
        
        if ($departamento->nombre == 'Junta Local') {
            $user= User::findOrFail($id);
            $departamentos = Departamento::all();
            return view('user.cargoadd')->with(compact(['user','departamentos']));
        }else{
            echo "Ups... no tienes permitido acceder aqui";
        }
       }
    }
    public function guardarcargo(Request $request){
        foreach (auth()->user()->departamento  as $departamento) {
            # code...
        
        if ($departamento->nombre == 'Junta Local') {
            $user = User::findOrFail($request->user_id);
            $user->departamento()->attach($request->departamento_id,['cargo'=>$request->cargo]);
            return redirect()->route('user.cargo');
        }else{
            echo "Ups... no tienes permitido acceder aqui";
        }
       }
        
    }
    public function eliminarcargo($id,$departamento){
         foreach (auth()->user()->departamento  as $departamento) {
            # code...
        
        if ($departamento->nombre == 'Junta Local') {
             $user = User::findOrFail($id);
            $user->departamento()->detach($departamento);
            return redirect()->route('user.cargo');
        }else{
            echo "Ups... no tienes permitido acceder aqui";
        }
       }
    }
}
