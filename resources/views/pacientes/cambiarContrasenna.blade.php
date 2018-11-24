@extends('masterPaciente')
@section('contenido_Paciente')

<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Cambiar Contraseña</p>
    </div>
    <div class="panel-body">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form action="{{ route('contrasennas.update', Auth::user()->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
<div class="form-group">
	<label for="password">Contraseña</label>
    <input class="form-control" type="password" name="password" id="password" required/>
    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
</div> <div class="form-group">
	<label for="password-confirm">Confirmar Contraseña</label>
	<input class="form-control" type="password" name="password_confirmation" id="password-confirm" required/>
</div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                    <a class="btn btn-link pull-right" href="{{ url('paciente') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            </form>

        </div>
    </div>
    </div>
    </div>
    </div>
@endsection