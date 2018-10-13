@extends ('masterRoot')
@section ('contenido_Admin')
<!--Espacio arriba-->
<div class="content w3-container"></div>
<div class="content w3-container"></div>

<div class="col-md-2"></div>
<div class="col-md-6" style="font-size: 4vh; " >
<div class="w4-container">
<form action="">
  <input type="radio" name="gender" value="male"> Registrar Paciente<br>
  <input type="radio" name="gender" value="female"> Registrar Especialista <br>
  <input type="radio" name="gender" value="other"> Crear cuenta <br>
  <input type="radio" name="gender" value="other"> Modificar cuenta <br>
  <input type="radio" name="gender" value="other"> Eliminar cuenta <br>
</form>
</div>
<div class="col-md-2" style="aling-items: left; justify-content: center;"></div>
@endsection