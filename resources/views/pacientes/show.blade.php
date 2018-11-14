@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Paciente / Show #{{$paciente->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('pacientes.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('pacientes.edit', $paciente->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="paciente icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $paciente->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="paciente icon"></i>Nombre_usuario</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $paciente->nombre_usuario }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="paciente icon"></i>Cedula_paciente</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $paciente->cedula_paciente }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="paciente icon"></i>Nombre</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $paciente->nombre }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="paciente icon"></i>Primer_apellido_paciente(45)</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $paciente->primer_apellido_paciente(45) }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="paciente icon"></i>Segundo_apellido_paciente(45)</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $paciente->segundo_apellido_paciente(45) }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="paciente icon"></i>Estado</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $paciente->estado }}</h4>
</div>


        </div>

    </div>
@endsection
