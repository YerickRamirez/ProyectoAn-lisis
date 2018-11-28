<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>
<div>
	<p>Hola {{$nombre}}, el servicio de salud universitaria recibió una petición para cambiar la contraseña asociada a esta cuenta de correo electrónico.</p>
    <p>Se ha creado una nueva contraseña temporal con la cual podrá ingresar al sistema para crear una nueva.</p>
    <p>Su contraseña nueva es:</p>
    <h3 style="text-align:center;">{{$random}}</h3>
    
    
    <br>
    <br>
</div>
</body>
</html>