@extends('layouts.app')

@section('content')
<div class="container">
	
		@foreach(Auth::user()->departamento as $verificar)
			@if($verificar->nombre  == 'Junta Local' )
				<a class="btn btn-info" href="{{route('departamento.create')}}">Agregar</a>
			@endif
		@endforeach
		{!!$departamentos->render()!!}

</div>
<div class="container">
	<div class="card-group">
	@foreach($departamentos as $departamento)

			
			  <div class="card">
			  	<div class="card-img-top"> 
			    <img  src="{{route('departamento.avatar',['filename'=>$departamento->image])}}" alt="{{$departamento->nombre}}" style="width:100%; height: 124px;" >
			    </div>
			    <div class="card-body">
			      <h5 class="card-title">{{$departamento->nombre}}</h5>
			      <p class="card-text">{{$departamento->descripcion}}</p>
			    </div>
			    <div class="card-footer">
			      <small class="text-muted">Ultima actualización {{$departamento->updated_at}}</small>
			    </div>
			  </div>
			
		</a>
	@endforeach
	</div>
</div>



@endsection