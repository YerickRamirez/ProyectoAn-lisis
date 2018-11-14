<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Servicio de Salud</title>

	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
	</script>
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
				<div class="tittle serif" style="color:#FFFFFF; margin-top:7px;" > Servicio de Salud</div>

			</div>

			<ul class="nav navbar-nav navbar-right hide-button" >
				 <li>
				 <!--
				 <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					-->
					<li class="dropdown logout-button">
                                
					<a href="{{ url('/logout') }}"> <!--logout </a>-->
                         <strong>Salir&nbsp</strong><span class="glyphicon glyphicon-log-out" style="color:white"></span> 
                    </a>  
					
                </li>
        	</ul>

			<div id="sidebar-wrapper" class="sidebar-toggle sidebar">
				
				<ul class="sidebar-nav">
		    		<li>
		      			<a class="border menu-options" href="paciente">Inicio<span class="glyphicon glyphicon-home right-aling-glyphicon"></span></a>
		    		</li>
		    		<li>
		      			<a class="border" href="">Perfil<span class="glyphicon glyphicon-user right-aling-glyphicon"></a>
		    		</li>
		    		<li>
		      			<a class="border" href="configuracion">Configuración<span class="glyphicon glyphicon glyphicon-wrench right-aling-glyphicon-c"></a>
		    		</li>
		    		<li>
		      			<a class="border" href="citas">Citas<span class="glyphicon glyphicon-paperclip right-aling-glyphicon-p"></a>
		    		</li>
		    		<li class="hide-button-side">
			
	      			 <a style="font-size:15px;" class="border" href="{{ url('/logout') }}">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon"></a>
		    				
					</li>
		    		<li>	
      					<div class="logo-ucr"><img src="https://medios.ucr.ac.cr/medios/imagenes/2016/ucr.svg" style="width:140px; height:140px;"></div>
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
      	<a class="border-a" href="prueba">Inicio</a>
      	<a class="border-a" href="prueba">Perfil</a>
      	<a class="border-a" href="prueba">Citas</a>
      	<a class="border-a" href="prueba">Especialistas</a>
      	<a class="border-a hide-button-exit" href="#item3">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-s"></a>
      </div>
    </div>


	<div class="panel-heading">
		<div class="content w3-container">
			@yield('contenido')
			@include('flash::message')
		</div>
	</div>

	
	
	
	<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
    <footer class="main-footer">
  	<div class="text-center main-footer"><strong>©2018 Copyright:</strong>
    	<a href="https://www.ucr.ac.cr/"><strong> Universidad de Costa Rica</strong></a><img style="margin-top: 4px;" class="margin-logo" src="{{asset('Imagenes/logo-so-blc.png')}}" >
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