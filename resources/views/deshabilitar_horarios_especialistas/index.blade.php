@extends('masterRoot')

@section('contenido_Admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <div class="panel panel-primary class border-panel " >
     <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Deshabilitar Especialistas</p>
    </div>
    <div class="panel-body">
    <section class="">
    <div class="page-header clearfix">
            <a class="btn btn-success pull-left" href="{{ route('deshab_especialistas.create') }}">Crear</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($deshabilitar_horarios_especialistas->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="tablaDeshabilitar">
                        <thead>
                                <tr>
                                    <th>Especialista</th><th>Fecha inicio bloqueo</th> <th>Fecha fin bloqueo</th> <th>Hora inicio bloqueo</th> <th>Hora fin bloqueo</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>

                    <tbody>
                        @foreach($deshabilitar_horarios_especialistas as $deshabilitar_horarios_especialista)
                            <tr>

                                <td>{{$deshabilitar_horarios_especialista->nombre . ' ' . $deshabilitar_horarios_especialista->primer_apellido_especialista . ' ' . $deshabilitar_horarios_especialista->segundo_apellido_especialista}}</td>
                                <td>{{$deshabilitar_horarios_especialista->fecha_inicio_deshabilitar}}</td> 
                                <td>{{$deshabilitar_horarios_especialista->fecha_fin_deshabilitar}}</td>
                                <td>{{$deshabilitar_horarios_especialista->hora_inicio_deshabilitar}}</td> 
                                <td>{{$deshabilitar_horarios_especialista->hora_fin_deshabilitar}}</td>
                                
                                <td class="text-right">
                                        <form action="{{ route('deshab_especialistas.destroy', $deshabilitar_horarios_especialista->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
    
                                            <button type="submit" class="btn btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            @else
                <h3 class="text-center alert alert-info">No existen horarios deshabilitados</h3>
            @endif

        </div>
    </div>
    </section>
    </div>
    </div>
    <script src="{{asset('js/lenguajeTabla.js')}}"></script>

@endsection