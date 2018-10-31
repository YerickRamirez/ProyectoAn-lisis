@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Horarios_servicio
            <a class="btn btn-success pull-right" href="{{ route('horarios_servicios.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($horarios_servicios->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Chema=id</th> <th>Id_dia</th> <th>Id_servicio</th> <th>Id_especialista</th> <th>Fecha_inicio_servicio</th> <th>Fecha_fin_servicio</th> <th>Hora_inicio_servicio</th> <th>Hora_fin_servicio</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($horarios_servicios as $horarios_servicio)
                            <tr>
                                <td class="text-center"><strong>{{$horarios_servicio->id}}</strong></td>

                                <td>{{$horarios_servicio->chema=id}}</td> <td>{{$horarios_servicio->id_dia}}</td> <td>{{$horarios_servicio->id_servicio}}</td> <td>{{$horarios_servicio->id_especialista}}</td> <td>{{$horarios_servicio->fecha_inicio_servicio}}</td> <td>{{$horarios_servicio->fecha_fin_servicio}}</td> <td>{{$horarios_servicio->hora_inicio_servicio}}</td> <td>{{$horarios_servicio->hora_fin_servicio}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('horarios_servicios.show', $horarios_servicio->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('horarios_servicios.edit', $horarios_servicio->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('horarios_servicios.destroy', $horarios_servicio->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $horarios_servicios->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection