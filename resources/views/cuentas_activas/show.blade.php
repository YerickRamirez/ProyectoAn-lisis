@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Cuentas_activa / Show #{{$cuentas_activa->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('cuentas_activas.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('cuentas_activas.edit', $cuentas_activa->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="four wide column">
  <h4><i class="cuentas_activa icon"></i>Chema=id</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cuentas_activa->chema=id }}</h4>
</div>
 <div class="four wide column">
  <h4><i class="cuentas_activa icon"></i>Cuentas_activas</h4>
</div>
<div class="twelve wide column">
  <h4>{{ $cuentas_activa->cuentas_activas }}</h4>
</div>


        </div>

    </div>
@endsection
