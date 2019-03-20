@extends('layouts.app')

@section('content')
	<div class="container">
		  <div class="row justify-content-center">
        <div class="col-md-8">
        	<div class="card-body">
                	@if(isset($error))
                		<div class="alert alert-danger">
                			<h3>{{$error}}</h3>
                		</div>
                	@elseif(isset($exito))
                		<div class="alert alert-success">
                			<h3>{{$exito}}</h3>
                		</div>
                	@endif
            <div class="card">
                <div class="card-header">{{ __('Editar departamento') }}</div>

                    <form method="POST" enctype="multipart/form-data" action="{{ route('departamento.update',$departamento->id) }}">
                    	{!!@method_field('PUT')!!}
                        @csrf

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nombre" value="{{ $departamento->nombre }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{$departamento->descripcion}}" required>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                         <div class="form-group row">
                           @if($departamento->image)
                                <img src="{{route('departamento.avatar',['filename'=>$departamento->image])}}" class="img-thumbnail" style="width: 200px; height: 250px; display: block; margin-left: 35%" alt="{{$departamento->nombre}}" />
                            @endif
                        </div>
                        <div class="form-group row">

                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" >

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	</div>
@endsection