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
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection