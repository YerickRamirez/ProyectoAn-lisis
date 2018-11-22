@extends('masterPaciente')


@section('contenido_Paciente')
    <div class="row">
        <div class="col-md-12">

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
@endsection