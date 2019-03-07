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


function ajaxCitasRecinto(ID_Recinto){
        
            $.ajax({
          url: '/citasRecintoParaEspLoggeadoHistActivas/' + ID_Recinto,
          type: 'GET',
          dataType: "json",
          success:function(datos){ 
              //alert(datos);
              //alert(datos.citas);
       // $('#dropRecintos').empty();
       // $('#dropRecintos').append("<option value='defecto'>----Seleccione Recinto----</option>");   
        $.each(datos.citas, function()
        {
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

            $('#tablaDatos').DataTable().row.add( [
                this.cedula_paciente,
                this.nombre + ' ' + this.primer_apellido_paciente + ' ' + this.segundo_apellido_paciente,
                this.telefono,
                //this.nombreEsp + ' ' + this.apellidoEsp + ' ' + this.apellido2Esp,
                this.nombreServ,
                fecha,
                estado
        ] ).draw( false );   
        })
        
        }, error:function() {
                alert("¡Ha habido un error! Elija correctamente su recinto." +
                "Si este error persiste por favor comuníquese con el Servicio de Salud");
                $('#dropEspecialistas').append("<option value='defecto'>----Seleccione Especialista----</option>");   
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
        ajaxCitasRecinto(ID_Recinto);
        }else{
        alert("Elija un recinto válido");
        }
        })
})

