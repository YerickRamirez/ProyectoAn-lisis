@extends ('masterRoot')
@section ('contenido_Admin')
<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Crear Cuenta</p>
    </div>
    <div class="panel-body">

    <div class="row">
        <div class="col-md-10 col-md-offset-1 ">

            <form class="form-horizontal" action='{{ url("crearCuenta") }}' method='POST'>
            {{ csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="name" ><strong>Tipo de usuario</strong></label> 
                        <div class="radio">
                        <label><input type="radio" name="tipo" value="1" checked>Administrador</label>
                        
                        
                        <label style="margin-left: 15px;"><input type="radio" name="tipo" value="2">Especialista</label>
                      
                        
                        <label style="margin-left: 15px;"><input type="radio" name="tipo" value="3">Asistente</label>
                        
                        
                        <label style="margin-left: 15px;"><input type="radio" name="tipo" value="4">Paciente</label>
                      </div>
                        <br>
                        
                        
	                    <!--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">-->
                            <div class="row">
                            <div class="col-md-3">

                                <label for="name" >Nombre</label> <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto, solo se permiten letras">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        <!--</div>-->
                        
                        <!--<div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">-->
                            

                            <div class="col-md-3">
                                <label for="lastName" class="">Primer Apellido</label>
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto, solo se permiten letras">

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        <!--</div>-->
                        
                        <!--<div class="form-group{{ $errors->has('lastName2') ? ' has-error' : '' }}">-->
                            
                            <div class="col-md-3">
                                <label for="lastName2" class="">Segundo Apellido</label>
                                <input id="lastName2" type="text" class="form-control" name="lastName2" value="{{ old('lastName2') }}" required autofocus pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto, solo se permiten letras">

                                @if ($errors->has('lastName2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName2') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3{{ $errors->has('cedula') ? ' has-error' : '' }}">
                                 <label for="cedula" class="control-label">Cédula</label>
                                <input id="cedula" type="text" class="form-control" name="cedula" value="{{ old('cedula') }}" autofocus required pattern="^[0-9]{7,20}" title="Formato incorrecto, favor ingresar cédula con ceros y sin espacios">

                                @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--</div>-->
                        <!--<div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">-->
                           

                        <!--</div>-->
                        <!--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">-->
                            <br>
                            <div class="row">
                            
                            <div class="col-md-3{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">Correo Electrónico</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>El correo ya se encuentra registrado</strong>
                                    </span>
                                @endif
                            </div>
                        <!--</div>-->
            
                        <!--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">-->
                            
                            <div class="col-md-3">
                                <label for="password" class="control-label">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required minlength="6">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        <!--</div>-->
   
                        <div aling="center"class="form">
                        <div class="form-horizontal">
                           

                            <div class="col-md-3">
                                 <label for="password-confirm" class=" control-label">Confirmar Contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="6">
                            </div>
                        </div>
                        
                        <div class="col-md-3{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class=" control-label">Telefono</label>
                           <input id="telefono" type="text" class="form-control" name="telefono" pattern="^[0-9]{4,10}" title="No se permiten letras en este campo/ingresar de 4-10 digitos">
                           @if ($errors->has('telefono'))
                           <span class="help-block">
                               <strong>{{ $errors->first('telefono') }}</strong>
                           </span>
                       @endif
                        </div>
                        </div>
                    </div>
                        <div class="div">
                        <br>
                        <div class="panel">
                            <label for="name" ><strong>Estado Cuenta</strong></label> 
                        <div class="radio">
                        <label><input type="radio" name="flag" value="1" checked>Activado</label>
                        </div>
                        <div class="radio">
                        <label><input type="radio" name="flag" value="0">Desactivado</label>
                        </div>
                        </div>
                        </div>

                <div class="well well-sm">
                <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                    <a href="{{ route('cuentas.index') }}" class="btn btn-link pull-right"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
@endsection