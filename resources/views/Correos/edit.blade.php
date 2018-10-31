@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Correo / Edit #{{$correo->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('correos.update', $correo->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=id-field">Chema=id</label>
	--chema=id--
</div> <div class="form-group">
	<label for="paciente_id-field">Paciente_id</label>
	--paciente_id--
</div> <div class="form-group">
	<label for="correo-field">Correo</label>
	<input class="form-control" type="text" name="correo" id="correo-field" value="{{ old('correo', $correo->correo ) }}" />
</div> <div class="form-group">
	<label for="prioridad-field">Prioridad</label>
	--prioridad--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('correos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection