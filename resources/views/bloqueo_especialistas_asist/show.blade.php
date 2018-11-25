@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Bloqueo_especialistum / Show #{{$bloqueo_especialistum->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('bloqueo_especialistas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('bloqueo_especialistas.edit', $bloqueo_especialistum->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="bloqueo_especialistum icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $bloqueo_especialistum->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="bloqueo_especialistum icon"></i>Id_especialista(10)</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $bloqueo_especialistum->id_especialista(10) }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="bloqueo_especialistum icon"></i>Id_dia_bloqueo_especialistas(10)</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $bloqueo_especialistum->id_dia_bloqueo_especialistas(10) }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="bloqueo_especialistum icon"></i>Fecha_inicio_bloqueo_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $bloqueo_especialistum->fecha_inicio_bloqueo_especialista }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="bloqueo_especialistum icon"></i>Fecha_fin_bloqueo_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $bloqueo_especialistum->fecha_fin_bloqueo_especialista }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="bloqueo_especialistum icon"></i>Hora_inicio_bloqueo_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $bloqueo_especialistum->hora_inicio_bloqueo_especialista }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="bloqueo_especialistum icon"></i>Hora_fin_bloqueo_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $bloqueo_especialistum->hora_fin_bloqueo_especialista }}</h4>
</div>


        </div>

    </div>
@endsection
