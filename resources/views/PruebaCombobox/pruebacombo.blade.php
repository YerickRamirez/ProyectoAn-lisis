@extends ('masterAdmin')
@section ('contenido')

<select id="dropRecintos" class="form-control"></select>
<br>
<select id="dropServicios" class="form-control"></select>
<br>
<select id="dropEspecialistas" class="form-control"></select>


<script>
        /*
        var combo = document.getElementById("comboRecintos");
        document.getElementById("p").innerHTML = combo.options[combo.selectedIndex].text; //.text*/
        </script>
        
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
        $.each(this.data, function(){//los datos del server vienen en una variable data
        //si quieren ver esos datos pongan en la URL "/recintosCombo" por ejemplo.
        $('#dropRecintos').append('<option value="' + this.ID_Recinto + '">' + this.Nombre + '</option>');
        })        
})

}, error:function() {
        alert("¡Ha habido un error! Elija correctamente su recinto." +
        "Si este error persiste por favor comuníquese con el Servicio de Salud");
        $('#dropEspecialistas').append("<option value='defecto'>----Seleccione Especialista----</option>");   
}
});
}

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
        var i;
        for (i = 0; i < this.length; i++) {
        $('#dropEspecialistas').append('<option value="' + this[i][0].Cédula + '">' + this[i][0].Nombre +  " " + 
        this[i][0].Primer_Apellido + " " + this[i][0].Segundo_Apellido + '</option>');
} 

})

}, error:function() {
        $('#dropEspecialistas').empty();
        $('#dropEspecialistas').append("<option value='defecto'>----Seleccione Especialista----</option>");   
        alert("El servicio seleccionado no tiene especialistas disponibles para su atención." +
         " Si cree que esto es un error por favor comuníquese con el Servicio de Salud");
}
}); //fin ajax
}//fin especialistas 


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
        $('#dropServicios').append('<option value="' + this.ID_Servicio + '">' + this.Nombre + '</option>');
        }) 
}) 

}, error:function() {
        $('#dropServicios').empty();
        $('#dropServicios').append("<option value='defecto'>----Seleccione Servicio----</option>");   
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

<button onclick="recintos()">Alert</button>

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

