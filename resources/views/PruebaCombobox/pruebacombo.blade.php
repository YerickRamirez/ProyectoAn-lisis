@extends ('masterRoot')
@section ('contenido_Admin')

<select id="dropRecintos" class="form-control"></select>
<br>
<select id="dropServicios" class="form-control"></select>
<br>
<select id="dropEspecialistas" class="form-control"></select>

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

function especialistas(ID_Servicio){
            $('#dropEspecialistas').empty();
            $('#dropEspecialistas').append("<option>Cargando...<option>");
                $.ajax({
  url: '/especialistasCombo/' + ID_Servicio,
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
        var ID_Servicio = $('#dropServicios').val();
        if(ID_Servicio != 'defecto'){
        especialistas(ID_Servicio);   
        }else{
        limpiarDrop("dropEspecialistas", "Especialista")
        }
        })
})

function limpiarDrop(nombreDrop, nombreTexto) {
   $('#' + nombreDrop).empty();
   $('#' + nombreDrop).append("<option value='defecto'>----Seleccione " + nombreTexto+ "----</option>");   
}

</script>

<script>
function revisarDisponibilidad() {
        var dateTime = $('#datetimepicker5').data("DateTimePicker").date();
                var datepicked = new Date(dateTime);
                datepicked = datepicked.toISOString();
                alert("Fecha elegida: " + datepicked);
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
        $.each(datos, function()
{
        alert(datos.xD);
})
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
            <div class='col-sm-6'>
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
            minDate: momento, //Muestra el calendario desde el dia actual y no desde antes
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
    
    console.log("Actual " + dia+"/"+mes+"/"+anno);
        
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
    console.log("Fecha nueva prueba " + fechaMax);
        return fechaMax;
    }
    
    
    });
            </script>
        </div>
    </div>
    
    <button onclick="revisarDisponibilidad()">Alert</button>

@endsection




<!--<script type="text/Javascript">
function state() {
        alert("a");
        $.ajax({
                type: "POST",
                url: "controlerprueba.php",
                data: {action: 'combobox'},
                success:function(data) {
                        alert(data);
                },
                error: function() {
                        alert("puta vida");
                },
        });
}

$(document).ready(function() {
        state();
});

        /*var combo = document.getElementById("comboRecintos");
        document.getElementById("p").innerHTML = combo.options[combo.selectedIndex].text; //.text */
        
        </script>
-->

