$(document).ready(function(){
   
    $(".agregar").click(function(){
        $("input.nombre").show();
        $("button.show").show();
    });
});



function myFunction() {
	var x = document.getElementById("myDIV");
	var y = document.getElementById("mybutton");
	var button = document.getElementById("mybutton");
	
    if (x.style.display === "none") {
		y.style.display ="none";
        x.style.display = "block";
        boton.setBackgroundColor(0xFF00FF00);
    } else {

        x.style.display = "none";
    }
}

function mostarHorario() {
	var x = document.getElementById("ocultar-tabla");
	var y = document.getElementById("mostar-tabla");
	//var button = document.getElementById("mostar-tabla");
	
    if (x.style.display === "none") {
		//y.style.display ="none";
        x.style.display = "block";
    }
}

function ocultarHorario() {
	var x = document.getElementById("ocultar-tabla");
	//var y = document.getElementById("info");
	
	//var button = document.getElementById("mostar-tabla");
	x.style.display = "none";
	//y.style.display = "none";
}


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

	function mostarHorarioServicio() {
		var x = document.getElementById("ocultar-tabla");
		var y = document.getElementById("mostar-tabla");
		//var button = document.getElementById("mostar-tabla");
		
		if (x.style.display === "none") {
			//y.style.display ="none";
			x.style.display = "block";
		}
	}

	