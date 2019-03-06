@extends('masterRoot')
@section('contenido_Admin')
<script src="{{asset('js/Servicios_Recintos.js')}}"></script>
<div class="panel panel-primary border-panel border-panel">
     <div class="panel-heading bg-color-panel bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Vincular Servicio a Recinto</p>
    </div>
    <br/>
    <div class="panel-body">
            <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropRecintos" class="form-control"></select></div>
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropServicios" class="form-control"></select></div>
        <a class="margin-button-agregar btn btn-success mobile" onclick="vincular()">Vincular</a> <span>
    </div>

    <div>
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
                                        

                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            @else
                <h3 class="text-center alert alert-info">No hay elementos que mostrar</h3>
            @endif

        </div>
        <a class="btn btn-link pull-right" href="{{ route('servicio.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
    </div>
</div>
</div>
</div>

@endsection