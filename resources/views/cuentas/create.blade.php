@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Cuenta / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action='{{ url("crearCuenta") }}' method='POST'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

	                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label for="lastName" class="col-md-4 control-label">Primer Apellido</label>

                            <div class="col-md-6">
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('lastName2') ? ' has-error' : '' }}">
                            <label for="lastName2" class="col-md-4 control-label">Segundo Apellido</label>

                            <div class="col-md-6">
                                <input id="lastName2" type="text" class="form-control" name="lastName2" value="{{ old('lastName2') }}" required autofocus>

                                @if ($errors->has('lastName2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                            <label for="cedula" class="col-md-4 control-label">Cédula</label>

                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control" name="cedula" value="{{ old('cedula') }}" required autofocus>

                                @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <br>
                        <div aling="center"class="form">
                        <div class="form-horizontal">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        </div>
                        <br>
                        <br>
                        <div class="div">
                        <div aling="center" class="panel">
                        <div class="radio">
                        <label><input type="radio" name="tipo" value="1" checked>Root</label>
                        </div>
                        <div class="radio">
                        <label><input type="radio" name="tipo" value="2">Especialista</label>
                        </div>
                        <div class="radio">
                        <label><input type="radio" name="tipo" value="3">Asistente</label>
                        </div> 
                        <div class="radio">
                        <label><input type="radio" name="tipo" value="4">Paciente</label>
                        </div> 
                        </div>

                        <br>
                        <div class="panel">
                        <div class="radio">
                        <label><input type="radio" name="flag" value="1" checked>Activado</label>
                        </div>
                        <div class="radio">
                        <label><input type="radio" name="flag" value="0">Desactivado</label>
                        </div>
                        </div>
                        </div>

                <div class="well well-sm">
                <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i> Cambiar datos</button>
                    <a class="btn btn-link pull-right"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection