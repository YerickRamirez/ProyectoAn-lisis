function extraerRecintos(){
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

function extraerServicios(ID_Recinto){
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


function extraerEspecialistas() {
        $('#dropEspecialistas').empty();
        $('#dropEspecialistas').append("<option>Cargando...<option>");
        $.ajax({
                url: '/cargarEspecialistas',
                type: 'GET',
                dataType: "json",
                success: function (datos) {
                        $('#dropEspecialistas').empty();
                        $('#dropEspecialistas').append("<option value='defecto'>Seleccione Especialista</option>");
                        $.each(datos, function () {
                                $.each(this, function () {
                                        $('#dropEspecialistas').append('<option value="' + this.id + '">' + this.nombre + ' ' + this.primer_apellido_especialista + ' ' + this.segundo_apellido_especialista + '</option>');
                                })
                        })

                }, error: function () {
                        $('#dropEspecialistas').empty();
                        $('#dropEspecialistas').append("<option value='defecto'>Seleccione Servicio</option>");
                        alert("¡Ha habido un error! Si este persiste por favor comuníquese con el Servicio de Salud");
                }
        }); //fin ajax
}//fin servicios 

function vincular() {
        var servicio = $('#dropServicios').val();
        var recinto = $('#dropRecintos').val();
        var especialista = $('#dropEspecialistas').val();
  window.location.replace("/vincularEspecialista/" + servicio + "/" + recinto + "/" + especialista);
}

/***********







***********/
//VER ESTO QUE ES IMPORTANTE E INVISIBLE, TOTALMENTE
$(document).ready(function() {
        extraerRecintos();

        $('#dropRecintos').change(function() {
        var ID_Recinto = $('#dropRecintos').val();
        if(ID_Recinto != 'defecto'){
        extraerServicios(ID_Recinto);   
        //limpiarDrop("dropEspecialistas", "Especialista")
        }else{
        limpiarDrop("dropServicios", "Servicio")
        //limpiarDrop("dropEspecialistas", "Especialista")
        }
        })
        extraerEspecialistas();
})



/***********



*************/



function limpiarDrop(nombreDrop, nombreTexto) {
   $('#' + nombreDrop).empty();
   $('#' + nombreDrop).append("<option value='defecto'>----Seleccione " + nombreTexto+ "----</option>");   
}
