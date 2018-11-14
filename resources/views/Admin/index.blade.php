@extends ('masterRoot')
@section ('contenido_Admin')
<link rel="stylesheet" type="text/css" href="{{asset('css/menus.css')}}">
<div class="panel panel-primary">
      <div class="panel-heading ">
            <p style="text-align: center; font-size: 3vh;">Bienvenido al modulo de administrador del sistema del Servicio de Salud</p></div>
            <div class="panel-body">
            <p style="text-align: center; font-size: 2.5vh;" >Este módulo permite gestionar todas las configraciones necesarias para el mantenimiento del sistema.</p>
            <div class="col-md-6">
                  <div class="panel panel-primary ">
                  <div class="panel-heading inforation-menu">
                  <p class="text-style">Horarios</p></div>
                  <div class="panel-body ">
                  <p style="text-align: center">En esta sección podrá gestionar los horarios de los distintos servicios que se brindan.</p>
                  </div>
                  </div>
            </div>
            <div class="col-md-6">
                  <div class="panel panel-primary">
                  <div class="panel-heading inforation-menu">
                  <p class="text-style">Recintos</p></div>
                  <div class="panel-body ">
                  <p style="text-align: center">En esta sección se puede gestionar los recintos en los cuales se brinda el servicio.</p>
                  </div>
                  </div>
            </div>
            <div class="col-md-6">
                  <div class="panel panel-primary">
                  <div class="panel-heading inforation-menu">
                  <p class="text-style">Servicios</p></div>
                  <div class="panel-body ">
                  <p style="text-align: center">En esta sección podrá administrar los distintos servicios de salud que brinda la universidad.</p>
                  </div>
                  </div>
            </div>
            <div class="col-md-6">
                  <div class="panel panel-primary panel-size">
                  <div class="panel-heading inforation-menu">
                  <p class="text-style">Cuentas</p></div>
                  <div class="panel-body ">
                  <p style="text-align: center">En esta sección podrá gestionar las cuentas de los usuarios, agregar, modificar y eliminar especialistas y pacientes.</p>
                  </div>
                  </div>
            </div>
      </div>
</div>
		
@stop