@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Miembros Registrados</div>
                @foreach($users as $user)
                <div class="card-body">
                    <a href="{{route('user.cargoadd',$user->id)}}">{{$user->nombre.' '.$user->apellido}}</a>
                    <span class="perfil-nombre">
                        <p style="margin-bottom: 5px;">Cargos: </p>
                        @foreach($user->departamento as $departamento)
                            <p style="margin:0px;">{{$departamento->pivot->cargo.' de '.$departamento->nombre}}</p>
                        @endforeach
                        <p style="margin-top: 5px; margin-bottom: 5px;">Teléfono: {{$user->telefono}}</p>
                        <p style="margin-top: 5px;"> {{'se unió '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection