@extends('masterRoot')
@section('contenido_Admin')
<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel ">
        <p style="text-align: center; font-size: 3vh;">Configuración Servicio</p>
    </div>
    <br/>
    <div class="panel-body">
            <a class="margin-button-agregar btn btn-success mobile" href="{{ route('servicio.create') }}">Agregar Servicio</a> <span>
            <a class="margin-button-agregar btn btn-success mobile" href="{{ route('recinto_servicios.index') }}">Vincular Recinto</a>
            </span>
            <span>
                <a class="margin-button-agregar btn btn-success mobile" href="{{ route('especialista_servicios.index') }}">Vincular Especialista</a>
            </span>
    </div>

<div class="">
    <div class="panel-heading">
    <div class="">
        <div class="">
            @if($servicios->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($servicios as $servicio)
                            <tr>
                                <td class="text-center"><strong>{{$servicio->id}}</strong></td>

                                <td class="text-center">{{$servicio->nombre}}</td>
                                <td class="text-center">{{$servicio->descripcion}}</td>
                                
                                <td class="text-center">
                                                                       
                                    <a class="btn btn-warning" href="{{ route('servicio.edit', $servicio->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('servicio.destroy', $servicio->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar el servicio {{$servicio->nombre}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {!! $servicios->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay nada para mostrar</h3>
            @endif

        </div>
    </div>
    </div>
</div>
@endsection