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
          url: '/citasRecintoParaEspLoggeadoFuturas/' + ID_Recinto,
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

            var btnReprogramarText = '<button id="reprogramar" onclick="redireccionarReprogramar(' +"'" + this.id_cita +"'" + "," + "'" + this.nombre  +  "'" + "," + "'" + this.primer_apellido_paciente +  "'" + ')" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-repeat"></button>';
            var btnCancelarText = '<button id="cancelar" onclick="redireccionarCancelar(' +"'" + this.id_cita +"'" + "," + "'" + this.nombre  +  "'" + "," + "'" + this.primer_apellido_paciente +  "'" + ')" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></button>';
            
           if(this.estado_cita_id == 2){
                var btnConfirmarText = '<button style="background-color:grey" disabled id="confirmado" onclick="redireccionarConfirmar(' +"'" + this.id_cita +"'" + "," + "'" + this.nombre  +  "'" + "," + "'" + this.primer_apellido_paciente +  "'" + ')" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-ok"></button>';
            } else {
                var btnConfirmarText = '<button id="confirmado" onclick="redireccionarConfirmar(' +"'" + this.id_cita +"'" + "," + "'" + this.nombre  +  "'" + "," + "'" + this.primer_apellido_paciente +  "'" + ')" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-ok"></button>'
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
            var telefono = tel1 + "-" + tel2;

            $('#tablaDatos').DataTable().row.add( [
                this.cedula_paciente,
                this.nombre + ' ' + this.primer_apellido_paciente + ' ' + this.segundo_apellido_paciente,
                telefono,
                this.nombreServ,
                fecha,
                btnConfirmarText + ' ' + btnReprogramarText + ' ' + btnCancelarText
        ] ).draw( false );   
        })
        
        }, error:function() {
                alert("¡Ha habido un error! Elija correctamente su recinto." +
                "Si este error persiste por favor comuníquese con el Servicio de Salud");
                $('#dropEspecialistas').append("<option value='defecto'>----Seleccione Especialista----</option>");   
        }
        });
        }

function redireccionarConfirmar(id_cita, nombre, apellido) {
    if(confirm('¿Está seguro que desea confirmar la cita de ' + nombre + ' ' + apellido + '?')){
    window.location.replace('/confirmarCitaAjax/' + id_cita);
    }
}

function redireccionarReprogramar(id_cita, nombre, apellido) {
    if(confirm('¿Está seguro que desea reprogramar la cita de ' + nombre + ' ' + apellido + '?')){
    window.location.replace('/reprogramarCitaAjax/' + id_cita);
}
}

function redireccionarCancelar(id_cita, nombre, apellido) {
    if(confirm('¿Está seguro que desea cancelar la cita de ' + nombre + ' ' + apellido + '?')){
    window.location.replace('/cancelarCitaAjax/' + id_cita);
    }
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

