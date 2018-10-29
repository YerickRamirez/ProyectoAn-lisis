@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Horarios_servicio / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('horarios_servicios.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=id-field">Chema=id</label>
	--chema=id--
</div> <div class="form-group">
	<label for="id_dia-field">Id_dia</label>
	--id_dia--
</div> <div class="form-group">
	<label for="id_servicio-field">Id_servicio</label>
	--id_servicio--
</div> <div class="form-group">
	<label for="id_especialista-field">Id_especialista</label>
	--id_especialista--
</div> <div class="form-group">
	<label for="fecha_inicio_servicio-field">Fecha_inicio_servicio</label>
	--fecha_inicio_servicio--
</div> <div class="form-group">
	<label for="fecha_fin_servicio-field">Fecha_fin_servicio</label>
	--fecha_fin_servicio--
</div> <div class="form-group">
	<label for="hora_inicio_servicio-field">Hora_inicio_servicio</label>
	--hora_inicio_servicio--
</div> <div class="form-group">
	<label for="hora_fin_servicio-field">Hora_fin_servicio</label>
	--hora_fin_servicio--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('horarios_servicios.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection