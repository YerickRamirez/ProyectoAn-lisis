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
             dropEspecialistas == 'defecto' || cedula.length == 0) {
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
    console.log("Actual parseada: " + momento);
$('#datetimepicker5').datetimepicker({
minDate: momento, //Muestra el calendario desde el dia actual y no desde antes
format: 'DD/MM/YYYY', //Hay que ponerle un formato a la fecha, si no se pone esto se establecen con horas
daysOfWeekDisabled:[0,6], //Asi se bloquean los fines de semana
//disabledDates: ["10/24/2018"] //Lista de fechas que bloquear. 
disabledDates: [] //Lista de fechas que bloquear. 
}).on('dp.change', function prueba() {
});
});

function confirmarCita(hora , minutos) {
    var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
    var datepicked = new Date(dateTime);
    datepicked.setHours(datepicked.getHours() -6);
    datepicked = datepicked.toLocaleDateString();
       // alert("Fecha elegida: " + datepicked);
       minutos = String(minutos);
       if(minutos == "0") {
           minutos = "00";
       }
if (confirm("¿Desea una cita a la hora " + String(hora) + ":" + minutos + " en la fecha " + datepicked + "?")) {
    var datepicked = new Date(dateTime);
    datepicked.setHours(datepicked.getHours() -6);
        datepicked = datepicked.toISOString();
        var cedula = $('#cedula').val(); 
        var dropRecintos = $('#dropRecintos').val();           
        var dropServicios = $('#dropServicios').val();           
        var dropEspecialistas = $('#dropEspecialistas').val();           
        if (dropRecintos == 'defecto' || dropServicios == 'defecto' ||
         dropEspecialistas == 'defecto' || cedula.length == 0) {
                alert("Elija una opción válida en todos los campos");
       } else {
    horaCita = String(hora) + minutos;
    window.location.replace("/annadirCitaAsistente/" + horaCita + '/' + dropRecintos + 
    '/' + dropServicios + '/' + dropEspecialistas + '/' + datepicked + '/' + cedula);
}
return false;
}
}

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
document.getElementById(entry).disabled = true;
document.getElementById(entry).style.backgroundColor = "#656161";

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