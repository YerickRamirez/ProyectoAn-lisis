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
	<h3>Cita reservada exitosamente</h3>
    <p>Estimado/a {{$name}},</p>
    <p>El Servicio de Salud universitaria le comunica que su cita para el día  {{$fecha}} a la hora {{$hora}} ha sido reservada exitosamente,</p>
    <p>¡Muchas gracias!</p>
    <br>
    <br>
</div>
</body>
</html>