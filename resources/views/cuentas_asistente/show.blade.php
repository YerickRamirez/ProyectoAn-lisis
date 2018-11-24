@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Cuenta / Show #{{$cuenta->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('cuentas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('cuentas.edit', $cuenta->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="cuenta icon"></i>Chema=nombre_usuario</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cuenta->chema=nombre_usuario }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cuenta icon"></i>Contrasenna</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cuenta->contrasenna }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cuenta icon"></i>Tipo</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cuenta->tipo }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cuenta icon"></i>Verificado</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cuenta->verificado }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cuenta icon"></i>Codigo_verificacion</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cuenta->codigo_verificacion }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cuenta icon"></i>Estado_cuenta</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cuenta->estado_cuenta }}</h4>
</div>


        </div>

    </div>
@endsection
