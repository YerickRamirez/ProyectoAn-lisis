@extends('masterPaciente')


@section('contenido_Paciente')
<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Actualizar datos</p>
    </div>
    <div class="panel-body">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form action="{{ route('pacientes.update', $variable->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
 <div class="form-group">
	<label for="cedula_paciente-field">Cédula</label>
	<input class="form-control" type="text" name="cedula_paciente" id="cedula_paciente-field" value="{{ old('cedula_paciente', $variable->cedula_paciente ) }}" />
</div> <div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $variable->nombre ) }}" />
</div> <div class="form-group">
	<label for="primer_apellido_paciente(45)-field">Primer Apellido</label>
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="primer_apellido_paciente" id="primer_apellido_paciente-field" value="{{ old('primer_apellido_paciente', $variable->primer_apellido_paciente ) }}" />
</div> <div class="form-group">
	<label for="segundo_apellido_paciente(45)-field">Segundo Apellido</label>
	<input class="form-control" type="text" name="segundo_apellido_paciente" id="segundo_apellido_paciente-field" value="{{ old('segundo_apellido_paciente', $variable->segundo_apellido_paciente ) }}" />
</div> <div class="form-group">
	<label for="correo-field">Correo</label>
	<input class="form-control" type="text" name="correo" id="correo-field" value="{{ old('correo', $variable->correo ) }}" />
</div>
                <a href="{{ url('cambioContrasenna')}}">Cambiar Contraseña</a>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    <a class="btn btn-link pull-right" href="{{ url('paciente') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            </form>

        </div>
    </div>
    </div>
    </div>
    </div>
    
@endsection