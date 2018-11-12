@extends('masterRoot')
@section('contenido_Admin')
@include('error')

    <div class="row">
        <div class="col-md-12">
<h3> Crear Servicio</h3>
<br>
            <form action="{{ route('servicio.store') }}" method='POST'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
</div> <div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" id="nombre" value="" />
</div> <div class="form-group">
	<label for="descripcion-field">Descripcion</label>
	<input class="form-control" type="text" name="descripcion" id="descripcion" value="" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <a class="btn btn-link pull-right" href="{{ route('servicio.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
                </div>
            </form>

        </div>
    </div>
@endsection