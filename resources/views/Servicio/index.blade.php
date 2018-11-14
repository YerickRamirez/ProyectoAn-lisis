@extends('masterRoot')

@section('encabezado')
    
@endsection

@section('contenido_Admin')
<div class="page-header clearfix">
        <h1>
            <a class="btn btn-success pull-right" href="{{ route('servicio.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($servicios->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Descripcion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($servicios as $servicio)
                            <tr>
                                <td class="text-center"><strong>{{$servicio->id}}</strong></td>

                                <td class="text-center">{{$servicio->nombre}}</td>
                                <td class="text-center">{{$servicio->descripcion}}</td>
                                
                                <td class="text-right">
                                                                       
                                    <a class="btn btn-xs btn-warning" href="{{ route('servicio.edit', $servicio->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('servicio.destroy', $servicio->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $servicios->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay nada para mostrar</h3>
            @endif

        </div>
    </div>

@endsection