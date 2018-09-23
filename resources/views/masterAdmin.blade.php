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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
				
				<!--
				<ul>
				<a class="navbar-brand" style="color:#FFFFFF" href="#">Oficina de Binestar y Salud</a></ul>-->
				
				
				<div class="margin-left-title example" style="color:#FFFFFF"><font FACE="small fonts"></font>Oficina de Bienestar y Salud</div>
						    				
			</div>
		<ul class="nav navbar-nav navbar-right" >
				 <li class="dropdown" >
                    <a href="#" class="dropdown-toggle"style="color:white" data-toggle="dropdown">
                         <strong>Salir&nbsp</strong><span class="glyphicon glyphicon-log-out" style="color:white"></span> 
                       
                        <!--<span class="glyphicon glyphicon-chevron-down right"></span>-->
                    </a>
                   
                </li>
            </ul>

			<div id="sidebar-wrapper" class="sidebar-toggle sidebar">
				<ul class="sidebar-nav">

		    		<li>
		      			<a style="font-size:15px;" class="border" href="prueba">Inicio&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-home"></span></a>
		    		</li>
		    		<li>
		      			<a style="font-size:15px;" class="border" href="">Perfil&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-user"></a>
		    		</li>
		    		<li>
		      			<a style="font-size:15px;" class="border" href="#item3">Configuración&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="glyphicon glyphicon glyphicon-wrench"></a>
		    		</li>
		    		<li>
		      			<a style="font-size:15px;" class="border" href="#item3">Menú 4&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-paperclip"></a>
		    		</li>
		    		<li>
		      			<a  style="font-size:15px;"class="border" href="#item3">Menú 5&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-check"></a>
		    		</li>
		    		<li>
		      			<a style="font-size:15px;" class="border" href="#item3">Salir&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-log-out"></a>
		    		</li>
      			<div class="logo-ucr"><img src="https://medios.ucr.ac.cr/medios/imagenes/2016/ucr.svg" style="width:140px; height:140px;"></div>
		  		</ul>
			</div>
  		</div>
	</nav>


	<div class="panel-heading">
		<div class="content">
  			<h2>Example</h2>
  			<h4 class="lead">Lorem ipsum dolor sit amet consectetur adipiscing elit velit pharetra, taciti orci neque proin accumsan tempor libero eu aliquet tellus, laoreet morbi mauris eleifend pretium iaculis parturient porta. A nascetur metus vivamus aptent interdum curabitur inceptos ultricies, venenatis faucibus turpis ornare conubia hac hendrerit euismod vestibulum, parturient phasellus mollis convallis molestie blandit integer. Cras varius cubilia suscipit gravida velit accumsan aliquet vel quisque turpis, nec imperdiet dictumst eu nisl lobortis mattis pretium mus class, faucibus dapibus proin praesent leo augue id tempus urna.

			Augue tellus lacus mollis tristique lacinia duis, suspendisse congue parturient conubia massa volutpat donec, quam cum velit mi feugiat. Turpis erat urna viverra litora sodales laoreet, fermentum vitae mattis quis mauris dictumst, vestibulum sed ligula risus feugiat. Eleifend integer nostra mauris porta morbi luctus bibendum phasellus tempor aptent faucibus diam sodales, nam sapien platea ultrices lobortis maecenas nunc at neque conubia habitasse imperdiet.
  			</h4>
  			
  			<p>We have also added a media query for screens that are 400px or less, which will vertically stack and center the navigation links.</p>
  			<h3>Resize the browser window to see the effect.</h3>
		</div>
	</div>

	
	
	<footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <p class="">Copyright &copy; 2018 <a href="https://www.ucr.ac.cr/">Universidad de Costa Rica</a>.</p> 
    </footer>




	<!--
<footer class="cent">
  <img src="https://image.winudf.com/v2/image/Y3IuYWMudWNyLnRyYW5zcG9ydGVzbW9iaWxlX2ljb25fMTUwNjIwNDQ3N18wMzc/icon.png?w=170&fakeurl=1&type=.png" height="80"></img>
</footer>-->
	


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