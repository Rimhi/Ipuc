<!DOCTYPE html>
<html>
<head>
	<title>Bienvenido</title>
</head>
<body>
	 <div class="jumbotron">
	  	<img src="{{asset('images/logoMocari.jpeg')}}">
	  <h1 class="display-4">Bienvenido sr(a): {{$datos['nombre'].' '.$datos['apellido']}}</h1>
	  <p class="lead">La Iglesia Pentecostal Unida de Colombia en Mocari te da la bienvenida</p>
	  <hr class="my-4">
	  <p>te haz registrado con exito, si haces parte de un comité y aun no tienes acceso a el, por favor comunicate con el secretario de la junta local.</p>
	  <p>aqui te recordamos tu contraseña {{$datos['pass']}}</p>
	  <p>esperamos que tu estancia aqui sea de bendicion para nosotros y de igual forma, de bendicion para ti</p>
	  <p class="lead">
	    <a class="btn btn-primary btn-lg" href="https://ipucmocari.tk" role="button">Acceder a la pagina de Ipuc Mocari</a>
	  </p>
	  <p>Soporte Ipuc Mocari: soporte.ipucmocari@gmail.com</p>
	  <p>Por favor no responder a este mensaje</p>
	</div>

</body>
</html>