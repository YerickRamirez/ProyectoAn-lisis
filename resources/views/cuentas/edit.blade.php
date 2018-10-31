@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Cuenta / Edit #{{$cuenta->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('cuentas.update', $cuenta->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="chema=nombre_usuario-field">Chema=nombre_usuario</label>
	<input class="form-control" type="text" name="chema=nombre_usuario" id="chema=nombre_usuario-field" value="{{ old('chema=nombre_usuario', $cuenta->chema=nombre_usuario ) }}" />
</div> <div class="form-group">
	<label for="contrasenna-field">Contrasenna</label>
	<input class="form-control" type="text" name="contrasenna" id="contrasenna-field" value="{{ old('contrasenna', $cuenta->contrasenna ) }}" />
</div> <div class="form-group">
	<label for="tipo-field">Tipo</label>
	<input class="form-control" type="text" name="tipo" id="tipo-field" value="{{ old('tipo', $cuenta->tipo ) }}" />
</div> <div class="form-group">
	<label for="verificado-field">Verificado</label>
	--verificado--
</div> <div class="form-group">
	<label for="codigo_verificacion-field">Codigo_verificacion</label>
	<input class="form-control" type="text" name="codigo_verificacion" id="codigo_verificacion-field" value="{{ old('codigo_verificacion', $cuenta->codigo_verificacion ) }}" />
</div> <div class="form-group">
	<label for="estado_cuenta-field">Estado_cuenta</label>
	--estado_cuenta--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('cuentas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection