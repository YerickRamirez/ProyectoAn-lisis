@extends ('masterRoot')
@section ('contenido_Admin')
<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Pacientes</p>
    </div>
    <div class="panel-body">
        <section class="">
        <div class="content-c w3-container mobile">
            <div>


            
        </div>
    </div>

    <div class="panel-heading">
        <div class="">
        <div class="">
            @if($pacientes->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Teléfono</th>   
                        <th class="text-center">Opciones</th>                         
                    </thead>

                    <tbody>
                        @foreach($pacientes as $paciente)
                        <?php $nombre = $paciente->nombre . " " . $paciente->primer_apellido_paciente . " " . $paciente->segundo_apellido_paciente?>
                            <tr>
                                <td class="text-center"><strong>{{$paciente->cedula_paciente}}</strong></td>
                                <td class="text-center"><strong>{{$nombre}}</strong></td>
                                <td class="text-center">{{$paciente->correo}}</td>
                                <td class="text-center">{{$paciente->telefono}}</td>
                                <td class="text-center"><a class="btn btn-warning" href="{{ route('pacientes.edit', $paciente->id) }}">
                                    <i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    <form style="display:inline" action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea eliminar el paciente {{$paciente->nombre}} {{$paciente->primer_apellido_paciente}} {{$paciente->segundo_apellido_paciente}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn  btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
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
    </div> 
    </section>
    </div>
</div>

@endsection