@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Horarios_administrativo
            <a class="btn btn-success pull-right" href="{{ route('horarios_administrativos.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($horarios_administrativos->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Chema=id_especialista</th> <th>Dia_administrativo</th> <th>Horario_administrativo</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($horarios_administrativos as $horarios_administrativo)
                            <tr>
                                <td class="text-center"><strong>{{$horarios_administrativo->id}}</strong></td>

                                <td>{{$horarios_administrativo->chema=id_especialista}}</td> <td>{{$horarios_administrativo->dia_administrativo}}</td> <td>{{$horarios_administrativo->horario_administrativo}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('horarios_administrativos.show', $horarios_administrativo->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('horarios_administrativos.edit', $horarios_administrativo->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('horarios_administrativos.destroy', $horarios_administrativo->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $horarios_administrativos->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection