@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@if(isset($message))
					<div class="alert alert-success">{{$message}}</div>
				@endif
				@foreach($images as $image)
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
							
							@if($image->files)
								@if(count($image->files)==1)
									@foreach($image->files as $image_path)
										<?php
											$extencion = explode('.',$image_path->image_path);
										?>
										@if('mp4' !=end($extencion))
											<div class="image-container">
												<img src="{{route('image.avatar',['filename'=>$image_path->image_path])}}">
											</div>
										@else
											<div class="image-container">
												<video src="{{route('image.avatar',['filename'=>$image_path->image_path])}}" controls></video>
											</div>
										@endif
									@endforeach
								@else
									<div class="card-columns">
									@foreach($image->files as $image_path)
										<div class="card">
										<?php
											$extencion = explode('.',$image_path->image_path);
										?>
											@if('mp4' !=end($extencion))
												
													<img src="{{route('image.avatar',['filename'=>$image_path->image_path])}}" class="card-img-top">
												
											@else
												
													<video src="{{route('image.avatar',['filename'=>$image_path->image_path])}}" controls class="card-img-top"></video>
												
											@endif
											</div>
									@endforeach
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



@endsection