@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Deshabilitar_horarios_especialista
            <a class="btn btn-success pull-right" href="{{ route('deshabilitar_horarios_especialistas.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($deshabilitar_horarios_especialistas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Chema=id</th> <th>Cedula_especialista</th> <th>Fecha_inicio_deshabilitar</th> <th>Fecha_fin_deshabilitar</th> <th>Hora_inicio_deshabilitar</th> <th>Hora_fin_deshabilitar</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($deshabilitar_horarios_especialistas as $deshabilitar_horarios_especialista)
                            <tr>
                                <td class="text-center"><strong>{{$deshabilitar_horarios_especialista->id}}</strong></td>

                                <td>{{$deshabilitar_horarios_especialista->chema=id}}</td> <td>{{$deshabilitar_horarios_especialista->cedula_especialista}}</td> <td>{{$deshabilitar_horarios_especialista->fecha_inicio_deshabilitar}}</td> <td>{{$deshabilitar_horarios_especialista->fecha_fin_deshabilitar}}</td> <td>{{$deshabilitar_horarios_especialista->hora_inicio_deshabilitar}}</td> <td>{{$deshabilitar_horarios_especialista->hora_fin_deshabilitar}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('deshabilitar_horarios_especialistas.show', $deshabilitar_horarios_especialista->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('deshabilitar_horarios_especialistas.edit', $deshabilitar_horarios_especialista->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('deshabilitar_horarios_especialistas.destroy', $deshabilitar_horarios_especialista->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $deshabilitar_horarios_especialistas->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection