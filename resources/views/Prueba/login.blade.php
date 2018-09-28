@extends('Prueba.app')
@section('contenido')
    <div class="row">
    <div class="col-md-4 col-md-offset-4">
         <div class="panel-panel-defaul">
         <div class="panel-heading">
         <h1 class="panel-title"> Bienvenido</h1>
         </div>
         <div class="panel-body">
            <form>
            <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input class="form-control" type="text" name="name" placeholder="Ingrese su Nombre">
                </div>
                <div class="form-group">
                    <label for="Apellido">Apellido</label>
                    <input class="form-control" type="text" name="lastName" placeholder="Ingrese su Apellido">
                </div>
                <div class="form-group">
                    <label for="email">Corro Electronico</label>
                    <input class="form-control" type="email" name="email" placeholder="Ingrese su correo">
                </div> 
                <div class="form-group">
                    <label for="password">Contrasenna</label>
                    <input class="form-control" type="password" name="password" placeholder="Ingrese su contrasenna">
                </div> 
                <button class="btn btn-success"> Registrarse</button>
            </form>
         </div>
         </div>
    </div>
    </div>
@endsection