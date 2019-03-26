@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
         <div class="row">
            <div class="col-md-6">
                <div class="card-header">Iglesia Pentescotal Unida de Colombia en Mocari, Monteria (Córdoba)</div>
                <div class="card bg-dark text-white">
                    <img src="{{asset('images/ipucmocari.jpeg')}}" class="card-img">            
                </div>
            </div>
       
            <div class="col-md-4">
                <div class="card-header">Contáctanos</div>
                <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 8.8057519, lng: -75.8543931},
          zoom: 22
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvzqMe6oFGiObPaDcgFtXxSL9Yw0Q4nt0&callback=initMap"
    async defer></script>
            </div>
        </div>
    </div>
</div>
@endsection
