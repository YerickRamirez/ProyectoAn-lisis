
@extends('masterPaciente')
@section('contenido_Paciente')
<div class="panel panel-primary">
     <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Citas</p>
    </div>
    <div class="panel-body">
    <section class="">
        <div class="content-c w3-container mobile">
        <div>
            <a class="margin-button-agregar btn btn-success mobile" href="{{ url('combobox') }}">Crear</a> <span>
        </div>
    </div>


    <div>
        <div class="">
        <div class="">
            @if($citas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr> 
                            <th class="text-center">Estado Cita</th>
                            <th class="text-center">Paciente</th> 
                            <th class="text-center">Servicio</th> 
                            <th class="text-center">Especialista</th> 
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($citas as $cita)
                            <tr>
                                <td class="text-center">{{$cita->estadoCita}}</td> 
                                <td class="text-center">{{$cita->nombrePaciente}} {{$cita->apellidoP1}} {{$cita->apellidoP2}}</td> 
                                <td class="text-center">{{$cita->servicio}}</td> 
                                <td class="text-center">{{$cita->nombreEspecialista}} {{$cita->apellidoE1}} {{$cita->apellidoE2}}</td> 
                                <td class="text-center">{{Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y H:i') }}</td>
                                
                                <td class="text-center">
                                    

                                    <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Cancelar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center alert alert-info">No hay citas pendientes</h3>
            @endif

        </div>
    </div>
</div>

@endsection