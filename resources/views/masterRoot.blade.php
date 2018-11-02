<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Administrador Servicio de Salud</title>
	@yield('encabezado')
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/menus.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link href="./css/base.css" rel="stylesheet">
        <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
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
		      			<a class="border" href="admin">Inicio<span class="glyphicon glyphicon-home right-aling-glyphicon-i"></span></a>
		    		</li>
		    		<li>
		      			<a class="border" href="cuentas">Cuentas<span class="glyphicon glyphicon-user right-aling-glyphicon"></a>
		    		</li>
		    		<li>
		      			<a class="border" href="horarios">Horarios<span class="glyphicon glyphicon glyphicon-wrench right-aling-glyphicon"></a>
		    		</li>
		    		<li>
		      			<a class="border" href="{{ route('servicios.index') }}">Servicios<span class="glyphicon glyphicon-list-alt right-aling-glyphicon-se"></a>
		    		</li>
		    		<li>
		      			<a class="border" href="{{asset('recintos')}}">Recintos<span class="glyphicon glyphicon-flag right-aling-glyphicon"></a>
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
            <a style="font-size:22px; height: 50px" class="border-a active hide-title tittle serif" href="admin">Servicio de Salud</a>
      </div>

      <div id="myNavbar">
	    <a class="border-a" href="admin">Inicio<span class="glyphicon glyphicon-home right-aling-glyphicon-i"></span></a>
		<a class="border-a" href="cuentas">Cuentas<span class="glyphicon glyphicon-user right-aling-glyphicon"></a>
		<a class="border-a" href="horarios">Horarios<span class="glyphicon glyphicon glyphicon-wrench right-aling-glyphicon"></a>
		<a class="border-a" href="servicios">Servicios<span class="glyphicon glyphicon-list-alt right-aling-glyphicon-se"></a>
		<a class="border-a" href="recintos">Recintos<span class="glyphicon glyphicon-flag right-aling-glyphicon"></a>
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
		
			@yield('contenido_Admin')
			<div class="row center">
				<div class="">
					@include('flash::message')
		    	</div>
			</div>
		</div>
	</div>
	
	
    <footer class="main-footer">
  	<div class="text-center main-footer"><strong>©2018 Copyright:</strong>
    	<a href="https://mdbootstrap.com/bootstrap-tutorial/"><strong> Universidad de Costa Rica</strong></a><img style="margin-top: 4px;" class="margin-logo" src="{{asset('Imagenes/logo-so-blc.png')}}" >
  	</div>
	</footer>

	<script src="{{asset('js/menus_dinamicos.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
</body>

</html>