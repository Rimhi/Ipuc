@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Añadir Cargo</div>
                    
                        <div class="card-body">
                           <form method="POST" action="{{route('user.cargopost')}}">
                                @csrf
                                <label>¿Deseas añadir un cargo a:  {{$user->nombre.' '. $user->apellido}}?</label>
                                <div class="form-group">
                                <input type="hidden" name="user_id" value="{{$user->id}}" class="form-control">
                                </div>
                                @if($user->departamento)
                                    <div class="perfil-nombre">
                                      <span class="perfil-nombre">
                                        <p style="margin-bottom: 5px;">Cargos: </p>
                                          @foreach($user->departamento as $departamento)
                                              <p style="margin:0px;">{{$departamento->pivot->cargo.' de '.$departamento->nombre}}<a href="{{route('user.cargodelete',[$user->id,$departamento->id])}}" class="btn btn-sm btn-danger">Eliminar Cargo</a></p>
                                          @endforeach
                                          <p style="margin-top: 5px; margin-bottom: 5px;">Teléfono: {{$user->telefono}}</p>
                                          <p style="margin-top: 5px;"> {{'se unió '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                                      </span>
                                    </div>
                                @endif
                               <input type="text" name="cargo">
                               <select class="form-control" id="colaborador" name="departamento_id">
                                   @foreach($departamentos as $id => $nombre)
                                         <li class="list-group-item">
                                            <option id="grupos" value="{{$nombre->id}}">{{$nombre->nombre}}</option>
                                          </li>
                                    @endforeach
                                </select>
                                <div style="margin-top:10px; ">
                                <button class="btn btn-success">Listo!</button>
                                </div>
                           </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection