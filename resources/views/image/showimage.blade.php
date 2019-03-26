@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
					<div class="card pub_image">
						<div class="card-header">
							<?php
								$extencion = explode('.',$image_path->image_path);
							?>
							@if('mp4' !=end($extencion))
									<img src="{{route('image.avatar',['filename'=>$image_path->image_path])}}" class="card-img-top">
							@else
								
									<video src="{{route('image.avatar',['filename'=>$image_path->image_path])}}" class="card-img-top" controls></video>
								
							@endif
						</div>
					</div>
			</div>
		</div>
	</div>
@endsection