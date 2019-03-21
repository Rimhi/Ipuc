@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
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
							@if($image->image_path)
								@if($extencion != 'mp4')
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
							@if($image->user->id == auth()->user()->id)
								<div class="actions">
									<a href="" class="btn btn-sm btn-warning">Editar</a>
									<a href="{{route('image.destroy',$image->id)}}" class="btn btn-sm btn-danger">Borrar</a>
								</div>
							@endif
							<div class="clearfix"></div>
							<div class="comments detail">

								<div>
									<h3>Comentarios ({{count($image->comments)}})</h3>
									<hr>
									<form method="POST" action="{{route('comment.store')}}">
										@csrf
										<input type="hidden" name="imagen_id" value="{{$image->id}}">
										<p>
											<textarea class="form-group" name="content" placeholder="Escribe tu comentario aquí ..." required></textarea>
											@if ($errors->has('content'))
			                                    <span class="invalid-feedback" role="alert">
			                                        <strong>{{ $errors->first('content') }}</strong>
			                                    </span>
			                                @endif
										</p>
										<button type="submit" class="btn btn-info">Enviar</button>
									</form>
									<hr>
									@foreach($image->comments as $comment)
										<div class="comment">
											<div class="container-avatar">
												<img class="avatar" src="{{route('user.avatar',['filename'=>$comment->user->image])}}">
											</div>
											<span class="nickname">{{$comment->user->nombre}}</span>
											<span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
												<p>{{$comment->content}}</p>
											@if(Auth::check() && (auth()->user()->id == $comment->user->id || $comment->image->user->id == auth()->user()->id))
												<a href="{{route('comment.destroy',['id'=>$comment->id])}}" class="btn btn-sm btn-danger">Eliminar</a>
											@endif
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>



@endsection