@extends('masterAdmin')

@section('contenido')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Bloqueo Especialistas
            <a class="btn btn-success pull-right" href="{{ route('bloqueo_especialistas.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($bloqueo_especialistas->count())
                <table class="table table-condensed table-striped" id='tablaBloqueos'>
                    <thead>
                        <tr>
                            <th>id_especialista</th> <th>Dia bloqueado</th> <th>Fecha inicio bloqueo</th> <th>Fecha fin bloqueo</th> <th>Hora inicio bloqueo</th> <th>Hora fin bloqueo</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bloqueo_especialistas as $bloqueo_especialistum)
                            <tr>

                                 <td>{{$bloqueo_especialistum->id_especialista}}</td> <td>{{$bloqueo_especialistum->id_dia_bloqueo_especialistas}}</td> <td>{{$bloqueo_especialistum->fecha_inicio_bloqueo_especialista}}</td> <td>{{$bloqueo_especialistum->fecha_fin_bloqueo_especialista}}</td> <td>{{$bloqueo_especialistum->hora_inicio_bloqueo_especialista}}</td> <td>{{$bloqueo_especialistum->hora_fin_bloqueo_especialista}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('bloqueo_especialistas.show', $bloqueo_especialistum->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('bloqueo_especialistas.edit', $bloqueo_especialistum->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('bloqueo_especialistas.destroy', $bloqueo_especialistum->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $bloqueo_especialistas->render() !!}
            @else
                <h3 class="text-center alert alert-info">Sin información para mostrar</h3>
            @endif

        </div>
    </div>

    <script>
        $('#tablaBloqueos').DataTable(
             {
     
            "language": {
     
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
     
        } ,
         stateSave: true,
         "ordering": false,
     
            
            } );
        </script>

@endsection