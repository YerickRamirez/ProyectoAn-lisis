@extends ('masterEspecialista')
@section ('contenido_Especialista')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<div class="panel panel-primary class border-panel " >

    
     <div class="panel-heading border-panel bg-color-panel">
     <p class="center" style="font-size: 3vh;">Histórico de citas de {{Auth::user()->name . ' ' . Auth::user()->lastName}}</p>
    </div>
    <div class="panel-body">
            <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropRecintos" class="form-control"></select></div>
    <section class="">
    <div class="panel-heading">
        <!--<div class="margin-dwn btn">
    <a class="margin-button-agregar margin-dwn btn btn-success mobile" href="{{ url('redirCitasHoyEsp') }}">Ver citas del {{ \Carbon\Carbon::now(new \DateTimeZone('America/Costa_Rica'))->format('d/m/Y') }}</a> <span>
            <a class="margin-button-agregar margin-dwn btn btn-success mobile" href="{{ url('redirCitasAPartirHoy') }}">Ver citas a partir del {{ \Carbon\Carbon::now(new \DateTimeZone('America/Costa_Rica'))->format('d/m/Y') }}</a> <span>
        </div>-->
        <br>
        <br>
        <a class="btn btn-primary" style="" href="{{url('reservarCitaEsp')}}">Reservar cita</a> 
        <br>
        <br>
        @if(session('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{@session('message')}}
        </div>
        @endif
    <div class="margin-up">
    <br> 
        <div class="margin-up">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="tablita">
                    <thead>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Teléfono</th>
                        <!--<th class="text-center">Correo</th>-->  
                        <th class="text-center">Especialista</th> 
                        <th class="text-center">Servicio</th> 
                        <th class="text-center">Recinto</th> 
                        <th class="text-center">Fecha/Hora</th> 
                        <th class="text-center">Estado</th>                          
                    </thead>

                    <tbody>
                       
                    </tbody>
                </table>
            </div>
            </div>

        </div>
        </div> 
	</section>
   </div>
 </div>

 <script>

$('#tablita').DataTable(
     {
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
} ,
 stateSave: true,
 "ordering": false,    
    } );
</script>

<script>
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
             /*var abcd = '<form style="display:inline" action="confirmarCitEspecialista/' + this.id_cita + '" method="POST" style="display: inline;" onsubmit="return confirm(' + "'" + "Desea confirmar la cita de " + this.nombre + "?'"+');">' +
                    '<input type="hidden" name="_token" value="' + "'" + "+ document.getElementsByName('_token')[0].value + '"+">"+
                        '<input type="hidden" name="_method" value="DELETE">' +
                        '<button id="confirmado" type="submit" class="btn  btn-primary">&nbspConfirmar &nbsp</button>' +'</form>';*/

            var btnReprogramarText = '<button id="reprogramar" onclick="redireccionarReprogramar(' +"'" + this.id_cita +"'" + ')" class="btn  btn-warning">&nbspReprogramar &nbsp</button>';
            var btnCancelarText = '<button id="cancelar" onclick="redireccionarCancelar(' +"'" + this.id_cita +"'" + ')" class="btn  btn-danger">&nbspCancelar &nbsp</button>';
            
           if(this.estado_cita_id == 2){
                var btnConfirmarText = '<button style="background-color:grey" disabled id="confirmado" onclick="redireccionarConfirmar(' +"'" + this.id_cita +"'" + ')" class="btn  btn-primary">&nbspConfirmar &nbsp</button>';
            } else {
                var btnConfirmarText = '<button id="confirmado" onclick="redireccionarConfirmar(' +"'" + this.id_cita +"'" + ')" class="btn  btn-primary">&nbspConfirmar &nbsp</button>'
            }
            $('#tablita').DataTable().row.add( [
                this.cedula_paciente,
                this.nombre + ' ' + this.primer_apellido_paciente + ' ' + this.segundo_apellido_paciente,
                this.telefono,
                this.nombreEsp + ' ' + this.apellidoEsp + ' ' + this.apellido2Esp,
                this.nombreServ,
                this.descripcion,
                this.fecha_cita,
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
            $('#tablita').dataTable().fnClearTable();
        var ID_Recinto = $('#dropRecintos').val();

        if(ID_Recinto != 'defecto'){
        ajaxCitasRecinto(ID_Recinto);
        }else{
        alert("Elija un recinto válido");
        }
        })
})


    </script>

    
@endsection