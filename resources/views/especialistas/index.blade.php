@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Especialista
            <a class="btn btn-success pull-right" href="{{ route('especialistas.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($especialistas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Chema=id</th> <th>Cedula_especialista</th> <th>Nombre_usuario</th> <th>Nombre</th> <th>Primer_apellido_especialista</th> <th>Segundo_apellido_especialista</th> <th>Estado</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($especialistas as $especialista)
                            <tr>
                                <td class="text-center"><strong>{{$especialista->id}}</strong></td>

                                <td>{{$especialista->chema=id}}</td> <td>{{$especialista->cedula_especialista}}</td> <td>{{$especialista->nombre_usuario}}</td> <td>{{$especialista->nombre}}</td> <td>{{$especialista->primer_apellido_especialista}}</td> <td>{{$especialista->segundo_apellido_especialista}}</td> <td>{{$especialista->estado}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('especialistas.show', $especialista->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('especialistas.edit', $especialista->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('especialistas.destroy', $especialista->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $especialistas->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection