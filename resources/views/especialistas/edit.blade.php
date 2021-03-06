@extends('masterRoot')

@section('contenido_Admin')
    
    <div class="panel panel-primary border-panel">
     <div class="panel-heading bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Editar Especialista</p>
    </div>
    <br/>
    <div class="panel-body">
    <div class="row">
    <div class="col-md-6 col-md-offset-3">

            <form action="{{ route('especialistas.update', $especialista->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	
</div> <div class="form-group">
	<label for="cedula_especialista-field">Cedula</label>
	<input class="form-control" type="text" name="cedula_especialista" placeholder="Ingrese su cedula" id="cedula_especialista-field" value="{{ old('cedula_especialista', $especialista->cedula_especialista ) }}" required pattern="^[0-9]{7,20}" title="Formato incorrecto, favor ingresar cédula con ceros y sin espacios"/>
    <input class="form-control" type="hidden" name="cedula_original" placeholder="Ingrese su cedula" id="cedula_especialista-field" value="{{ old('cedula_especialista', $especialista->cedula_especialista ) }}"/>
    @if ($errors->has('cedula_especialista'))
                <span class="help-block">
                    <strong>{{ $errors->first('cedula_especialista') }}</strong>
                </span>
    @endif
</div> 
<div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" placeholder="Ingrese su nombre " id="nombre-field" value="{{ old('nombre', $especialista->nombre ) }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto"/>
</div> <div class="form-group">
	<label for="primer_apellido_especialista-field">Primer Apellido</label>
	<input class="form-control" type="text" name="primer_apellido_especialista" placeholder="Ingrese su primer apellido" id="primer_apellido_especialista-field" value="{{ old('primer_apellido_especialista', $especialista->primer_apellido_especialista ) }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto"/>
</div> <div class="form-group">
	<label for="segundo_apellido_especialista-field">Segundo Apellido</label>
	<input class="form-control" type="text" name="segundo_apellido_especialista" placeholder="Ingrese su segundo apellido" id="segundo_apellido_especialista-field" value="{{ old('segundo_apellido_especialista', $especialista->segundo_apellido_especialista ) }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto"/>
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('especialistas.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
                </div>
            </form>

        </div>
    </div>
    </div>
    </div>
@endsection