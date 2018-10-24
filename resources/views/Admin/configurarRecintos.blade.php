@extends ('masterRoot')
@section ('contenido_Admin')

<div class="panel panel-primary">
    <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Configuración de recintos</p>
    </div>
    <div class="panel-body">

<section class="">

	<div class="content-b w3-container">
 		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        	<h3>Recintos</h3>
        	<a href="{{ url("recintos/viewAnnadir") }}" class = 'btn btn-success'><i class="fa fa-home"></i>Añadir Recinto</a>
		</div>
	</div>
	<br>



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
	</script>

	@foreach ($recintos as $recinto)
            <tr>
                <td class="center">{{ $recinto->ID_Recinto}}</td>
                 <td class="center">{{ $recinto->Nombre}}</td>
                            
                <td>
                    <?php /*$placaEncrypted = Crypt::encrypt($carrito->placa)*/ ?>
                    <div class="center">
                    <a href="{{url('recintos', $recinto->ID_Recinto)}}/editarEspecialista"><button class="btn btn-info">Editar</button></a>
                    
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