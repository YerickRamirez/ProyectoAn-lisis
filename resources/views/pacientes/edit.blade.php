@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Paciente / Edit #{{$paciente->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=id-field">Chema=id</label>
	--chema=id--
</div> <div class="form-group">
	<label for="nombre_usuario-field">Nombre_usuario</label>
	<input class="form-control" type="text" name="nombre_usuario" id="nombre_usuario-field" value="{{ old('nombre_usuario', $paciente->nombre_usuario ) }}" />
</div> <div class="form-group">
	<label for="cedula_paciente-field">Cedula_paciente</label>
	<input class="form-control" type="text" name="cedula_paciente" id="cedula_paciente-field" value="{{ old('cedula_paciente', $paciente->cedula_paciente ) }}" />
</div> <div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $paciente->nombre ) }}" />
</div> <div class="form-group">
	<label for="primer_apellido_paciente(45)-field">Primer_apellido_paciente(45)</label>
	--primer_apellido_paciente(45)--
</div> <div class="form-group">
	<label for="segundo_apellido_paciente(45)-field">Segundo_apellido_paciente(45)</label>
	--segundo_apellido_paciente(45)--
</div> <div class="form-group">
	<label for="estado-field">Estado</label>
	--estado--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('pacientes.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection