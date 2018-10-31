@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Horarios_servicio / Show #{{$horarios_servicio->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('horarios_servicios.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('horarios_servicios.edit', $horarios_servicio->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="horarios_servicio icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_servicio->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_servicio icon"></i>Id_dia</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_servicio->id_dia }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_servicio icon"></i>Id_servicio</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_servicio->id_servicio }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_servicio icon"></i>Id_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_servicio->id_especialista }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_servicio icon"></i>Fecha_inicio_servicio</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_servicio->fecha_inicio_servicio }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_servicio icon"></i>Fecha_fin_servicio</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_servicio->fecha_fin_servicio }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_servicio icon"></i>Hora_inicio_servicio</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_servicio->hora_inicio_servicio }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_servicio icon"></i>Hora_fin_servicio</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_servicio->hora_fin_servicio }}</h4>
</div>


        </div>

    </div>
@endsection
