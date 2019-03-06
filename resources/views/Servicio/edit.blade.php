@extends('masterRoot')


@section('contenido_Admin')
    @include('error')
    <div class="panel panel-primary border-panel">
    <div class="panel-heading bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Editar Servicio</p>
    </div>
    <div class="panel-body">
        <section class="">
    <div class="row">
    <div class="col-md-6 col-md-offset-3">

            <form action="{{ route('servicio.update', $servicio->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group"> </div> 
                <div class="form-group">
                    <label for="nombre-field">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="nombre-field" value="{{ old('nombre', $servicio->nombre ) }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto"/>
                </div> <div class="form-group">
                    <label for="descripcion-field">Descripcion</label>
                    <input class="form-control" type="text" name="descripcion" id="descripcion-field" 
                    value="{{ old('descripcion', $servicio->descripcion ) }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto"/>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('servicio.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            </form>

        </div>
    </div>
    </div>
    </section>
    </div>
@endsection