@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Cita / Edit #{{$cita->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('citas.update', $cita->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=id-field">Chema=id</label>
	--chema=id--
</div> <div class="form-group">
	<label for="estado_cita_id-field">Estado_cita_id</label>
	--estado_cita_id--
</div> <div class="form-group">
	<label for="paciente_id-field">Paciente_id</label>
	--paciente_id--
</div> <div class="form-group">
	<label for="servicio_id-field">Servicio_id</label>
	--servicio_id--
</div> <div class="form-group">
	<label for="fecha_cita-field">Fecha_cita</label>
	--fecha_cita--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('citas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection