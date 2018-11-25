@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Bloqueo_especialistum / Edit #{{$bloqueo_especialistum->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('bloqueo_especialistas.update', $bloqueo_especialistum->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=id-field">Chema=id</label>
	--chema=id--
</div> <div class="form-group">
	<label for="id_especialista(10)-field">Id_especialista(10)</label>
	--id_especialista(10)--
</div> <div class="form-group">
	<label for="id_dia_bloqueo_especialistas(10)-field">Id_dia_bloqueo_especialistas(10)</label>
	--id_dia_bloqueo_especialistas(10)--
</div> <div class="form-group">
	<label for="fecha_inicio_bloqueo_especialista-field">Fecha_inicio_bloqueo_especialista</label>
	--fecha_inicio_bloqueo_especialista--
</div> <div class="form-group">
	<label for="fecha_fin_bloqueo_especialista-field">Fecha_fin_bloqueo_especialista</label>
	--fecha_fin_bloqueo_especialista--
</div> <div class="form-group">
	<label for="hora_inicio_bloqueo_especialista-field">Hora_inicio_bloqueo_especialista</label>
	--hora_inicio_bloqueo_especialista--
</div> <div class="form-group">
	<label for="hora_fin_bloqueo_especialista-field">Hora_fin_bloqueo_especialista</label>
	--hora_fin_bloqueo_especialista--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('bloqueo_especialistas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection