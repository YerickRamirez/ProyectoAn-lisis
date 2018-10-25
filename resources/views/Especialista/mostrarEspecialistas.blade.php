@extends ('masterAdmin')
@section ('contenido')

<div class="panel panel-primary">
    <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Configuración de especialistas</p>
    </div>
    <div class="panel-body">
        <section class="">
            <div class="content-c w3-container">
 	            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <a href="{{ url("especialistas/viewAnnadir") }}" class = 'btn btn-success'><i class="fa fa-home"></i>Añadir Especialistas</a>
                </div>
                <a style='cursor: pointer;' onClick="muestra_oculta('contenido')" title="" class="boton_mostrar">Mostrar / Ocultar</a>
            </div>
        <div class="panel-heading">
            <div class="content-b w3-container">
		      <div class="table-responsive">
			     <table class="table table-striped table-bordered table-condensed table-hover">
				    <thead>
					   <th class="center">Cédula</th>
                        <th class="center">Nombre</th>
                        <th class="center">Opciones</th>
				    </thead>

                <script>
                    function confirmarEliminar(cedula) {
                    if (confirm("¿Está seguro que desea eliminar al especilista con cédula " + String(cedula) + " ?")) {
                        window.location.replace("/especialistas/" + cedula + "/eliminarEspecialista");
                    }
                    return false;
                    }
                </script>
                @foreach ($especialistas as $especialista)
				<tr>
					<td class="center">{{ $especialista->Cédula}}</td>
                    <td class="center">{{ $especialista->Primer_Apellido . " " . $especialista->Segundo_Apellido .
                     " " . $especialista->Nombre}}</td>
                
                    <td class="center">
						<?php /*$placaEncrypted = Crypt::encrypt($carrito->placa)*/ ?>

						<a href="{{url('especialistas', $especialista->Cédula)}}/editarEspecialista"><button class="btn btn-info">Editar</button></a>
                        <a onclick="confirmarEliminar({{json_encode($especialista->Cédula)}})" ><button class="btn btn-danger">Eliminar</button></a>
                        
                        <? //href="{{url('especialistas', $especialista->Cédula)}}/eliminarEspecialista" ?>
					</td>
				</tr>
				@endforeach
			    </table>
		    </div>
		      {{$especialistas->render()}}
            </div> 
        </div> 
        </section>
	</div>
</div>
@endsection