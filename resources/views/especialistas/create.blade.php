@extends('masterRoot')
@section('contenido_Admin')
    @include('error')

<div class="panel panel-primary">
     <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Configuración Especialistas</p>
    </div>

<div class="page-header">
    <div class="panel-heading">
    <div class="">
        <div class="">

            <form action="{{ route('especialistas.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	
</div> <div class="form-group">
	<label for="cedula_especialista-field">Cedula</label>
	<input class="form-control" type="text" name="cedula_especialista" id="cedula_especialista-field" value="" />
</div> <div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" id="nombre-field" value="" />
</div> <div class="form-group">
	<label for="primer_apellido_especialista-field">Primer Apellido</label>
	<input class="form-control" type="text" name="primer_apellido_especialista" id="primer_apellido_especialista-field" value="" />
</div> <div class="form-group">
	<label for="segundo_apellido_especialista-field">Segundo Apellido</label>
	<input class="form-control" type="text" name="segundo_apellido_especialista" id="segundo_apellido_especialista-field" value="" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('especialistas.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
                </div>
            </form>

        </div>
    </div>
@endsection