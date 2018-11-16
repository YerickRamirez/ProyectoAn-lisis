@extends('masterRoot')
@section('header')
    <div class="page-header">
        <h1>Especialista / Show #{{$especialista->id}}</h1>
    </div>
@endsection

@section('contenido_Admin')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('especialistas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('especialistas.edit', $especialista->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
</div>
 <div class="four wide column">
  <h4><i class="especialista icon"></i>Cedula_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $especialista->cedula_especialista }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="especialista icon"></i>Nombre</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $especialista->nombre }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="especialista icon"></i>Primer_apellido_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $especialista->primer_apellido_especialista }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="especialista icon"></i>Segundo_apellido_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $especialista->segundo_apellido_especialista }}</h4>
</div>
        </div>

    </div>
@endsection
