@extends('masterRoot')

@section('contenido_Admin')
<div class="panel panel-primary border-panel">
        <div class="panel-heading  bg-color-panel">
           <p style="text-align: center; font-size: 3vh;">Editar cuenta de {{$cuenta->name . ' ' . $cuenta->lastName}}</p>
       </div>
       <div class="panel-body">
           <section class="">
           <div class="content-c w3-container mobile">
           <div>

    <div class="row">
            <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{ route('cuentas.update', $cuenta->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name-field">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name-field" required value="{{ old('name', $cuenta->name) }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto" />
                </div> 
                <div class="form-group">
                    <label for="lastName-field">Primer Apellido</label>
                    <?php $apellidos = explode(" ", $cuenta->lastName, 2); 
                    $lastName2 = "";
                    $countApellidos = count($apellidos);
                        if($countApellidos >= 2) {
                            for($i=1; $i<$countApellidos; $i++){
                                $lastName2 = $lastName2 . ' ' . $apellidos[$i];
                            }
                        }
                    ?>
                    <input class="form-control" type="text" name="lastName" id="lastName-field" required value="{{ old('lastName', $apellidos[0]) }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto"/>
                </div>
                <div class="form-group">
                    <label for="lastName2-field">Segundo Apellido</label>
                    <input class="form-control" type="text" name="lastName2" id="lastName2-field" required value="{{ old('lastName2', $lastName2) }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,30}" title="Favor ingresar un formato correcto" />
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email-field">Correo</label>
                    <input class="form-control" type="email" name="email" id="email-field" required value="{{ old('email', $cuenta->email) }}" required/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div> 
                
                <!--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password-field">Contraseña</label>
                <input class="form-control" type="password" name="password" id="password-field" required/>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                </div> 

                <div class="form-group">
                    <label for="password-confirm-field">Confirmar Contraseña</label>
                    <input class="form-control" type="password" name="password-confirm" id="password-confirm-field" required/>
                </div>-->

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a class="btn btn-link pull-right" href="{{ route('cuentas.index') }}"><i class="glyphicon glyphicon-backward"></i>Volver</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection