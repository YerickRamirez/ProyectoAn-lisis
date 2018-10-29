@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Telefono / Show #{{$telefono->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('telefonos.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('telefonos.edit', $telefono->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="telefono icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $telefono->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="telefono icon"></i>Paciente_id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $telefono->paciente_id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="telefono icon"></i>Telefono</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $telefono->telefono }}</h4>
</div>


        </div>

    </div>
@endsection
