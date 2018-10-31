@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Recinto_servicio / Show #{{$recinto_servicio->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('recinto_servicios.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('recinto_servicios.edit', $recinto_servicio->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="recinto_servicio icon"></i>Chema=recinto_id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $recinto_servicio->chema=recinto_id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="recinto_servicio icon"></i>Servicio_id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $recinto_servicio->servicio_id }}</h4>
</div>


        </div>

    </div>
@endsection
