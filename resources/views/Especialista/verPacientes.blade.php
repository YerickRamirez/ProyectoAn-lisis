@extends ('masterEspecialista')
@section ('contenido_Especialista')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Pacientes</p>
    </div>
    <div class="panel-body">
        <section class="">
        <div class="content-c w3-container mobile"></div>

        <div class="panel-heading">
            <div class="">
                @if($pacientes->count())
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="tablaDatos">
                        <thead>
                            <th class="text-center">Cédula</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Estado</th>    
                            <th class="text-center">Opciones</th>                         
                        </thead>

                        <tbody>
                            @foreach($pacientes as $paciente)
                            <?php $nombre = $paciente->nombre . " " . $paciente->primer_apellido_paciente . " " . $paciente->segundo_apellido_paciente?>
                            <?php $tel = str_split($paciente->telefono); $numeroTel = $tel[0] .  $tel[1] .  $tel[2] .  $tel[3] . ' - ' .  $tel[4] .  $tel[5] .  $tel[6] .  $tel[7]?>
                                <tr>
                                    <td class="text-center"><strong>{{$paciente->cedula_paciente}}</strong></td>
                                    <td class="text-center"><strong>{{$nombre}}</strong></td>
                                    <td class="text-center">{{$paciente->correo}}</td>
                                    <td class="text-center">{{$numeroTel}}</td>
                                    @if($paciente->active_flag == 1)
                                    <td class="text-center">Activa</td>
                                    @else
                                    <td class="text-center">Desactiva</td>
                                    @endif
                                    <td class="text-center"><a class="btn btn-warning" href="{{ route('pacientes.editRoot', $paciente->id) }}">
                                        Editar</a>
                                        @if($paciente->active_flag == 1)
                                        <form style="display:inline" action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar el paciente {{$paciente->nombre}} {{$paciente->primer_apellido_paciente}} {{$paciente->segundo_apellido_paciente}}?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn  btn-danger">Desactivar</button>
                                        </form>
                                        @else
                                        <form style="display:inline" action="{{ route('pacientes.activar', $paciente->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar el paciente {{$paciente->nombre}} {{$paciente->primer_apellido_paciente}} {{$paciente->segundo_apellido_paciente}}?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn  btn-primary">&nbsp&nbsp&nbspActivar&nbsp&nbsp&nbsp</button>
                                        </form>
                                        @endif
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


<script src="{{asset('js/lenguajeTabla.js')}}"></script>
@endsection