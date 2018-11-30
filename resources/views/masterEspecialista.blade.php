<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Servicio de Salud Sede de Occidente</title>
	<link href="https://revistas.ucr.ac.cr/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/paneles.css')}}">
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	
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
				<div class="tittle serif" style="color:#FFFFFF; margin-top:7px;" >Servicio de Salud Sede de Occidente</div>

			</div>

			<ul class="nav navbar-nav navbar-right hide-button" >
				 <li>
				 <!--data-toggle="dropdown"-->
                    <a href="{{ url('/logout') }}" class="dropdown-toggle logout-button"style="color:white" >
                         <strong>Salir&nbsp</strong><span class="glyphicon glyphicon-log-out" style="color:white"></span> 
                    </a>  
                </li>
        	</ul>

			<div id="sidebar-wrapper" class="sidebar-toggle sidebar">
				
				<ul class="sidebar-nav">
		    		<!--<li>
		      			<a class="border" href="{{ url('Especialista') }}" data-toggle="collapse">Citas<span class="glyphicon glyphicon-calendar right-citas"></span></a>
					</li>-->
					


					<li>
                        <a class="accordion-toggle collapsed toggle-switch border" style="margin-left:0px;" data-toggle="collapse" href="#submenu-3">
                            </i>
                            <span class="">Citas</span>
                            <b style="margin-left:72px;" class="caret"></b>
                        </a>
						<ul style="list-style:none; margin:0 0 0 0; padding:0 0 0 0;" id="submenu-3" class="panel-collapse collapse panel-switch" role="menu">
							<li><a class="border" href="{{ url('reservarCitaEsp') }}"><span><b class="caret-right"></b> Reservar&nbsp</span></a></li>
                            <li><a class="border" href="{{ url('Especialista') }}"><span><b class="caret-right"></b> Actuales&nbsp</span></a></li>
							<li><a class="border" href="{{ url('redirCitasAPartirHoy') }}"><span><b class="caret-right"></b> Futuras&nbsp&nbsp&nbsp</span></a></li>
							<li><a class="border" href="{{ url('redirCitasHistEsp') }}"><span><b class="caret-right"></b> Histórico</span></a></li>
                        </ul>
                    </li>
					<li>
		      			<a class="border" href="{{ route('pacientes.index') }}">Pacientes<span class="glyphicon glyphicon-search right-aling-glyphicon-paciente"></a>
		    		</li>
					
		    		<li>
		      			<a class="border" href="{{ route('Especialista.menuConfigHorarios') }}">Horario<span class="glyphicon glyphicon-time right-aling-glyphicon-h"></a>
		    		</li>
					<li>
						<a class="border" href="{{ url('contrasennaEspecialista') }}">Contraseña<span class="glyphicon glyphicon-lock right-aling-lock"></a>
				  	</li>
		    		<li class="hide-button-side">
		      			<a class="border" href="{{ url('/logout') }}">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-s"></a>
		    		</li>
		    		<li>	
      					<div class="logo-ucr-3"><img src="https://medios.ucr.ac.cr/medios/imagenes/2016/ucr.svg" style="width:120px; height:120px;"></div>
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
            <a style=" height: 50px" class="border-a active hide-title tittle-mobile serif" href="{{ url('Especialista') }}">Servicio de Salud Sede de Occidente</a>
      </div>

      <div id="myNavbar">
	    <!--<a class="border-a" href="{{ url('Especialista') }}">Citas<span class="glyphicon glyphicon-calendar right-citas"></span></a>-->
		<a class="border-a" href="{{ url('reservarCitaEsp') }}">Reservar<span class="glyphicon glyphicon-check right-aling-check"></span></a>
		<a class="border-a" href="{{ url('Especialista') }}">Citas Actuales<span class="glyphicon glyphicon-calendar right-aling-calendar"></span></a>
		<a class="border-a" href="{{ url('redirCitasAPartirHoy') }}">Citas Futuras<span class="glyphicon glyphicon-list-alt right-aling-alt"></span></a>
		<a class="border-a" href="{{ url('redirCitasHistEsp') }}"><span>Histórico de citas</span></a>
		<a class="border-a" href="{{ route('pacientes.index') }}">Pacientes<span class="glyphicon glyphicon-search right-aling-glyphicon-paciente"></a>
		<a class="border-a" href="#">Horario<span class="glyphicon glyphicon-time right-hora-e"></a>
      	<a class="border-a hide-button-exit" href="{{ url('/logout') }}"> Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-s"></a>
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
  	<div class="text-center main-footer"><strong>©2018</strong>
    	<a href="https://www.ucr.ac.cr/"><strong> Universidad de Costa Rica</strong></a><img style="margin-top: 4px;" class="margin-logo" src="{{asset('Imagenes/logo-so-blc.png')}}" >
  	</div>
	</footer>

	<script src="{{asset('js/menus_dinamicos.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/app.min.js')}}"></script>
	<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
</body>

</html>