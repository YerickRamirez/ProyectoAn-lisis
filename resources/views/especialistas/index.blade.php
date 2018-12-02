@extends('masterRoot')
@section('contenido_Admin')

<div class="panel panel-primary border-panel">
     <div class="panel-heading bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Configuración Especialistas</p>
    </div>
    <br/>
    <div class="panel-body">
            <a class="margin-button-agregar btn btn-success mobile" href="{{ route('especialistas.create') }}"> Crear</a>
            <span>
                <a class="margin-button-agregar btn btn-success mobile" href="{{ route('especialista_servicios.index') }}">Vincular Especialista</a>
            </span>
    </div>
    
<div class="">
    <div class="panel-heading">
    <div class="">
        <div class="">
            @if($especialistas->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Cédula</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Primer Apellido</th>
                            <th class="text-center">Segundo Apellido</th>
                            <th class="text-center">Opciones</th>
                        
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($especialistas as $especialista)
                            <tr>

                                <td class="text-center">{{$especialista->cedula_especialista}}</td>
                                <td class="text-center">{{$especialista->nombre}}</td> 
                                <td class="text-center">{{$especialista->primer_apellido_especialista}}</td> 
                                <td class="text-center">{{$especialista->segundo_apellido_especialista}}</td>
                                
                                <td class="text-center">
                                    
                                    <a class="btn btn-warning" href="{{ route('especialistas.edit', $especialista->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('especialistas.destroy', $especialista->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar al especialista {{$especialista->nombre}}?');">
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
                {!! $especialistas->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vacío</h3>
            @endif

        </div>
    </div>
    </div> 
    </div>

@endsection