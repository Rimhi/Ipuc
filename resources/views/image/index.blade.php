@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<section class="main">

				<div class="baraja-demo">
					<ul id="baraja-el" class="baraja-container">
						<li><img src="{{asset('images/ipucmocari.jpeg')}}" alt="image1"/><h4>Ipuc Mocari</h4><p>Iglesia pentecostal unida de colombia, Mocari Monteria (Cordoba)</p></li>
						<li><img src="{{asset('images/ipucmocari.jpeg')}}" alt="image1"/><h4>Ipuc Mocari</h4><p>Iglesia pentecostal unida de colombia, Mocari Monteria (Cordoba)</p></li>
						
					</ul>
				</div>
				
			</section>
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
							<p style="float: right;">finaliza: {{$image->fecha_fin}}</p>
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
@section('js')
 	<script type="text/javascript" src="{{asset('js/jquery.baraja.js')}}"></script>
	<script type="text/javascript">	
			$(function() {

				var $el = $( '#baraja-el' ),
					baraja = $el.baraja();

				// navigation
				$( '#nav-prev' ).on( 'click', function( event ) {

					baraja.previous();
				
				} );

				$( '#nav-next' ).on( 'click', function( event ) {

					baraja.next();
				
				} );

				// simple fan
				$( '#nav-fan' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'right',
						origin : { x : 25, y : 100 },
						center : true
					} );
				
				} );

				$( '#nav-fan2' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'left',
						// note that the x origin changes (symmetric)
						origin : { x : 75, y : 100 },
						center : true
					} );
				
				} );

				// more realistic fan: without common origin (means the origin changes / increments by card )
				$( '#nav-fan3' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'right',
						origin : { minX : 20, maxX : 80, y : 100 },
						center : true,
						translation : 60
					} );
				
				} );

				$( '#nav-fan4' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'left',
						origin : { minX : 20, maxX : 80, y : 100 },
						center : true,
						translation : 60
					} );
				
				} );

				// playing with different origins and ranges	
				$( '#nav-fan5' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 100,
						direction : 'right',
						origin : { x : 50, y : 200 },
						center : true
					} );
				
				} );

				$( '#nav-fan6' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 80,
						direction : 'left',
						origin : { x : 200, y : 50 },
						center : true
					} );
				
				} );

				// center false, playing with translation
				$( '#nav-fan7' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 20,
						direction : 'right',
						origin : { x : 50, y : 200 },
						center : false,
						translation : 300
					} );
				
				} );

				$( '#nav-fan8' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 20,
						direction : 'left',
						origin : { x : 50, y : 200 },
						center : false,
						translation : 300
					} );
				
				} );

				// using scatter : true
				$( '#nav-fan9' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 20,
						direction : 'right',
						origin : { x : 50, y : 200 },
						center : false,
						translation : 300,
						scatter : true
					} );
				
				} );

				$( '#nav-fan10' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 20,
						direction : 'left',
						origin : { x : 50, y : 200 },
						center : false,
						translation : 300,
						scatter : true
					} );
				
				} );

				$( '#nav-fanOther1' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 130,
						direction : 'left',
						origin : { x : 25, y : 100 },
						center : false
					} );
				
				} );

				$( '#nav-fanOther2' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 360,
						direction : 'left',
						origin : { x : 50, y : 90 },
						center : false
					} );
				
				} );

				$( '#nav-fanOther3' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 330,
						direction : 'left',
						origin : { x : 50, y : 100 },
						center : true
					} );
				
				} );

				$( '#nav-fanOther4' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'right',
						origin : { minX : 20, maxX : 80, y : 100 },
						center : true,
						translation : 60,
						scatter : true
					} );
				
				});
		});
				
	</script>
@endsection