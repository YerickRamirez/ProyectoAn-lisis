@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Horarios_administrativo / Edit #{{$horarios_administrativo->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('horarios_administrativos.update', $horarios_administrativo->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=id_especialista-field">Chema=id_especialista</label>
	--chema=id_especialista--
</div> <div class="form-group">
	<label for="dia_administrativo-field">Dia_administrativo</label>
	<input class="form-control" type="text" name="dia_administrativo" id="dia_administrativo-field" value="{{ old('dia_administrativo', $horarios_administrativo->dia_administrativo ) }}" />
</div> <div class="form-group">
	<label for="horario_administrativo-field">Horario_administrativo</label>
	<input class="form-control" type="text" name="horario_administrativo" id="horario_administrativo-field" value="{{ old('horario_administrativo', $horarios_administrativo->horario_administrativo ) }}" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('horarios_administrativos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection