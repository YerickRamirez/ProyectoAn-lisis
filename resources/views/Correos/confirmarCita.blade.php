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
<p>Estimado(a) {{$name}}.</p>
    <p>El Servicio de Salud, Sede de Occidente de la Universidad de Costa Rica le informa que su cita para las {{$hora}} del día {{$fecha}} ha sido confirmada, 
    con el/la especialista {{$especialista}}, del recinto de {{$recinto}}.</p>
    <p>Le recordamos que debe de apersonarse de manera puntual. Por razones operativas, posterior a cinco minutos de la hora establecida su cita deberá reprogramarse según disponibilidad de horario.</p>
    <br>
    <br>
</div>
</body>
</html>