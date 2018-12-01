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
            $('#tablita').DataTable().row.add( [
                this.cedula_paciente,
                this.nombre + ' ' + this.primer_apellido_paciente + ' ' + this.segundo_apellido_paciente,
                this.telefono,
                this.nombreEsp + ' ' + this.apellidoEsp + ' ' + this.apellido2Esp,
                this.nombreServ,
                this.fecha_cita,
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