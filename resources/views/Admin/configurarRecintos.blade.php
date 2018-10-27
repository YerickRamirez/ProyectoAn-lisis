@extends ('masterRoot')
@section ('contenido_Admin')

<div class="panel panel-primary">
    <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Configuración de recintos</p>
    </div>
    <div class="panel-body">

<section class="">

	<div class="content-c w3-container mobile">
 		<div>
             <form method = 'POST' action = '{!! url("recintos")!!}/agregarRecinto'>
                    <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                    <div class="row col-md-3" id="agregar">
                    <input id="nombre" placeholder="Nombre" class="form-control" name = "nombre" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo"> 
                    </div>
                    <button style="margin-left: 5px;" class = 'btn btn-success mobile' type ='submit'>Agregar Recinto</button>
            </form>
        	<!--<a href="{{ url("recintos/viewAnnadir") }}" class = 'btn btn-success'><i class="fa fa-home"></i>Añadir Recinto</a>-->
		</div>
	</div>

	<div class="panel-heading">
		<div class="content-b w3-container">
    		<div class="table-responsive">
        	<table class="table table-striped table-bordered table-condensed table-hover">
            	<thead>
            		<th style="text-align:center;">Código</th>
                	<th style="text-align:center;">Nombre</th>
                	<th style="text-align:center;">Opciones</th>
            	</thead>

	<script>
		function confirmarEliminar(ID_Recinto) {
		if (confirm("¿Está seguro que desea eliminar el recinto " + String(ID_Recinto) + " ?")) {
    	window.location.replace("/recintos/" + ID_Recinto + "/eliminarRecinto");
		}
		return false;
		}

            function muestra_oculta(id){
if (document.getElementById){ //se obtiene el id
var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
}
}
window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
muestra_oculta('contenido');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
}
	</script>

	@foreach ($recintos as $recinto)
            <tr>
                <td class="center">{{ $recinto->ID_Recinto}}</td>
                 <td class="center">{{ $recinto->Nombre}}</td>
                            
                <td>
                    <?php /*$placaEncrypted = Crypt::encrypt($carrito->placa)*/ ?>
                    <div class="center">
                    <a href="{{url('recintos', $recinto->ID_Recinto)}}/editarRecinto"><button class="btn btn-info">Editar</button></a>
                    
                    <a onclick="confirmarEliminar({{json_encode($recinto->ID_Recinto)}})" ><button class="btn btn-danger">Eliminar</button></a>
                    </div>
                    <? ?>
                </td>
            </tr>
    @endforeach
        </table>
    	</div>
    	{{$recintos->render()}}
	</div> 
</div> 







</section>

    </div>
</div>
		
@stop