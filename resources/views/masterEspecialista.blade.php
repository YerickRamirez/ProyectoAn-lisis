<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Servicio de Salud</title>
	<link href="https://revistas.ucr.ac.cr/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./css/base.css" rel="stylesheet">
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

	<script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
        
        
    <script id="_carbonads_projs" type="text/javascript" src="//srv.carbonads.net/ads/CK7DC5QN.json?segment=placement:eonasdangithubio&amp;callback=_carbonads_go"></script></head>


</head>
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
				<div class="tittle serif" style="color:#FFFFFF; margin-top:7px;" >Servicio de Salud</div>

			</div>

			<ul class="nav navbar-nav navbar-right hide-button" >
				 <li>
                    <a href="#" class="dropdown-toggle logout-button"style="color:white" data-toggle="dropdown">
                         <strong>Salir&nbsp</strong><span class="glyphicon glyphicon-log-out" style="color:white"></span> 
                    </a>  
                </li>
        	</ul>

			<div id="sidebar-wrapper" class="sidebar-toggle sidebar">
				
				<ul class="sidebar-nav">
		    		<li>
		      			<a class="border" href="paciente">Inicio<span class="glyphicon glyphicon-home right-aling-glyphicon-i"></span></a>
					</li>
					<li>
		      			<a class="border" href="citas">Pacientes<span class="glyphicon glyphicon-th-list right-pacientes"></a>
		    		</li>
		    		<li>
		      			<a class="border" href="citas">Citas<span class="glyphicon glyphicon-calendar right-citas"></a>
		    		</li>
		    		<li>
		      			<a class="border" href="perfil">Perfil<span class="glyphicon glyphicon-user right-perfil"></a>
		    		</li>
		    		<li>
		      			<a class="border" href="">Horario<span class="glyphicon glyphicon glyphicon-time right-hora"></a>
		    		</li>
		    		<li class="hide-button-side">
		      			<a class="border" href="#item3">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-s"></a>
		    		</li>
		    		<li>	
      					<div class="logo-ucr"><img src="https://medios.ucr.ac.cr/medios/imagenes/2016/ucr.svg" style="width:120px; height:120px;"></div>
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
            <a style="font-size:22px; height: 50px" class="border-a active hide-title tittle serif" href="prueba">Servicio de Salud</a>
      </div>

      <div id="myNavbar">
	    <a class="border-a" href="#">Inicio<span class="glyphicon glyphicon-home right-aling-glyphicon-i"></span></a>
		<a class="border-a" href="#">Pacientes<span class="glyphicon glyphicon-th-list right-pacientes"></a>
		<a class="border-a" href="#">Citas<span class="glyphicon glyphicon-calendar right-citas"></a>
		<a class="border-a" href="#">Perfil<span class="glyphicon glyphicon-user right-perfil"></a>
		<a class="border-a" href="#">Horario<span class="glyphicon glyphicon-time right-hora"></a>
      	<a class="border-a hide-button-exit" href="#item3">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-s"></a>
      </div>
    </div>
<!--	@if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Request::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            -->

	<div class="panel-heading">
		<div class="content w3-container">
			@yield('contenido_Especialista')
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					@include('flash::message')
		    	</div>
			</div>
		</div>
	</div>

	
	<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
    <footer class="main-footer">
  	<div class="text-center main-footer"><strong>©2018 Copyright:</strong>
    	<a href="https://mdbootstrap.com/bootstrap-tutorial/"><strong> Universidad de Costa Rica</strong></a><img style="margin-top: 4px;" class="margin-logo" src="{{asset('Imagenes/logo-so-blc.png')}}" >
  	</div>
	</footer>

	<script src="{{asset('js/menus_dinamicos.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/app.min.js')}}"></script>
</body>

</html>