@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Cita / Show #{{$cita->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('citas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('citas.edit', $cita->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="cita icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cita->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cita icon"></i>Estado_cita_id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cita->estado_cita_id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cita icon"></i>Paciente_id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cita->paciente_id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cita icon"></i>Servicio_id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cita->servicio_id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cita icon"></i>Fecha_cita</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cita->fecha_cita }}</h4>
</div>


        </div>

    </div>
@endsection
