@extends ('masterRoot')
@section ('contenido_Admin')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<div class="panel panel-primary">
        <div class="panel-heading">
           <p style="text-align: center; font-size: 3vh;">Configuración de recintos</p>
       </div>
       <div class="panel-body">
<script>
function dropDiasBloqueo(){
        $('#dropDiasBloqueo').empty();
        $('#dropDiasBloqueo').append("<option>Cargando...</option>");

         $.ajax({
  url: '/dropDiasBloqueo',
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
$('#dropDiasBloqueo').empty();
$('#dropDiasBloqueo').append("<option value='defecto'>----Seleccione Día----</option>");   
$.each(datos, function()
{
        $.each(this, function(){//los datos del server vienen en una variable data
        //si quieren ver esos datos pongan en la URL "/recintosCombo" por ejemplo.
        $('#dropDiasBloqueo').append('<option value="' + this.id + '">' + this.dia + '</option>');
        })        
})

}, error:function() {
        alert("¡Ha habido un error! Elija correctamente el día.");
}
});
}

$(document).ready(function() {



$('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 20,
    minTime: '08',
    maxTime: '5:00pm',
    defaultTime: '8',
    startTime: '08:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});

    dropDiasBloqueo();
        
})

function limpiarDrop(nombreDrop, nombreTexto) {
   $('#' + nombreDrop).empty();
   $('#' + nombreDrop).append("<option value='defecto'>----Seleccione " + nombreTexto+ "----</option>");   
}

</script>

<script>
function revisarDisponibilidad() {
    var x = $('#timeInicio').val();
    alert(x);}
    /*
        var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
        //var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
                var datepicked = new Date(dateTime);
                datepicked.setHours(datepicked.getHours() -6);
                datepicked = datepicked.toISOString();
                //alert(datepicked);
                //alert("Fecha elegida: " + datepicked);
                var dropRecintos = $('#dropRecintos').val();           
                //alert(dropRecintos);
                var dropServicios = $('#dropServicios').val();           
                //alert(dropServicios);
                var dropEspecialistas = $('#dropEspecialistas').val();           
                //alert(dropEspecialistas);
                if (dropRecintos == 'defecto' || dropServicios == 'defecto' ||
                 dropEspecialistas == 'defecto') {
                        alert("Elija una opción válida en todos los campos");
               } else {
                $.ajax({
  url: '/verificarCitas/' + dropRecintos + '/' + dropServicios + '/' + dropEspecialistas + '/' 
  + datepicked,
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
    //alert(datos + " jajaja");
    //alert(datos.horasOcupadas);
        cargarFechasDisponibles(datos.horasOcupadas);
}, error:function() {
     alert("Ha habido un error verificando la existencia de citas. Si este persiste comuníquese" +
     " con el Servicio de Salud");   
},
timeout: 15000
}); 
}}*/
</script>


<!-- sdfghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh-->
<div class="container">

        <div class="row">
                
                <div style="margin-bottom: 15px;" class="col-sm-3">
                        <h4>Día<h4> 
                    <select id="dropDiasBloqueo" class="form-control"></select>
                </div>

            <div class='col-sm-3'>
                    <h4>Fecha Inicio<h4>
                <div class="form-group">
                    <div class='input-group date' id='datetimepickerInicio'>
                        <input type='text' class="form-control" onchange="prueba()" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class='col-sm-3'>
                    <h4>Fecha Fin<h4>
            <div class='input-group date' id='datetimepickerFin'>
                <input type='text' class="form-control" onchange="prueba()" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
                    <script type="text/javascript">
                $(function () {
                    var momento = new Date();
                    console.log("Actual parseada: " + momento);
        $('#datetimepickerInicio').datetimepicker({
            minDate: momento, //Muestra el calendario desde el dia actual y no desde antes
            format: 'DD/MM/YYYY', //Hay que ponerle un formato a la fecha, si no se pone esto se establecen con horas
            daysOfWeekDisabled:[0,6], //Asi se bloquean los fines de semana
            //disabledDates: ["10/24/2018"] //Lista de fechas que bloquear. 
            disabledDates: [] //Lista de fechas que bloquear. 
        }).on('dp.change', function prueba() {
            });
    });

    $(function () {
                    var momento = new Date();
        $('#datetimepickerFin').datetimepicker({
            minDate: momento, //Muestra el calendario desde el dia actual y no desde antes
            format: 'DD/MM/YYYY', //Hay que ponerle un formato a la fecha, si no se pone esto se establecen con horas
            daysOfWeekDisabled:[0,6], //Asi se bloquean los fines de semana
            //disabledDates: ["10/24/2018"] //Lista de fechas que bloquear. 
            disabledDates: [] //Lista de fechas que bloquear. 
        }).on('dp.change', function prueba() {
            });
    });
            </script>
        </div>
        <div class="row">
                <div class='col-sm-3'>
                </div>
                <div class='col-sm-3'>
                 <h4>Hora Inicio<h4>
        <input class="timepicker" id="timeInicio">
    </div>
    <div class='col-sm-3 offset-sm-2'>
            <h4>Hora Fin<h4>
   <input class="timepicker" id="timeInicio">
</div>
    </div>
    
    <div class="row">
            <div class='col-sm-3 offset-sm-2'>
    <button style="text-align:center"    class = 'margin-button-agregar btn btn-success mobile' 
    onclick="revisarDisponibilidad()">Agregar bloqueo</button>
            </div>
    </div>

    <!-- /////////////////////////////////////////////////////////////////////////// -->
    

<script>
        function confirmarCita(hora , minutos) {
            var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
            var datepicked = new Date(dateTime);
            datepicked = datepicked.toLocaleDateString();
               // alert("Fecha elegida: " + datepicked);
               minutos = String(minutos);
               if(minutos == "0") {
                   minutos = "00";
               }
        if (confirm("¿Desea una cita a la hora " + String(hora) + ":" + minutos + " en la fecha " + datepicked + "?")) {
            var datepicked = new Date(dateTime);
                datepicked = datepicked.toISOString();
                var dropRecintos = $('#dropRecintos').val();           
                var dropServicios = $('#dropServicios').val();           
                var dropEspecialistas = $('#dropEspecialistas').val();           
                if (dropRecintos == 'defecto' || dropServicios == 'defecto' ||
                 dropEspecialistas == 'defecto') {
                        alert("Elija una opción válida en todos los campos");
               } else {
            horaCita = String(hora) + minutos;
            window.location.replace("/annadirCita/" + horaCita + '/' + dropRecintos + 
            '/' + dropServicios + '/' + dropEspecialistas + '/' + datepicked);
        }
        return false;
        }
    }
    </script>
</div></div>
@endsection
