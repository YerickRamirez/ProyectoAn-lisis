@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Dia_bloqueo_especialista
            <a class="btn btn-success pull-right" href="{{ route('dia_bloqueo_especialistas.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($dia_bloqueo_especialistas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Chema=id</th> <th>Dia</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($dia_bloqueo_especialistas as $dia_bloqueo_especialista)
                            <tr>
                                <td class="text-center"><strong>{{$dia_bloqueo_especialista->id}}</strong></td>

                                <td>{{$dia_bloqueo_especialista->chema=id}}</td> <td>{{$dia_bloqueo_especialista->dia}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('dia_bloqueo_especialistas.show', $dia_bloqueo_especialista->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('dia_bloqueo_especialistas.edit', $dia_bloqueo_especialista->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('dia_bloqueo_especialistas.destroy', $dia_bloqueo_especialista->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $dia_bloqueo_especialistas->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection