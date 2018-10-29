@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Bloqueo_especialistum
            <a class="btn btn-success pull-right" href="{{ route('bloqueo_especialistas.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($bloqueo_especialistas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Chema=id</th> <th>Id_especialista(10)</th> <th>Id_dia_bloqueo_especialistas(10)</th> <th>Fecha_inicio_bloqueo_especialista</th> <th>Fecha_fin_bloqueo_especialista</th> <th>Hora_inicio_bloqueo_especialista</th> <th>Hora_fin_bloqueo_especialista</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bloqueo_especialistas as $bloqueo_especialistum)
                            <tr>
                                <td class="text-center"><strong>{{$bloqueo_especialistum->id}}</strong></td>

                                <td>{{$bloqueo_especialistum->chema=id}}</td> <td>{{$bloqueo_especialistum->id_especialista(10)}}</td> <td>{{$bloqueo_especialistum->id_dia_bloqueo_especialistas(10)}}</td> <td>{{$bloqueo_especialistum->fecha_inicio_bloqueo_especialista}}</td> <td>{{$bloqueo_especialistum->fecha_fin_bloqueo_especialista}}</td> <td>{{$bloqueo_especialistum->hora_inicio_bloqueo_especialista}}</td> <td>{{$bloqueo_especialistum->hora_fin_bloqueo_especialista}}</td>
                                
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
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection