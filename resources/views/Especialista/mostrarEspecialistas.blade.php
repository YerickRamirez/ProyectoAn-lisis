@extends ('masterAdmin')
@section ('contenido')

<section class="">

    <div class=" w3-container">
 	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Especialistas</h3>
            <a href="{{ url("especialistas/viewAnnadir") }}" class = 'btn btn-success'><i class="fa fa-home"></i>Añadir Especialistas</a>
    </div>
</div>
<br>
<div class="panel-heading">
    <div class="w3-container">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Cédula</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
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
					<td>{{ $especialista->Cédula}}</td>
                    <td>{{ $especialista->Primer_Apellido . " " . $especialista->Segundo_Apellido .
                     ", " . $especialista->Nombre}}</td>
                
                    <td>
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
@endsection