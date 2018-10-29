@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Cuenta
            <a class="btn btn-success pull-right" href="{{ route('cuentas.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($cuentas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Chema=nombre_usuario</th> <th>Contrasenna</th> <th>Tipo</th> <th>Verificado</th> <th>Codigo_verificacion</th> <th>Estado_cuenta</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($cuentas as $cuenta)
                            <tr>
                                <td class="text-center"><strong>{{$cuenta->id}}</strong></td>

                                <td>{{$cuenta->chema=nombre_usuario}}</td> <td>{{$cuenta->contrasenna}}</td> <td>{{$cuenta->tipo}}</td> <td>{{$cuenta->verificado}}</td> <td>{{$cuenta->codigo_verificacion}}</td> <td>{{$cuenta->estado_cuenta}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('cuentas.show', $cuenta->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('cuentas.edit', $cuenta->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('cuentas.destroy', $cuenta->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $cuentas->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection