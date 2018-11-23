@extends ('masterRoot')
@section ('contenido_Admin')
<!--Espacio arriba-->
<div class="content w3-container"></div>
<div class="content w3-container"></div>

<div class="col-md-2"></div>
<div class="col-md-6" style="font-size: 4vh; " >
<div class="w4-container">
<form action="">

   <a  class="btn btn-success"href="{{ url('cuentas/create') }} " >Registrar </a>
   <br>
   <a  class="btn btn-success" href="{{ url('cuentas/create') }} " >Crear </a>
    <br>
  <a class="btn btn-success"  href="{{ url('cuentas/create') }} " >Modificar </a>
    <br>
   <a  class="btn btn-success" href="{{ url('cuentas/create') }} " >Eliminar </a>
   <br>

</form>
</div>
<div class="col-md-2" style="aling-items: left; justify-content: center;"></div>
@endsection