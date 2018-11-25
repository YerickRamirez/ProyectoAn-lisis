@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Deshabilitar_horarios_especialista / Show #{{$deshabilitar_horarios_especialista->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('deshabilitar_horarios_especialistas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('deshabilitar_horarios_especialistas.edit', $deshabilitar_horarios_especialista->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="deshabilitar_horarios_especialista icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $deshabilitar_horarios_especialista->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="deshabilitar_horarios_especialista icon"></i>Cedula_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $deshabilitar_horarios_especialista->cedula_especialista }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="deshabilitar_horarios_especialista icon"></i>Fecha_inicio_deshabilitar</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $deshabilitar_horarios_especialista->fecha_inicio_deshabilitar }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="deshabilitar_horarios_especialista icon"></i>Fecha_fin_deshabilitar</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $deshabilitar_horarios_especialista->fecha_fin_deshabilitar }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="deshabilitar_horarios_especialista icon"></i>Hora_inicio_deshabilitar</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $deshabilitar_horarios_especialista->hora_inicio_deshabilitar }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="deshabilitar_horarios_especialista icon"></i>Hora_fin_deshabilitar</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $deshabilitar_horarios_especialista->hora_fin_deshabilitar }}</h4>
</div>


        </div>

    </div>
@endsection
