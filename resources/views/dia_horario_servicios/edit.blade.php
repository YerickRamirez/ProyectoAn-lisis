@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Dia_horario_servicio / Edit #{{$dia_horario_servicio->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('dia_horario_servicios.update', $dia_horario_servicio->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=id-field">Chema=id</label>
	--chema=id--
</div> <div class="form-group">
	<label for="dia-field">Dia</label>
	<input class="form-control" type="text" name="dia" id="dia-field" value="{{ old('dia', $dia_horario_servicio->dia ) }}" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('dia_horario_servicios.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection