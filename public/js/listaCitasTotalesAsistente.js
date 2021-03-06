function recintos(){
                $('#dropRecintos').empty();
                $('#dropRecintos').append("<option>Cargando...</option>");
        
                 $.ajax({
          url: '/recintosCombo',
          type: 'GET',
          dataType: "json",
          success:function(datos){ 
        $('#dropRecintos').empty();
        $('#dropRecintos').append("<option value='defecto'>----Seleccione Recinto----</option>"); 
        $('#dropEstados').append("<option value='defecto'>----Seleccione Estado de Cita----</option>"); 
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


function ajaxCitasRecintoEstado(ID_Recinto, estado){
        
            $.ajax({
          url: '/citasRecintoEstadoAsistHist/' + ID_Recinto + '/' + estado,
          type: 'GET',
          dataType: "json",
          success:function(datos){ 
              //alert(datos);
              //alert(datos.citas);
       // $('#dropRecintos').empty();
       // $('#dropRecintos').append("<option value='defecto'>----Seleccione Recinto----</option>");   
        $.each(datos.citas, function()
        {
             /*var abcd = '<form style="display:inline" action="confirmarCitEspecialista/' + this.id_cita + '" method="POST" style="display: inline;" onsubmit="return confirm(' + "'" + "Desea confirmar la cita de " + this.nombre + "?'"+');">' +
                    '<input type="hidden" name="_token" value="' + "'" + "+ document.getElementsByName('_token')[0].value + '"+">"+
                        '<input type="hidden" name="_method" value="DELETE">' +
                        '<button id="confirmado" type="submit" class="btn  btn-primary">&nbspConfirmar &nbsp</button>' +'</form>';*/

            
            var estado = "Reservada";
            if(this.estado_cita_id == 2){
                var estado = "Confirmada";
            } 
            if(this.estado_cita_id == 3 ){
                var estado = "Cancelada";
            } 
            
            if(this.estado_cita_id == 4 ){
                var estado = "Reprogramada";
            } 

            var fecha = this.fecha_cita.split("-");
    	    var anio = fecha[0];
    	    var mes = fecha[1];
            var dia = fecha[2];
            var diaHora = dia.split(" ");
            dia = diaHora[0];
            hora = diaHora[1];
            fecha = dia + "/" + mes + "/" + anio + " " + hora;

            var tel = this.telefono + "";
            tel = tel.split("");
            var tel1 = tel[0] + "" + tel[1] + "" + tel[2] + "" + tel[3];
            var tel2 = tel[4] + "" + tel[5] + "" + tel[6] + "" + tel[7];
            var telefono = tel1 + " - " + tel2;

            $('#tablaDatos').DataTable().row.add( [
                this.cedula_paciente,
                this.nombre + ' ' + this.primer_apellido_paciente + ' ' + this.segundo_apellido_paciente,
                telefono,
                this.nombreEsp + ' ' + this.apellidoEsp + ' ' + this.apellido2Esp,
                this.nombreServ,
                this.descripcion,
                fecha,
                estado
        ] ).draw( false );   
        })
        
        }, error:function() {
                alert("¡Ha habido un error! Elija correctamente su recinto." +
                "Si este error persiste por favor comuníquese con el Servicio de Salud");
                $('#dropEstados').append("<option value='defecto'>----Seleccione Estado de Cita----</option>");   
        }
        });
        }

function redireccionarConfirmar(id_cita) {
    window.location.replace('/confirmarCitaAjax/' + id_cita);
}

function redireccionarReprogramar(id_cita) {
    window.location.replace('/reprogramarCitaAjax/' + id_cita);
}

function redireccionarCancelar(id_cita) {
    window.location.replace('/cancelarCitaAjax/' + id_cita);
}

    $(document).ready(function() {
        recintos();
        $('#dropRecintos').change(function() {
        $('#tablaDatos').dataTable().fnClearTable();
        var ID_Recinto = $('#dropRecintos').val();

        if(ID_Recinto != 'defecto'){
        estados_citas();
        }else{
        limpiarDrop('dropEstados', 'Estado de Cita');
        alert("Elija un recinto válido");
        }
        })

        $('#dropEstados').change(function() {
        $('#tablaDatos').dataTable().fnClearTable();
        var ID_Recinto = $('#dropRecintos').val();
        var estado = $('#dropEstados').val();
        if(ID_Recinto != 'defecto' || estado != 'defecto'){
        ajaxCitasRecintoEstado(ID_Recinto, estado);  
        }else{
        alert("Elija un recinto y/o estado válidos");
        }
        })
})

function limpiarDrop(nombreDrop, nombreTexto) {
   $('#' + nombreDrop).empty();
   $('#' + nombreDrop).append("<option value='defecto'>----Seleccione " + nombreTexto+ "----</option>");   
}

function estados_citas(){
            $('#dropEstados').empty();
            $('#dropEstados').append("<option>Cargando...<option>");
                $.ajax({
  url: '/traerEstadosCitas/' ,
  type: 'GET',
  dataType: "json",
  success:function(datos){ 
$('#dropEstados').empty();
$('#dropEstados').append("<option value='defecto'>----Seleccione Estado de Cita----</option>");   
$('#dropEstados').append("<option value='5'> Reservadas/Confirmadas </option>");  
$.each(datos, function()
{
    //alert(datos);
    //alert(datos.estado_citas);
        $.each(this, function(){
        $('#dropEstados').append('<option value="' + this.id + '">' + this.descripcion_estado_cita + '</option>');
        }) 
}) 

}, error:function() {
        $('#dropEstados').empty();
        $('#dropEstados').append("<option value='defecto'>----Seleccione Estado Cita----</option>");   
        alert("¡Ha habido un error! Si este persiste por favor comuníquese con el Servicio de Salud");
}
}); //fin ajax
}//fin estado citas 
