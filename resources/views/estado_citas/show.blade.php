@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Estado_cita / Show #{{$estado_cita->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('estado_citas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('estado_citas.edit', $estado_cita->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="estado_cita icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $estado_cita->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="estado_cita icon"></i>Descripcion_estado_cita</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $estado_cita->descripcion_estado_cita }}</h4>
</div>


        </div>

    </div>
@endsection
