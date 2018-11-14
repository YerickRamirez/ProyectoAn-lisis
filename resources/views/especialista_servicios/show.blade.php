@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Especialista_servicio / Show #{{$especialista_servicio->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('especialista_servicios.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('especialista_servicios.edit', $especialista_servicio->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="especialista_servicio icon"></i>Chema=id_servicio</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $especialista_servicio->chema=id_servicio }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="especialista_servicio icon"></i>Id_especialista</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $especialista_servicio->id_especialista }}</h4>
</div>


        </div>

    </div>
@endsection
