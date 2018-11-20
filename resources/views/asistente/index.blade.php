@extends ('masterAsistente')
@section ('contenido_Asistente')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<div class="panel panel-primary class border-panel " >
     <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Lista de citas</p>
    </div>
    <div class="panel-body">
    <section class="">

    <div class="panel-heading">
        <div class="">
        <div class="">
            @if($citas->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="tablita">
                    <thead>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Correo</th>  
                        <th class="text-center">Fecha/Hora</th> 
                        <th class="text-center">Opción</th>                          
                    </thead>

                    <tbody>
                        @foreach($citas as $cita)
                        <?php $nombre = $cita->nombre . " " . $cita->primer_apellido_paciente . " " . $cita->segundo_apellido_paciente?>
                            <tr>
                                <td class="text-center">{{$cita->cedula_paciente}}</td>
                                <td class="text-center">{{$nombre}}</td>
                                <td class="text-center">{{$cita->telefono}}</td>
                                <td class="text-center">{{$cita->correo}}</td>
                                <td class="text-center">{{$cita->fecha_cita}} </td>
                                <td class="text-center"><a class="btn btn-warning" href="">
                                    Posponer</a>
                                    <form style="display:inline" action="" method="POST" style="display: inline;" onsubmit="return confirm('Desea cancelar la cita?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn  btn-danger"> Cancelar</button>
                                    </form> </td>
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