@extends('masterRoot')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Especialista / Edit #{{$especialista->id}}</h1>
    </div>
@endsection

@section('contenido_Admin')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('especialistas.update', $especialista->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	
</div> <div class="form-group">
	<label for="cedula_especialista-field">Cedula</label>
	<input class="form-control" type="text" name="cedula_especialista" id="cedula_especialista-field" value="{{ old('cedula_especialista', $especialista->cedula_especialista ) }}" />
</div> <div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $especialista->nombre ) }}" />
</div> <div class="form-group">
	<label for="primer_apellido_especialista-field">Primer Apellido</label>
	<input class="form-control" type="text" name="primer_apellido_especialista" id="primer_apellido_especialista-field" value="{{ old('primer_apellido_especialista', $especialista->primer_apellido_especialista ) }}" />
</div> <div class="form-group">
	<label for="segundo_apellido_especialista-field">Segundo Apellido</label>
	<input class="form-control" type="text" name="segundo_apellido_especialista" id="segundo_apellido_especialista-field" value="{{ old('segundo_apellido_especialista', $especialista->segundo_apellido_especialista ) }}" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('especialistas.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
                </div>
            </form>

        </div>
    </div>
@endsection