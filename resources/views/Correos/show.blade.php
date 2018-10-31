@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Correo / Show #{{$correo->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('correos.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('correos.edit', $correo->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="correo icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $correo->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="correo icon"></i>Paciente_id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $correo->paciente_id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="correo icon"></i>Correo</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $correo->correo }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="correo icon"></i>Prioridad</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $correo->prioridad }}</h4>
</div>


        </div>

    </div>
@endsection
