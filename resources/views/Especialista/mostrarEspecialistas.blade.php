@extends ('masterAdmin')
@section ('contenido')

<div class="panel-heading">
    <div class="content w3-container">
 	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     <h4>Especialistas <a href="especialistas/create"> <button>Nuevo Especialista</button> </a> </h3>
    </div>
</div>

<div class="panel-heading">
    <div class="content w3-container">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Cédula</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
				</thead>

<script>
function confirmarEliminar(cedula) {
    alert("Entró");
    if (confirm("¿Está seguro que desea eliminar al especilista con cédula " + cedula + " ?")) {
        window.location.replace("/especialistas/" + cedula + "/eliminarEspecialista");
    }
    return false;
}
</script>

@foreach ($especialistas as $especialista)
				<tr>
					<td>{{ $especialista->Cédula}}</td>
                    <td>{{ $especialista->Primer_Apellido . " " . $especialista->Segundo_Apellido .
                     ", " . $especialista->Nombre}}</td>
                
                    <td>
						<?php /*$placaEncrypted = Crypt::encrypt($carrito->placa)*/ ?>

						<a href="{{url('especialistas', $especialista->Cédula)}}/editarEspecialista"><button class="btn btn-info">Editar</button></a>
                        <a onclick="confirmarEliminar({{$especialista->Cédula}})" ><button class="btn btn-danger">Eliminar</button></a>
                        
                        <? //href="{{url('especialistas', $especialista->Cédula)}}/eliminarEspecialista" ?>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$especialistas->render()}}
</div> 
</div> 

@endsection