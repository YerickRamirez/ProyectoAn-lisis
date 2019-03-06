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

function especialistas(){
            $('#dropEspecialistas').empty();
            $('#dropEspecialistas').append("<option>Cargando...<option>");
                $.ajax({
  url: '/cargarEspecialistas/',
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
    especialistas();
        
})

function limpiarDrop(nombreDrop, nombreTexto) {
   $('#' + nombreDrop).empty();
   $('#' + nombreDrop).append("<option value='defecto'>----Seleccione " + nombreTexto+ "----</option>");   
}




function insertarBloqueoEsp() {

    var dropDiasBloqueo = $('#dropDiasBloqueo').val(); 
    var dropEspecialistas = $('#dropEspecialistas').val(); 

    var horaInicio = $('#timeInicio').val();
    var horaFin = $('#timeFin').val();
    horaInicio = arreglarHora(horaInicio);
    horaFin = arreglarHora(horaFin);
    //alert("Inicio: " + horaInicio + " Fin: " + horaFin);
    

    
        var dateTimeInicio = $('#datetimepickerInicio').data("DateTimePicker").date();
                var datepickedInicio = new Date(dateTimeInicio);
                datepickedInicio.setHours(datepickedInicio.getHours() -6);
                datepickedInicio = datepickedInicio.toISOString();
                //alert(datepickedInicio);
        
        var dateTimeFin = $('#datetimepickerFin').data("DateTimePicker").date();
                var datepickedFin = new Date(dateTimeFin);
                datepickedFin.setHours(datepickedFin.getHours() -6);
                datepickedFin = datepickedFin.toISOString();
                //alert(datepickedFin);
                
                if (dropDiasBloqueo == 'defecto') {
                        alert("Elija una opción válida en todos los campos");
               } else {
                /*alert('/crearBloqueoEspecialista/' + dropEspecialistas + '/' + dropDiasBloqueo + '/'+ datepickedInicio + '/' + datepickedFin + '/' + horaInicio + '/' 
  + horaFin);*/
                $.ajax({
  url: '/crearBloqueoEspecialista/' + dropEspecialistas + '/' + dropDiasBloqueo + '/'+ datepickedInicio + '/' + datepickedFin + '/' + horaInicio + '/' 
  + horaFin,
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
      //alert(datos.a)
    window.location.replace("/bloqueo_especialistas");
}, error:function() {
     alert("Ha habido un error añadiendo el bloqueo para el especialista");   
},
timeout: 15000
}); 
}
}//fin método




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



function arreglarHora(hora) {
        var horaReturn = "";
        if(hora.includes("AM")) {
            horaReturn = hora.slice(0, -3);
            return horaReturn + ":00";
        }//if AM end
        if(hora.includes("PM")) {
            horaReturn = hora.slice(0, -3);
            if(horaReturn.includes("12")) {
            return horaReturn + ":00";
            } else {
            switch (horaReturn.charAt(0)) {
                case "1":
                    horaReturn = "13"+ horaReturn.substr(1) + ":00";
                    return horaReturn;
                    break;
                case "2":
                    horaReturn = "14"+ horaReturn.substr(1) + ":00";
                    return horaReturn;
                    break;
                case "3":
                    horaReturn = "15"+ horaReturn.substr(1) + ":00";
                    return horaReturn;
                    break;
                case "4":
                    horaReturn = "16"+ horaReturn.substr(1) + ":00";
                    return horaReturn;
                    break;
                case "5":
                    horaReturn = "17"+ horaReturn.substr(1) + ":00";
                    return horaReturn;
                    break;
                default:
                    text = "Va a explotar, hora mala";
            }//fin switch
            }//fin else
        }//if PM end
    }//fin arreglar hora
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