@extends('layouts.app')

@section('content')
<div class="container">
	@if(Auth::user()->hasRole(['secretario']))
		@foreach(Auth::user()->departamento as $verificar)
			@if($verificar->nombre  == 'Junta Local' )
				<a class="btn btn-info" href="{{route('departamento.create')}}">Agregar</a>
			@endif
		@endforeach
	@endif

</div>
<div class="container">
	@foreach($departamentos as $departamento)
	
		<a class="badge badge-light" href="{{route('departamento.show',$departamento->id)}}">
			<div class="card-deck">
			  <div class="card">
			    <img class="card-img-top" src="{{route('departamento.avatar',['filename'=>$departamento->image])}}" alt="{{$departamento->nombre}}">
			    <div class="card-body">
			      <h5 class="card-title">{{$departamento->nombre}}</h5>
			      <p class="card-text">{{$departamento->descripcion}}</p>
			    </div>
			    <div class="card-footer">
			      <small class="text-muted">Ultima actualización {{$departamento->updated_at}}</small>
			    </div>
			  </div>
			</div>
		</a>
	@endforeach
</div>



@endsection