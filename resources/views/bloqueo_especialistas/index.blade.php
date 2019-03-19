@extends('masterRoot')

@section('contenido_Admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <div class="panel panel-primary class border-panel " >
     <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Bloqueo Especialista</p>
    </div>
    <div class="panel-body">
    <section class="">
    <div class="page-header clearfix">
            <a class="btn btn-success pull-left" href="{{ route('bloqueo_especialistas.create') }}">Crear</a>
    </div>
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
    <div class="row">
        <div class="col-md-12">
            @if($bloqueo_especialistas->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id='tablaDatos'>
                    <thead>
                        <tr>
                            <th>Especialista</th> <th>Dia bloqueado</th> <th>Fecha inicio bloqueo</th> <th>Fecha fin bloqueo</th> <th>Hora inicio bloqueo</th> <th>Hora fin bloqueo</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bloqueo_especialistas as $bloqueo_especialistum)
                            <tr>

                                <td>{{$bloqueo_especialistum->nombre . ' ' . $bloqueo_especialistum->primer_apellido_especialista . ' ' . $bloqueo_especialistum->segundo_apellido_especialista}}</td>
                                <td>{{$bloqueo_especialistum->dia}}</td> 
                                <td>{{$bloqueo_especialistum->fecha_inicio_bloqueo_especialista}}</td> 
                                <td>{{$bloqueo_especialistum->fecha_fin_bloqueo_especialista}}</td>
                                <td>{{$bloqueo_especialistum->hora_inicio_bloqueo_especialista}}</td> 
                                <td>{{$bloqueo_especialistum->hora_fin_bloqueo_especialista}}</td>
                                
                                <td class="text-right">
                                    <form action="{{ route('bloqueo_especialistas.destroy', $bloqueo_especialistum->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Eliminar?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            @else
                <h3 class="text-center alert alert-info">Sin información para mostrar</h3>
            @endif

        </div>
    </div>
    </section>
    </div>
    </div>
    <script src="{{asset('js/lenguajeTabla.js')}}"></script>

@endsection