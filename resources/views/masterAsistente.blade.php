<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Servicio de Salud Sede de Occidente</title>
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/menus.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/paneles.css')}}">
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://revistas.ucr.ac.cr/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="./css/base.css" rel="stylesheet">
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

	<script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>       
    <script id="_carbonads_projs" type="text/javascript" src="//srv.carbonads.net/ads/CK7DC5QN.json?segment=placement:eonasdangithubio&amp;callback=_carbonads_go"></script></head>
</head>
<!--body class="bg-color" onLoad="cargarCitas()" quitamos ese onload porque jodía todo el resto de cosas de asist-->
<body class="bg-color">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a id="menu-toggle" href="#" class="navbar-toggle" onclick="menu-toggle">
				<span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
				</a>
				<div><img class="img-responsive" style="margin-top: 10px; margin-left: 80px;" class="" src="{{asset('Imagenes/logo_nombre_ucr.png')}}" ></div>
			</div>

			<ul class="nav navbar-nav navbar-right hide-button" >
				 <li>
                    <a href="{{ url('/logout') }}" class="dropdown-toggle logout-button"style="color:white" >
                         <strong>Salir&nbsp</strong><span class="glyphicon glyphicon-log-out" style="color:white"></span> 
                    </a>  
                </li>
        	</ul>

			<div id="sidebar-wrapper" class="sidebar-toggle sidebar">
				<ul class="sidebar-nav">
					<li>
                        <a class="accordion-toggle collapsed toggle-switch border" style="margin-left:0px;" data-toggle="collapse" href="#submenu-3">
                            </i>
                            <span class="">Citas</span>
                            <b style="margin-left:72px;" class="caret"></b>
                        </a>
						<ul style="list-style:none; margin:0 0 0 0; padding:0 0 0 0;" id="submenu-3" class="panel-collapse collapse panel-switch" role="menu">
							<li><a class="border" href="{{ route('Asistente.crearCita') }}"><span><b class="caret-right"></b> Reservar&nbsp</span></a></li>
                            <li><a class="border" href="{{ url('asistente') }}"><span><b class="caret-right"></b> Actuales&nbsp</span></a></li>
							<li><a class="border" href="{{ url('redirCitasAPartirHoyAsist') }}"><span><b class="caret-right"></b> Futuras&nbsp&nbsp&nbsp</span></a></li>
							<li><a class="border" href="{{ url('redirCitasHistAsist') }}"><span><b class="caret-right"></b> Histórico</span></a></li>
                        </ul>
                    </li>
					<li>
		      			<a class="border" href="{{ route('pacientes.index') }}">Pacientes<span class="glyphicon glyphicon-search right-aling-glyphicon-paciente"></a>
		      		</li>
		    		<li>
		      			<a class="border" href="{{ route('Asistente.horarios') }}">Horarios<span class="glyphicon glyphicon-time right-aling-glyphicon"></a>
		    		</li>
		    		<li>
						<a class="border" href="{{ url('contrasennaAsistente') }}">Contraseña<span class="glyphicon glyphicon-lock right-aling-lock"></a>
				  	</li>
		    		<li class="hide-button-side">
		      			<a class="border" href="{{ url('/logout') }}">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-s"></a>
		    		</li>
		    		<li>	
      					<div class="logo-ucr-asistente"><img src="https://medios.ucr.ac.cr/medios/imagenes/2016/ucr.svg" style="width:120px; height:120px;"></div>
      				</li>    			
		  		</ul>
			</div>
  		</div>
	</nav>

	<div class="sidebar-mobile">       
      <div>      
        <button type="button" class="navbar-toggle collapsed border-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
        </button>
		<a style="height: 50px" class="border-a active hide-title tittle-mobile" href="admin"><img style="display: block; margin-left: auto; margin-right: auto;" class="img-responsive center logo-nombre" height="20" width="250"  src="{{asset('Imagenes/logo_nombre_ucr.png')}}" ></a>
      </div>

      <div id="myNavbar" class="collapse">
		<a class="border-a" href="{{ route('Asistente.crearCita') }}">Reservar<span class="glyphicon glyphicon-check right-aling-check"></span></a>
		<a class="border-a" href="{{ url('asistente') }}">Citas Actuales<span class="glyphicon glyphicon-calendar right-aling-calendar"></span></a>
		<a class="border-a" href="{{ url('redirCitasAPartirHoyAsist') }}">Citas Futuras<span class="glyphicon glyphicon-list-alt right-aling-alt"></span></a>
		<a class="border-a" href="{{ url('redirCitasHistAsist') }}"><span>Histórico de citas</span></a>
		<a class="border-a" href="{{ route('pacientes.index') }}">Pacientes<span class="glyphicon glyphicon-search right-aling-glyphicon-paciente"></a>
		<a class="border-a" href="{{ route('Asistente.horarios') }}">Horarios<span class="glyphicon glyphicon-time right-aling-glyphicon"></a>
		<a class="border-a" href="{{ url('contrasennaAsistente') }}">Contraseña<span class="glyphicon glyphicon-lock right-aling-lock"></a>
		<a class="border-a hide-button-exit" href="{{ url('/logout') }}">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-s"></a>
      </div>
    </div>

	<div class="panel-heading">
		<div class="content w3-container">
		
			@yield('contenido_Asistente')
			<div class="row center">
				<div class="">
					@include('flash::message')
		    	</div>
			</div>
		</div>
	</div>
	
    <footer class="main-footer">
  		<div class="text-center main-footer">
		  <a style="font-size:1em; color:#30A8D8;"><strong>Servicio de Salud</strong></a><img style="margin-top: 4px;" class="margin-logo" src="{{asset('Imagenes/logo-so-blc.png')}}" >
  		</div>
	</footer>

	<script src="{{asset('js/menus_dinamicos.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/app.min.js')}}"></script>
</body>
</html>