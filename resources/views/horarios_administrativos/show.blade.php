@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Horarios_administrativo / Show #{{$horarios_administrativo->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('horarios_administrativos.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('horarios_administrativos.edit', $horarios_administrativo->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="horarios_administrativo icon"></i>Chema=id_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_administrativo->chema=id_especialista }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_administrativo icon"></i>Dia_administrativo</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_administrativo->dia_administrativo }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="horarios_administrativo icon"></i>Horario_administrativo</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $horarios_administrativo->horario_administrativo }}</h4>
</div>


        </div>

    </div>
@endsection
