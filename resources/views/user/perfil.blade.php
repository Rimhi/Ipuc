@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">
                    @if($user->image)
                    <img src="{{route('user.avatar',['filename'=>$user->image])}}"  class="perfil-img" alt="{{$user->nombre}}">
                    @endif
                    <span class="perfil-nombre">
                        <p>{{$user->nombre.' '.$user->apellido}}</p>
                        <p style="margin-bottom: 5px;">Cargos: </p>
                        @foreach($user->departamento as $departamento)
                            <p style="margin:0px;">{{$departamento->pivot->cargo.' de '.$departamento->nombre}}</p>
                        @endforeach
                        <p style="margin-top: 5px; margin-bottom: 5px;">Teléfono: {{$user->telefono}}</p>
                        <p style="margin-top: 5px;"> {{'se unió '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                    </span>

                   
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($user->estado)
                    <p>{{$user->estado->content}}</p>

                    <span class="perfil-nombre">
                        {{'Actualizado '.\FormatTime::LongTimeFilter($user->estado->updated_at)}}
                    </span>
                    @endif
                </div>
                @if($user->id == auth()->user()->id)
                   <form method="POST" action="{{route('user.estado')}}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                        <p>
                                            <textarea class="estado" name="content" placeholder="Comparte tu estado" required></textarea>
                                            @if ($errors->has('content'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <button type="submit" class="btn btn-info">Enviar</button>
                                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
