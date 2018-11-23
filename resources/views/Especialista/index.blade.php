@extends ('masterEspecialista')
@section ('contenido_Especialista')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<div class="panel panel-primary class border-panel " >

     <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Lista de citas</p>
    </div>
    <div class="panel-body">
    <section class="">

    <div class="panel-heading">
        <div class="margin-dwn btn">
    <a class="margin-button-agregar margin-dwn btn btn-success mobile" href="{{ url('reservarCita') }}">Boton que dice Seney</a> <span>
        </div>
<br>    
    <div class="margin-up">
    <br> 
        <div class="margin-up">
            @if($citas->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="tablita">
                    <thead>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Teléfono</th>
                        <!--<th class="text-center">Correo</th>-->  
                        <th class="text-center">Fecha/Hora</th> 
                        <th class="text-center">Estado</th>                          
                    </thead>

                    <tbody>
                        @foreach($citas as $cita)
                        <?php $nombre = $cita->nombre . " " . $cita->primer_apellido_paciente . " " . $cita->segundo_apellido_paciente?>
                            <tr>
                                <td class="text-center">{{$cita->cedula_paciente}}</td>
                                <td class="text-center">{{$nombre}}</td>
                                <td class="text-center">{{$cita->telefono}}</td>
                                <!--<td class="text-center">{{$cita->correo}}</td>-->
                                <td class="text-center">{{$cita->fecha_cita}} </td>
                               
                                <td class="text-center">
                                @if( $cita->estado_cita_id == 2)
                                
                                        <button id="confirmado" type="submit" class="btn btn-primary" style="background-color:grey" disabled> Confirmada</button>
                                    
                                    @else
                                    <form style="display:inline" action="{{route('confirmarCitEspecialista', $cita->id_cita)}}" method="POST" style="display: inline;" onsubmit="return confirm('Desea confirmar la cita de {{$cita->nombre}} {{$cita->primer_apellido_paciente}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button id="confirmado" type="submit" class="btn  btn-primary">&nbspConfirmar &nbsp</button>
                                    </form>
                                    @endif   
                                    
                                    <form style="display:inline" action="{{route('reprogramarCitEspecialista', $cita->id_cita)}}" method="POST" style="display: inline;" onsubmit="return confirm('Desea reprogramar la cita de {{$cita->nombre}} {{$cita->primer_apellido_paciente}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-info"> Reprogramar</button>
                                    </form> 
                                    <form style="display:inline" action="{{route('destroyCitEspecialista', $cita->id_cita)}}" method="POST" style="display: inline;" onsubmit="return confirm('Desea cancelar la cita de {{$cita->nombre}} {{$cita->primer_apellido_paciente}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn  btn-danger"> Cancelar</button>
                                    </form> 
                                   
                                </td> 
 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                
            @else
                <h3 class="text-center alert alert-info">No hay nada para mostrar</h3>
            @endif

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
@endsection