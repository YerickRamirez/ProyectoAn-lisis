@extends('masterRoot')
@section('contenido_Admin')
<script src="{{asset('js/Servicios_Recintos.js')}}"></script>
<div class="panel panel-primary">
     <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Vincular Servicio a Recinto</p>
    </div>
    <br/>
    <div class="panel-body">
            <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropRecintos" class="form-control"></select></div>
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropServicios" class="form-control"></select></div>
        <a class="margin-button-agregar btn btn-success mobile" onclick="vincular()">Crear</a> <span>
    </div>

    <div class="page-header clearfix">
    <div class="panel-heading">
    <div class="">
        <div class="">
            @if($vinculos->count())
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Recinto</th> 
                            <th class="text-center">Servicio</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($vinculos as $recinto_servicio)
                            <tr>
                                <!--td class="text-center"><strong>{{$recinto_servicio->id}}</strong></td-->

                                <td class="text-center">{{$recinto_servicio->descripcion}}</td> 
                                <td class="text-center">{{$recinto_servicio->nombre}}</td>
                                
                                <td class="text-center">
        
                                    <form action="{{ route('eliminarVinculo1', ['servicio'=>$recinto_servicio->servicio_id, 'recinto'=>$recinto_servicio->recinto_id]) }}" style="display: inline;" onsubmit="return confirm('¿Desea eliminarlo?');">
                                        

                                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>
    </div>

@endsection