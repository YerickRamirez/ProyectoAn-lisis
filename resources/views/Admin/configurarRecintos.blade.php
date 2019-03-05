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
                    <input id="nombre" placeholder="Nombre" class="margin-lft form-control" name = "nombre" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo"> 
                    </div>
                    <button class = ' margin-button btn btn-success mobile' type ='submit'>Agregar Recinto</button>
            </form>
        	<!--<a href="{{ url("recintos/viewAnnadir") }}" class = 'btn btn-success'><i class="fa fa-home"></i>Añadir Recinto</a>-->
		</div>
	</div>

	<div class="panel-heading">
		<div class="content-recintos w3-container" style="margin-top: 5px">
    		<div class="table-responsive">
        	<table class="table table-striped table-bordered table-condensed table-hover">
            	<thead>
            		<th style="text-align:center;">Código</th>
                	<th style="text-align:center;">Nombre</th>
                	<th style="text-align:center;">Opciones</th>
            	</thead>

    <script src="{{asset('js/eliminarRecinto.js')}}"></script>

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