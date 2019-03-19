function recintos(){
        $('#dropRecintos').empty();
        $('#dropRecintos').append("<option>Cargando...</option>");
        $('#dropEspecialistas').append("<option value='defecto'>Seleccione Especialista</option>");
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
        $('#dropEspecialistas').append("<option value='defecto'>Seleccione Especialista</option>");   
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

function especialistas(ID_Servicio, ID_Recinto){
            $('#dropEspecialistas').empty();
            $('#dropEspecialistas').append("<option>Cargando...<option>");
                $.ajax({
  url: '/especialistasCombo/' + ID_Servicio + '/' + ID_Recinto,
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
$('#dropEspecialistas').empty();
$('#dropEspecialistas').append("<option value='defecto'>Seleccione Especialista</option>");   
$.each(datos, function()
{
        $.each(this, function(){
        $('#dropEspecialistas').append('<option value="' + this.id + '">' + this.nombre + " "  + this.primer_apellido_especialista + 
        " " +  this.segundo_apellido_especialista + '</option>');
        }) 

})

}, error:function() {
        $('#dropEspecialistas').empty();
        $('#dropEspecialistas').append("<option value='defecto'>Seleccione Especialista</option>");   
        alert("¡Ha habido un error! Si este persiste por favor comuníquese con el Servicio de Salud");
}
}); //fin ajax
}//fin especialistas 



$(document).ready(function() {
        recintos();
        
        $('#dropRecintos').change(function() {
        ocultarHorario();
        ocultarTablaCitasSugeridas();
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
        ocultarTablaCitasSugeridas();
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
            ocultarTablaCitasSugeridas();

            var ID_Servicio = $('#dropServicios').val();
            var ID_Recinto = $('#dropRecintos').val();
            var ID_Especialista = $('#dropEspecialistas').val();
        if(ID_Servicio != 'defecto' && ID_Recinto != 'defecto' && ID_Especialista != 'defecto'){
            horario_Recinto_Serv_Esp();
        }
            }
        )

        $('#datetimepicker5').click(function() {
            ocultarHorario();
            ocultarTablaCitasSugeridas();
            }
        )
})

function limpiarDrop(nombreDrop, nombreTexto) {
   $('#' + nombreDrop).empty();
   $('#' + nombreDrop).append("<option value='defecto'>Seleccione " + nombreTexto+ "</option>");   
}



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



                $(function () {
                    var momento = new Date();
                    momentoInicioDia = new Date();
                    momentoInicioDia.setHours(0,0,0,0);
                    //console.log("Actual parseada: " + momento.toUTCString() + " s:" + momentoInicioDia);
                    
        $('#datetimepicker5').datetimepicker({
            //useCurrent: true,
            minDate: momentoInicioDia,
            maxDate: fechaMaxima(momento),
            format: 'DD/MM/YYYY', //Hay que ponerle un formato a la fecha, si no se pone esto se establecen con horas
            daysOfWeekDisabled:[0,6], //Asi se bloquean los fines de semana
            //disabledDates: ["10/24/2018"] //Lista de fechas que bloquear. 
            disabledDates: [] //Lista de fechas que bloquear. 
        }).on('dp.change', function prueba() {
           /* var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
            var datepicked = new Date(dateTime);
            datepicked = datepicked.toLocaleDateString();
            var fechaTica = parsearFecha(datepicked);
            var y = document.getElementById("Fecha");
            y.innerHTML = "Fecha seleccionada: " + fechaTica;
            y.style.display ="block";*/    
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
    if  (bisiesto == true) {
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

    function sugerirCitas() {
        var dropRecintos = $('#dropRecintos').val();           
        var dropServicios = $('#dropServicios').val();           
        var dropEspecialistas = $('#dropEspecialistas').val();           
        if (dropRecintos == 'defecto' || dropServicios == 'defecto' ||
         dropEspecialistas == 'defecto') {
                alert("Elija una opción válida en todos los campos");
       } else {
        $.ajax({
url: '/sugerirCitas/' + dropRecintos + '/' + dropServicios + '/' + dropEspecialistas,
type: 'GET',
dataType: "json",
success:function(datos){ 
if(datos.disponibles != undefined && datos.disponibles != ""){
llenarTablaSugeridas(datos.disponibles);
} else {
alert("No hay cita próxima rasta");
}
}, error:function() {
alert("Ha habido un error verificando la existencia de citas. Si este persiste comuníquese" +
" con el Servicio de Salud");   
},
timeout: 15000
}); 
}}

        function confirmarCita(hora , minutos) {
            var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
            var datepicked = new Date(dateTime);
            datepicked.setHours(datepicked.getHours() - 6);
            datepicked = datepicked.toISOString().split("-");
               minutos = String(minutos);
               if(minutos == "0") {
                   minutos = "00";
               }
        if (confirm("¿Desea una cita a la hora " + String(hora) + ":" + minutos + " en la fecha " + datepicked[2].substring(0, 2)+ "/" +
        datepicked[1] + "/" + datepicked[0] + "?")) {
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


    function cargarFechasDisponibles(horas) {
        limpiarCitas();
        //alert("/"+horas+"/");
        if(horas != undefined && horas !== "") {
            if(!Array.isArray(horas)) {//En caso de que sea un array de objetos este if lo castea a array.
                horas = Object.values(horas);
            }
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
datepicked.setHours(datepicked.getHours() - 6);
datepicked = datepicked.toISOString().split("-");
var y = document.getElementById("Fecha");
y.innerHTML = "Fecha seleccionada: " + datepicked[2].substring(0, 2) + "/" + datepicked[1] + "/" + datepicked[0];
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

function limpiarTablaSugeridas() {
    $("#ocultar-tabla-sugeridas table").remove();
}

function llenarTablaSugeridas(fechasSugeridas) {
    limpiarTablaSugeridas();
    codigoTabla = "";
    $.each(fechasSugeridas, function (i) {
        //alert(fechasSugeridas[i])
        fechaAux = fechasSugeridas[i].split("/");
        fechaAux = new Date(fechaAux[2], parseInt(fechaAux[1])-1, fechaAux[0]);
        //new Date(fechasSugeridas[i]);
        //alert(fechaAux);
        /*auxSugeridas = "!" + fechasSugeridas[i].replace("/", "!");
        auxSugeridas = auxSugeridas.replace("/", '!');
        auxSugeridas = JSON.stringify(auxSugeridas);*/
        codigoTabla += '<table id="ocultar-tabla-sugeridas" class="table table-striped table-bordered table-condensed table-hover">' + '<thead> <th class="text-center">Fecha' + '</th>' + '<th class="text-center">Opción' + '</th>' + '</thead>'+ '<tbody>' + '<tr><td style="text-align: center">' + fechasSugeridas[i] + '</td>'+ 
            '<td><button type="submit" style=" width:150px;" class=" btn  btn-success"' + 
            'onclick="cambiarFechaCalendario(' + fechaAux.getTime() + ')">Revisar Fecha</td></tr>' + '</tbody>' + '</table>';
        
        
                                       // <button id="{{$horaMilitar . '0' . $minutos}}" type="submit" style=" width:80px;" class="size btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:0{{$minutos}} {{$des}}</button>
});
$('#ocultar-tabla-sugeridas').append(codigoTabla);


    //alert(fechasSugeridas + "llegaron las fechas XD");
    mostarTablaCitasSugeridas();
}

function cambiarFechaCalendario(fechaSugerida) {

$('#datetimepicker5').data("DateTimePicker").date(new Date(fechaSugerida));
revisarDisponibilidad();
}

function horario_Recinto_Serv_Esp() {
        var dropRecintos = $('#dropRecintos').val();           
        var dropServicios = $('#dropServicios').val();           
        var dropEspecialistas = $('#dropEspecialistas').val();           
        if (dropRecintos == 'defecto' || dropServicios == 'defecto' ||
         dropEspecialistas == 'defecto') {
                alert("No se ha podido verificar el horario del especialista. Por favor" + 
                "elija una opción válida en todos los campos");
       } else {
        $.ajax({
            url: '/mostrarHorarioEsp/' + dropRecintos + '/' + dropServicios + '/' + dropEspecialistas,
            type: 'GET',
            dataType: "json",
            success:function(horario){ 
            horario = horario.mostrarHorarioEsp;

            var textoHorario = "Disponibilidad de horario: \n\n";
            var servicioDia = false; //esta variable sirve para saber si un día
            //en específico existe un horario para el servicio

        if(horario != undefined && horario !== "") {
            if(!Array.isArray(horario)) {//En caso de que sea un array de objetos este if lo castea a array.
                horario = Object.values(horario);
            }
            horario.forEach(function(diaHorario) {
                textoHorario += diaHorario.dia + ": ";

                if(diaHorario.disponibilidad_manana == "1") {
                    textoHorario += "Mañana" 
                    var servicioDia = true;
                }
                if(diaHorario.disponibilidad_tarde == "1") {
                    if(servicioDia) {
                        textoHorario += " y tarde"
                        var servicioDia = true;
                    } else {
                     textoHorario += "Tarde" 
                     var servicioDia = true;
                    }
                }

                if(!servicioDia) {
                    textoHorario += "Sin servicio"
                }
                textoHorario += "\n";
                var servicioDia = false;
            });
            alert(textoHorario);
        } else {
            alert("Ha habido un error verificando el horario del especialista. Si este persiste comuníquese" +
            " con el Servicio de Salud");    
        }
                
        }, error:function() {
            alert("Ha habido un error verificando el horario del especialista. Si este persiste comuníquese" +
            " con el Servicio de Salud");   
        },
        timeout: 15000
        }); 
        }}

