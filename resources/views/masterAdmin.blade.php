<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Oficina de Salud y Bienestar</title>

	
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	

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
				<div class="tittle serif" style="color:#FFFFFF; margin-top:7px;" > Servicio de Salud</div>

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
		      			<a style="font-size:15px;" class="border" href="prueba">Inicio<span class="glyphicon glyphicon-home right-aling-glyphicon"></span></a>
		    		</li>
		    		<li>
		      			<a style="font-size:15px;" class="border" href="">Perfil<span class="glyphicon glyphicon-user right-aling-glyphicon"></a>
		    		</li>
		    		<li>
		      			<a style="font-size:15px;" class="border" href="#item3">Configuración<span class="glyphicon glyphicon glyphicon-wrench right-aling-glyphicon-c"></a>
		    		</li>
		    		<li>
		      			<a style="font-size:15px;" class="border" href="paciente">Paciente<span class="glyphicon glyphicon-paperclip right-aling-glyphicon-p"></a>
		    		</li>
		    		<li>
		      			<a  style="font-size:15px;"class="border" href="#item3">Menú 5<span class="glyphicon glyphicon-check right-aling-glyphicon-m"></a>
		    		</li>
		    		<li class="hide-button-side">
		      			<a style="font-size:15px;" class="border" href="#item3">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon"></a>
		    		</li>
		    		<li>	
      					<div class="logo-ucr"><img src="https://medios.ucr.ac.cr/medios/imagenes/2016/ucr.svg" style="width:140px; height:140px;"></div>
      				</li>    			
		  		</ul>
			</div>
  		</div>
	</nav>
	@if (Route::has('login'))
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

	<div class="panel-heading">
		<div class="content w3-container">
			<!--
  			<h2>Example</h2>
  			<h4 class="lead">Lorem ipsum dolor sit amet consectetur adipiscing elit velit pharetra, taciti orci neque proin accumsan tempor libero eu aliquet tellus, laoreet morbi mauris eleifend pretium iaculis parturient porta. A nascetur metus vivamus aptent interdum curabitur inceptos ultricies, venenatis faucibus turpis ornare conubia hac hendrerit euismod vestibulum, parturient phasellus mollis convallis molestie blandit integer. Cras varius cubilia suscipit gravida velit accumsan aliquet vel quisque turpis, nec imperdiet dictumst eu nisl lobortis mattis pretium mus class, faucibus dapibus proin praesent leo augue id tempus urna.

			Augue tellus lacus mollis tristique lacinia duis, suspendisse congue parturient conubia massa volutpat donec, quam cum velit mi feugiat. Turpis erat urna viverra litora sodales laoreet, fermentum vitae mattis quis mauris dictumst, vestibulum sed ligula risus feugiat. Eleifend integer nostra mauris porta morbi luctus bibendum phasellus tempor aptent faucibus diam sodales, nam sapien platea ultrices lobortis maecenas nunc at neque conubia habitasse imperdiet.
  			</h4>
  			
  			<p>We have also added a media query for screens that are 400px or less, which will vertically stack and center the navigation links.</p>
  			<h3>Resize the browser window to see the effect.</h3>
  			-->
		</div>
	</div>

	@yield('contenido')
	<div class="content w3-container">

	
	<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					@include('flash::message')
		    </div>
	</div>

</div>
	
	<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
    <footer class="main-footer">
  	<div class="text-center main-footer"><strong>©2018 Copyright:</strong>
    	<a href="https://mdbootstrap.com/bootstrap-tutorial/"><strong> Universidad de Costa Rica</strong></a><img style="margin-top: 4px;" class="margin-logo" src="{{asset('Imagenes/logo-so-blc.png')}}" >
  	</div>
	</footer>
</div>


	<script type="text/javascript">
	$(window).resize(function() {
		var path = $(this);
		var contW = path.width();
		if(contW >= 751){
			document.getElementsByClassName("sidebar-toggle")[0].style.left="200px";
		}else{
		document.getElementsByClassName("sidebar-toggle")[0].style.left="-200px";
		}
	});
	$(document).ready(function() {
		$('.dropdown').on('show.bs.dropdown', function(e){
	    	$(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
		});
		$('.dropdown').on('hide.bs.dropdown', function(e){
			$(this).find('.dropdown-menu').first().stop(true, true).slideUp(300);
		});
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			var elem = document.getElementById("sidebar-wrapper");
			left = window.getComputedStyle(elem,null).getPropertyValue("left");
			if(left == "200px"){
				document.getElementsByClassName("sidebar-toggle")[0].style.left="-200px";
			}
			else if(left == "-200px"){
				document.getElementsByClassName("sidebar-toggle")[0].style.left="200px";
			}
		});

		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			var elem = document.getElementById("sidebar-wrapper");
			left = window.getComputedStyle(elem,null).getPropertyValue("left");
			if(left == "200px"){
				document.getElementsByClassName("sidebar-toggle")[0].style.left="-200px";
			}
			else if(left == "-230px"){
				document.getElementsByClassName("sidebar-toggle")[0].style.left="200px";
			}
		});

	});
	</script>

	<script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
</body>

</html>