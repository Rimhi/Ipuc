@extends('layouts.app')

@section('content')
	<div class="container">
		  <div class="row justify-content-center">
        <div class="col-md-8">
        	<div class="card-body">
        		 <div class="card">
		@if($departamento->image)
			<img src="{{route('departamento.avatar',['filename'=>$departamento->image])}}"  class="img-fluid" alt="{{$departamento->nombre}}">
	 	@endif
	 <div class="card-header">{{ __($departamento->descripcion) }}</div>
	@foreach(Auth::user()->departamento as $verificar)
        @if($verificar->nombre == $departamento->nombre)
                <a  class="btn btn-info" href="{{route('departamento.edit',$departamento->id)}}">Editar</a>
                <a  class="btn btn-success" href="{{route('image.create','id='.$departamento->id)}}">Realiza una publicación</a>
                

        @endif
    @endforeach
    <span class="number_publicaciones">
      <p>Publicaciones: {{count($departamento->images)}}</p>
    </span>
    <span class="number_publicaciones">
                  <?php
                    $numero_likes = 0;
                    foreach ($departamento->images as $image) {
                      $numero_likes = $numero_likes + count($image->likes);
                    }
                  ?>
                <p>Opiniones favorables: {{$numero_likes}}</p>
                </span>
                <span class="number_publicaciones">
                  <?php
                    $numero_comments = 0;
                    foreach ($departamento->images as $image) {
                      $numero_comments = $numero_comments + count($image->comments);
                    }
                  ?>
                <p>Comentarios: {{$numero_comments}}</p>
                </span>
    </div>
</div>
</div>
</div>
</div>
<div class="container" style="width: 40rem;">
     <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                 <div class="card">
                    <div class="card-header">{{ __('Publicaciones') }}</div>
                    <div class="row justify-content-center">

                    @foreach($departamento->images as $image)
                        <div class="card pub_image">
            <div class="card-header">
              @if($image->user->image)
                <div class="container-avatar">
                  <img class="avatar" src="{{route('user.avatar',['filename'=>$image->user->image])}}">
                </div>
              @endif
              <div class="data-user">
             <a href="{{route('user.perfil',$image->user->id)}}">{{$image->user->nombre.' '.$image->user->apellido}}</a>
              @foreach($image->user->departamento as $cargo)
                @if($image->departamento->nombre == $cargo->nombre)
                  <span class="nickname">
                    {{' | '.$cargo->pivot->cargo}}
                    
                  </span>
                @endif
              @endforeach
              </div>
            </div>
            <div class="card-body">
              <?php
                $extencion = explode('.',$image->image_path);
              ?>
              @if($image->image_path)
                @if('mp4' !=end($extencion))
                  <div class="image-container">
                    <img src="{{route('image.avatar',['filename'=>$image->image_path])}}">
                  </div>
                @else
                  <div class="image-container">
                    <video src="{{route('image.avatar',['filename'=>$image->image_path])}}" controls></video>
                  </div>
                @endif
              @endif
              <div class="description">
                <span class="nickname">{{$image->departamento->nombre}}</span>
                <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                  <p>{{$image->description}}</p>
              </div>
              <div class="likes">
                
                <?php $user_like = false;?>
                @foreach($image->likes as $like)
                  @if($like->user->id == Auth::user()->id)
                    <?php $user_like = true;?>
                  @endif
                @endforeach
                @if($user_like)
                  <img src="{{asset('images/heartred.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                  <span class="number_likes">{{count($image->likes)}}</span>
                @else
                  <img src="{{asset('images/heartgray.png')}}" data-id="{{$image->id}}" class="btn-like">

                @endif

              </div>
              <div class="comments">
                  <a href="{{route('image.show',$image->id)}}" class="btn btn-sm btn-warning btn-comments">Comentarios ({{count($image->comments)}})</a>
              </div>
            </div>
          </div>
                    @endforeach
                </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection