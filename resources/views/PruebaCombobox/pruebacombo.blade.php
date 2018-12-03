@extends ('masterPaciente')
@section ('contenido_Paciente')

<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Reservar cita</p>
    </div>
    <div class="panel-body">
<div style="margin-bottom: 15px;" class="col-md-4"><select id="dropRecintos" class="form-control"></select></div>
<div style="margin-bottom: 15px;" class="col-md-4"><select id="dropServicios" class="form-control"></select></div>
<div style="margin-bottom: 15px;" class="col-md-4"><select id="dropEspecialistas" class="form-control"></select></div>

<script>
function recintos(){
        $('#dropRecintos').empty();
        $('#dropRecintos').append("<option>Cargando...</option>");
        $('#dropEspecialistas').append("<option value='defecto'>----Seleccione Especialista----</option>");
        $('#dropServicios').append("<option value='defecto'>----Seleccione Servicio----</option>");

         $.ajax({
  url: '/recintosCombo',
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
$('#dropRecintos').empty();
$('#dropRecintos').append("<option value='defecto'>----Seleccione Recinto----</option>");   
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
        $('#dropEspecialistas').append("<option value='defecto'>----Seleccione Especialista----</option>");   
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
$('#dropServicios').append("<option value='defecto'>----Seleccione Servicio----</option>");   
$.each(datos, function()
{
    
        $.each(this, function(){
        $('#dropServicios').append('<option value="' + this.id + '">' + this.nombre + '</option>');
        }) 
}) 

}, error:function() {
        $('#dropServicios').empty();
        $('#dropServicios').append("<option value='defecto'>----Seleccione Servicio----</option>");   
        alert("¡Ha habido un error! Si este persiste por favor comuníquese con el Servicio de Salud");
}
}); //fin ajax
}//fin servicios 

function especialistas(ID_Servicio, ID_Recinto){
            $('#dropEspecialistas').empty();
            $('#dropEspecialistas').append("<option>Cargando...<option>");
                $.ajax({
  url: '/especialistasCombo/' + ID_Servicio + '/' + ID_Recinto,
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
$('#dropEspecialistas').empty();
$('#dropEspecialistas').append("<option value='defecto'>----Seleccione Especialista----</option>");   
$.each(datos, function()
{
        $.each(this, function(){
        $('#dropEspecialistas').append('<option value="' + this.id + '">' + this.nombre + " "  + this.primer_apellido_especialista + 
        " " +  this.segundo_apellido_especialista + '</option>');
        }) 

})

}, error:function() {
        $('#dropEspecialistas').empty();
        $('#dropEspecialistas').append("<option value='defecto'>----Seleccione Especialista----</option>");   
        alert("¡Ha habido un error! Si este persiste por favor comuníquese con el Servicio de Salud");
}
}); //fin ajax
}//fin especialistas 



$(document).ready(function() {
        recintos();
        
        $('#dropRecintos').change(function() {
        ocultarHorario();
        var ID_Recinto = $('#dropRecintos').val();
        if(ID_Recinto != 'defecto'){
        servicios(ID_Recinto);   
        limpiarDrop("dropEspecialistas", "Especialista")
        }else{
        limpiarDrop("dropServicios", "Servicio")
        limpiarDrop("dropEspecialistas", "Especialista")
        }
        })
        
        $('#dropServicios').change(function() {
        ocultarHorario();
        var ID_Servicio = $('#dropServicios').val();
        var ID_Recinto = $('#dropRecintos').val();
        if(ID_Servicio != 'defecto' && ID_Recinto != 'defecto'){
        especialistas(ID_Servicio, ID_Recinto);   
        }else{
        limpiarDrop("dropEspecialistas", "Especialista")
        }
        })

        $('#dropEspecialistas').change(function() {
            ocultarHorario();
            }
        )

        $('#datetimepicker5').click(function() {
            ocultarHorario();
            }
        )
})

function limpiarDrop(nombreDrop, nombreTexto) {
   $('#' + nombreDrop).empty();
   $('#' + nombreDrop).append("<option value='defecto'>----Seleccione " + nombreTexto+ "----</option>");   
}

</script>

<script>
function revisarDisponibilidad() {
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
}}
</script>


<!-- sdfghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh-->
<div class="container">
        <div class="row">
            <div class='col-sm-3'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker5'>
                        <input type='text' class="form-control" onchange="prueba()" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
                    <script type="text/javascript">
                $(function () {
                    var momento = new Date();
                    console.log("Actual parseada: " + momento);
        $('#datetimepicker5').datetimepicker({
            minDate: momento,
            maxDate: fechaMaxima(momento),
            format: 'DD/MM/YYYY', //Hay que ponerle un formato a la fecha, si no se pone esto se establecen con horas
            daysOfWeekDisabled:[0,6], //Asi se bloquean los fines de semana
            //disabledDates: ["10/24/2018"] //Lista de fechas que bloquear. 
            disabledDates: [] //Lista de fechas que bloquear. 
        }).on('dp.change', function prueba() {
            });
    
    
        function fechaMaxima (actual){
        var maximo = actual;// = new Date();
        //maximo: actual;
        var mes = maximo.getMonth();
        var dia = maximo.getDate();
        var anno = maximo.getFullYear();
        var bisiesto = false;
    
    //console.log("Actual " + dia+"/"+mes+"/"+anno);
        
    if ((anno % 4 == 0) && ((anno % 100 != 0) || (anno % 400 == 0))) {
        bisiesto = true;
    }
        
    switch(mes){
    case 0:
    if (dia > 28) {
    if	(bisiesto == true) {
    maximo = "29/1/" + anno;
    } else {
        maximo = "28/1/" + anno;
    }
    } else {
        maximo = dia + "/" + mes+1 + "/" + anno;   
    }
    break;
    
    //Los meses que son de 30 dias
    case 1:
    case 3:
    case 5:
    case 8:
    case 10:
    
    if(dia == 30) {
    mes = (mes + 1);
    if (mes < 10) {

    maximo = "31/"+ mes + "/" + anno;
    } else {
        maximo = "31/"+ mes + "/" + anno;
    }
    } else {
    mes = (mes + 1);
    if (mes < 10) {
    maximo = dia + "/" + "0" + mes + "/" + anno;
    } else {
    maximo = "0" + dia + "/" + mes + "/" + anno;
    }
    }
    break;
    
    //Los meses que son de 31 dias
    case 2:
    case 4:
    case 6:
    case 7:
    case 9:
    if(dia == 31) {
    mes = (mes + 1);
    if (mes < 10) {
    maximo = "30/" + mes + "/"+ anno;
    } else {
    maximo = "30/" + mes + "/"+ anno;
    }
    } else {
    mes = (mes + 1);
    if (mes < 10) {
    maximo =  dia + "/" + "0" + mes + "/" + anno;
    } else {
    maximo =  dia + "/" + mes + "/" + anno  ;
    }
    }
    break;
    
    case 11:
    maximo = dia + "/0/" + (anno + 1);
    break;
    }
    //console.log("Máxima " + maximo);
    var parts = maximo.split("/");
    var newMaximo =   Number(parts[1])+1 +  "/" + Number(parts[0]) + "/" + Number(parts[2]);
    var fechaMax =  new Date(Date.parse(newMaximo));
    if(fechaMax.getDay() == 0) {
        fechaMax.setDate(fechaMax.getDate()-2);
    }
    if(fechaMax.getDay() == 6) {
        fechaMax.setDate(fechaMax.getDate()-1);
    }
   // console.log("Fecha nueva prueba " + fechaMax);
        return fechaMax;
    }
    });
            </script>
        </div>
    </div>
    
    <button id="mostar-tabla"  style="margin-left:15px;"class = 'margin-button-agregar btn btn-success mobile' 
    onclick="revisarDisponibilidad()">Mostrar horario</button>
    <br><br>
    @if(session('message'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{@session('message')}}
    </div>
    @endif
    <p style="display:none; margin-top:15px; text-align:center; font-size: 3vh;" id="Fecha">Hola</p>

    <!-- /////////////////////////////////////////////////////////////////////////// -->
    
    <div class="panel-heading">
<div class="table-responsive" id="ocultar-tabla" style="display: none;">
       
<table class="table table-striped table-bordered table-condensed table-hover">
                    
                    <?php $hora = 8; $des = "am"; $horaMilitar = 8;?>
                <tbody>
                    @for ($i = 0; $i < 4; $i++)
                        <?php $minutos = 00;?>
                        <tr>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar . '0' . $minutos}}" type="submit" style=" width:80px;" class="size btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:0{{$minutos}} {{$des}}</button>
                                 <?php $minutos = $minutos + 20;?>
                            </td>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar.$minutos}}" type="submit" style=" width:80px;" class="btn btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:{{$minutos}} {{$des}}</button>
                            </td><?php $minutos = $minutos + 20;?>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar.$minutos}}" type="submit" style=" width:80px;" class="btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:{{$minutos}} {{$des}}</button>
                            </td><?php $minutos = 00;  $hora = $hora + 1; $horaMilitar = $horaMilitar + 1;?>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar. 0 . $minutos}}" type="submit" style=" width:80px;" class="btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:0{{$minutos}} {{$des}}</button>
                            </td><?php $minutos = $minutos + 20;?>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar.$minutos}}" type="submit" style=" width:80px;" class="btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:{{$minutos}} {{$des}}</button>
                            </td><?php $minutos = $minutos + 20;?>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar.$minutos}}" type="submit" style=" width:80px;" class="btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:{{$minutos}} {{$des}}</button>
                            </td><?php $hora = $hora + 1; $horaMilitar = $horaMilitar + 1;?>
                        </tr>

                        @if ($i == 1)
                            <?php $des = "pm"; $hora = 1; $horaMilitar = 13;?>
                        @endif
                    @endfor
                </tbody>
</table>

<script>
        function confirmarCita(hora , minutos) {
            var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
            var datepicked = new Date(dateTime);
            //alert(datepicked)
            //datepicked.setHours(datepicked.getHours() -6);
            datepicked = datepicked.toLocaleDateString();
            //alert(datepicked);
               minutos = String(minutos);
               if(minutos == "0") {
                   minutos = "00";
               }
        if (confirm("¿Desea una cita a la hora " + String(hora) + ":" + minutos + " en la fecha " + datepicked + "?")) {
            var datepicked = new Date(dateTime);
            datepicked.setHours(datepicked.getHours() -6);
                datepicked = datepicked.toISOString();
                //alert(datepicked + " para método")
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

<?php
$array = array(800, 820, 840, 1,  1);
$holas = array(90000, 80000, 130000,"114000", "94000", 164000, 140000);
?>
<script>
    function cargarFechasDisponibles(horas) {
        limpiarCitas();
        //alert("/"+horas+"/");
        if(horas != undefined && horas !== "") {
        horas.forEach(function(entry) {
            entry = entry.replace(/\:/g, '');
            if(entry.charAt(0) == "0") {
                entry = entry.replace("0", "")
            }
            //alert(entry);
            if(entry != 1700) {
    document.getElementById(entry).disabled = true;
    document.getElementById(entry).style.backgroundColor = "#656161";
}

    
});
var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
    
    var datepicked = new Date(dateTime);
    datepicked = datepicked.toLocaleDateString();
    var fechaTica = parsearFecha(datepicked);
    
    var y = document.getElementById("Fecha");
    y.innerHTML = "Fecha seleccionada: " + fechaTica;
    y.style.display ="block";
}
mostarHorario();
}

function limpiarCitas() {
    var horaCita;
    for (horaCita = 800; horaCita <= 1640; horaCita++) {
        
        if(document.getElementById(horaCita) != null){
        document.getElementById(horaCita).disabled = false;
        document.getElementById(horaCita).style.backgroundColor = "#33cc33";
    }
} 
}
</script>
</div>
</div>
</div>
</div>
@endsection
