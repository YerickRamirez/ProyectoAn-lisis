@extends('masterRoot')


@section('contenido_Admin')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('servicios.update', $servicio->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
</div> <div class="form-group">
	<label for="nombre-field">Nombre</label>
	<input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $servicio->nombre ) }}" />
</div> <div class="form-group">
	<label for="descripcion-field">Descripcion</label>
	<input class="form-control" type="text" name="descripcion" id="descripcion-field" 
    value="{{ old('descripcion', $servicio->descripcion ) }}" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('servicios.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            </form>

        </div>
    </div>
@endsection