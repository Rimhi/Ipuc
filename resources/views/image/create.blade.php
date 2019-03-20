@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">{{ __('Realizar una publicación') }}</div>
                    <form method="POST" action="{{route('image.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            
                             <input type="text" name="departamento_id" class="form-control" value="{{$departamento->id}}" hidden>

                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control{{ $errors->has('descritcion') ? ' is-invalid' : '' }}" name="description" required autofocus></textarea>
                                
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
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
                                    {{ __('Finalizar') }}
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