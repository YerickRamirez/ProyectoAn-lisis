@extends('masterRoot')
@section('contenido_Admin')

<script src="{{asset('js/Servicio_Especialista.js')}}"></script>
<div class="panel panel-primary border-panel">
     <div class="panel-heading bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Vincular Especialista a Servicio</p>
    </div>
    <br/>
    <div class="panel-body">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{@session('message')}}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{@session('error')}}
            </div>
            @endif
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropRecintos" class="form-control"></select></div>
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropServicios" class="form-control"></select></div>
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropEspecialistas" class="form-control"></select></div>
         <span>
        <div>
            <a class="margin-button-agregar btn btn-success mobile" onclick="vincular()">Vincular</a>
        </div>
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
                            <th class="text-center">Servicio</th> 
                            <th class="text-center">Recinto</th>
                            <th class="text-center">Especialista</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($vinculos as $especialista_servicio)
                            <tr>
                                
                                <td class="text-center">{{$especialista_servicio->Servicio}}</td>
                                <td class="text-center">{{$especialista_servicio->Recinto}}</td>
                                 <td class="text-center">{{$especialista_servicio->nombreEspecialista}} {{$especialista_servicio->apellido1}} {{$especialista_servicio->apellido2}}</td>
                                
                                <td class="text-center">

                                    <form action="{{ route('eliminarVinculoEspecialista1', ['servicio'=>$especialista_servicio->id_servicio, 
                                    'recinto'=>$especialista_servicio->id_recinto, 'especialista'=>$especialista_servicio->id_especialista]) }}" 
                                    style="display: inline;" onsubmit="return confirm('¿Desea eliminarlo?');">

                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center alert alert-info">No hay elementos para mostrar</h3>
            @endif

        </div>
        <a class="btn btn-link pull-right" href="{{ route('servicio.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
    </div>
    </div>
    </div>
    </div>
@endsection