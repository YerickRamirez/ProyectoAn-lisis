@extends ('masterRoot')
@section ('contenido_Admin')
<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Actualizar datos</p>
    </div>
    <div class="panel-body">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="{{ route('pacientes.updateRoot', $paciente->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="form-group">
                        <label for="cedula_paciente-field">Cédula</label>
                        <input class="form-control" type="text" name="cedula_paciente" id="cedula_paciente-field" value="{{ old('cedula_paciente', $paciente->cedula_paciente ) }}" />
                        <input class="form-control" type="hidden" name="cedula_original" id="cedula_paciente-field" value="{{ old('cedula_paciente', $paciente->cedula_paciente ) }}" />
                        @if ($errors->has('cedula_paciente'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cedula_paciente') }}</strong>
                            </span>
                        @endif
                    </div> 
                    <div class="form-group">
                        <label for="nombre-field">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $paciente->nombre ) }}" />
                    </div> 
                    <div class="form-group">
                        <label for="primer_apellido_paciente(45)-field">Primer Apellido</label>
                        <input class="form-control" type="text" name="primer_apellido_paciente" id="primer_apellido_paciente-field" value="{{ old('primer_apellido_paciente', $paciente->primer_apellido_paciente ) }}" />
                    </div> 
                    <div class="form-group">
                        <label for="segundo_apellido_paciente(45)-field">Segundo Apellido</label>
                        <input class="form-control" type="text" name="segundo_apellido_paciente" id="segundo_apellido_paciente-field" value="{{ old('segundo_apellido_paciente', $paciente->segundo_apellido_paciente ) }}" />
                    </div> 
                    <div class="form-group">
                        <label for="correo-field">Correo</label>
                        <input class="form-control" type="email" name="correo" id="correo-field" value="{{ old('correo', $paciente->correo ) }}" />
                        @if ($errors->has('correo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('correo') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div> 
                    <div class="form-group">
                        <label for="correo-field">Telefono</label>
                        <input class="form-control" type="number" name="telefono" id="telefono-field" value="{{ old('telefono', $paciente->telefono ) }}" pattern="^[0-9]{2,48}" title="No se permiten letras en este campo/ingresar al menos 8 digitos"/>
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    <a class="btn btn-link pull-right" href="{{route('pacientes.index')}}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    
@endsection