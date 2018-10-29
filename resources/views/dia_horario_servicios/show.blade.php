@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Dia_horario_servicio / Show #{{$dia_horario_servicio->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('dia_horario_servicios.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('dia_horario_servicios.edit', $dia_horario_servicio->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="dia_horario_servicio icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $dia_horario_servicio->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="dia_horario_servicio icon"></i>Dia</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $dia_horario_servicio->dia }}</h4>
</div>


        </div>

    </div>
@endsection
