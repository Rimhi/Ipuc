@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1>Mis favoritos</h1>

            @foreach($likes as $like)
          
                <div class="card-header"><a class="btn btn-sm " href="{{route('image.show',$like->image->id)}}">{{$like->image->description}}</a>
                <p class="fecha-favoritos">{{\FormatTime::LongTimeFilter($like->created_at)}}</p>
                </div>
        
            

            @endforeach
        </div>
    </div>
</div>
@endsection
