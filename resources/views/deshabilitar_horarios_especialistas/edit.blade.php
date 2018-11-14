@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Deshabilitar_horarios_especialista / Edit #{{$deshabilitar_horarios_especialista->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('deshabilitar_horarios_especialistas.update', $deshabilitar_horarios_especialista->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=id-field">Chema=id</label>
	--chema=id--
</div> <div class="form-group">
	<label for="cedula_especialista-field">Cedula_especialista</label>
	<input class="form-control" type="text" name="cedula_especialista" id="cedula_especialista-field" value="{{ old('cedula_especialista', $deshabilitar_horarios_especialista->cedula_especialista ) }}" />
</div> <div class="form-group">
	<label for="fecha_inicio_deshabilitar-field">Fecha_inicio_deshabilitar</label>
	--fecha_inicio_deshabilitar--
</div> <div class="form-group">
	<label for="fecha_fin_deshabilitar-field">Fecha_fin_deshabilitar</label>
	--fecha_fin_deshabilitar--
</div> <div class="form-group">
	<label for="hora_inicio_deshabilitar-field">Hora_inicio_deshabilitar</label>
	--hora_inicio_deshabilitar--
</div> <div class="form-group">
	<label for="hora_fin_deshabilitar-field">Hora_fin_deshabilitar</label>
	--hora_fin_deshabilitar--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('deshabilitar_horarios_especialistas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection