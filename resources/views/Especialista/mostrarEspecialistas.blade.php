@extends ('masterRoot')
@section ('contenido_Admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
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
            </div>
        <div class="panel-heading">
            <div class="content-b w3-container">
		      <div class="table-responsive">
			     <table class="table table-striped table-bordered table-condensed table-hover" id="tablita">
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
					<td class="center">{{ $especialista->cedula_especialista}}</td>
                    <td class="center">{{ $especialista->primer_apellido_especialista . " " . $especialista->segundo_apellido_especialista .
                     " " . $especialista->nombre}}</td>
                
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
            </div> 
        </div> 
        </section>
	</div>
</div>

<script>

    $('#tablita').DataTable(
         {
 
        "language": {
 
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
 
    } ,
     stateSave: true,
     "ordering": false,
 
        
        } );
    </script>

@endsection