
function recintos(){
        $('#dropRecintos').empty();
        $('#dropRecintos').append("<option>Cargando...</option>");
        $('#dropServicios').append("<option value='defecto'>Seleccione Servicio</option>");

         $.ajax({
  url: '/recintosCombo',
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
$('#dropRecintos').empty();
$('#dropRecintos').append("<option value='defecto'>Seleccione Recinto</option>");   
$.each(datos, function()
{
        $.each(this, function(){//los datos del server vienen en una variable data
        //si quieren ver esos datos pongan en la URL "/recintosCombo" por ejemplo.
        $('#dropRecintos').append('<option value="' + this.id + '">' + this.descripcion + '</option>');
        })        
})

}, error:function() {
        alert("¡Ha habido un error! Elija correctamente su recinto." +
        "Si este error persiste por favor comuníquese con el Servicio de Salud");  
}
});
}

function servicios(ID_Recinto){
            $('#dropServicios').empty();
            $('#dropServicios').append("<option>Cargando...<option>");
                $.ajax({
  url: '/serviciosCombo/' + ID_Recinto,
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
$('#dropServicios').empty();
$('#dropServicios').append("<option value='defecto'>Seleccione Servicio</option>");   
$.each(datos, function()
{
        $.each(this, function(){
        $('#dropServicios').append('<option value="' + this.id + '">' + this.nombre + '</option>');
        }) 
}) 

}, error:function() {
        $('#dropServicios').empty();
        $('#dropServicios').append("<option value='defecto'>Seleccione Servicio</option>");   
        alert("¡Ha habido un error! Si este persiste por favor comuníquese con el Servicio de Salud");
}
}); //fin ajax
}//fin servicios 

$(document).ready(function() {
        recintos();
        $('#dropRecintos').change(function() {
        ocultarUnaTabla();
        var ID_Recinto = $('#dropRecintos').val();
        if(ID_Recinto != 'defecto'){
        servicios(ID_Recinto);   
        
        }else{
        limpiarDrop("dropServicios", "Servicio")
        }
        })
        
        $('#dropServicios').change(function() {
        ocultarUnaTabla();
        var ID_Servicio = $('#dropServicios').val();
        var ID_Recinto = $('#dropRecintos').val();
        
        })


       
})

function limpiarDrop(nombreDrop, nombreTexto) {
   $('#' + nombreDrop).empty();
   $('#' + nombreDrop).append("<option value='defecto'>Seleccione " + nombreTexto+ "</option>");   
}


function revisarHorario() {
        var recinto = $('#dropRecintos').val();
        var servicio = $('#dropServicios').val();

        var recintoSeleccionado = document.getElementById("dropRecintos");
        var recintoTxt = recintoSeleccionado.options[recintoSeleccionado.selectedIndex].text;
        var servicioSeleccionado = document.getElementById("dropServicios");
        var servicioTxt = servicioSeleccionado.options[servicioSeleccionado.selectedIndex].text;
        $.ajax({url: '/verificarHorarioServicioEspecialista/' + recinto + "/" + servicio, type: 'GET', dataType: "json",
        success:function(datos){ 
            //$hola = JSON.stringify(datos);
            //alert($hola + " jajaja");
            cargarCheckBox(datos);
            var y = document.getElementById("info");
            var tabla = document.getElementById("ocultar-tabla");
            
            y.innerHTML = "Horario para el servicio " + servicioTxt + " en el recinto de " + recintoTxt + "";
            if (tabla.style.display === "none") {
                        y.style.display ="block";
                tabla.style.display = "block";
            }

        }, error:function() {
        alert("Ha habido un error verificando la existencia de horarios. Si este persiste comuníquese" +
        " con el Servicio de Salud");   
        },
        timeout: 15000
        });      
    }

    function cargarCheckBox(datos) {
            limpiarCheckBox();
        var cuenta = 1;
        $.each(datos, function() {
            $.each(this, function(){
                var checkbox = document.getElementById(cuenta);
                checkbox.checked=this.disponibilidad_manana; 
                cuenta = cuenta + 1;
                var checkbox = document.getElementById(cuenta);
                checkbox.checked=this.disponibilidad_tarde;
                cuenta = cuenta + 1;
            }) 

        });
    }

    function limpiarCheckBox() {
        for (i = 0; i <= 10; i++) {
                if(document.getElementById(i) != undefined && document.getElementById(i) != null){
                        document.getElementById(i).checked = 0;
                }
            }
    }