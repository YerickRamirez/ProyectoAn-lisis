@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Paciente
            <a class="btn btn-success pull-right" href="{{ route('pacientes.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($pacientes->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Chema=id</th> <th>Nombre_usuario</th> <th>Cedula_paciente</th> <th>Nombre</th> <th>Primer_apellido_paciente(45)</th> <th>Segundo_apellido_paciente(45)</th> <th>Estado</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pacientes as $paciente)
                            <tr>
                                <td class="text-center"><strong>{{$paciente->id}}</strong></td>

                                <td>{{$paciente->chema=id}}</td> <td>{{$paciente->nombre_usuario}}</td> <td>{{$paciente->cedula_paciente}}</td> <td>{{$paciente->nombre}}</td> <td>{{$paciente->primer_apellido_paciente(45)}}</td> <td>{{$paciente->segundo_apellido_paciente(45)}}</td> <td>{{$paciente->estado}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('pacientes.show', $paciente->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('pacientes.edit', $paciente->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $pacientes->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection