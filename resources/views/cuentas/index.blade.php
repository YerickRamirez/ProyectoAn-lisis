@extends ('masterRoot')
@section ('contenido_Admin')
@include('error')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Configuración de cuentas</p>
    </div>
    <div class="panel-body">
        <section class="">
        <div class="content-c w3-container mobile">
        <div>
            <a  class="btn btn-success"href="{{ route('cuentas.create') }} " style="margin-left: 15px;">Registrar </a>

            <form action="{{ route('recintos.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div id="myDIV" style="display: none;">
                    <div class="row col-md-3" id="agregar">
                        <input placeholder="Nombre" class="nombre margin-lft form-control" name = "descripcion" type="text" id="nombre_recinto" pattern="[a-zA-Z áéíóúÁÉÍÓÚñÑ]{2,48}" title="No se permiten números en este campo"> 
                    </div>
                    <button  class = 'margin-button btn btn-success mobile' type ='submit'><i class="glyphicon glyphicon-plus"></i> Crear</button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel-heading">
        <div class="">
        <div class="">
            @if($cuentas->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="tablita">
                    <thead>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Opciones</th>                        
                    </thead>
                    <tbody>     
                        @foreach($cuentas as $cuenta)
                        <?php
                        $tipo = "";
                        $nombre = $cuenta->name . " " . $cuenta->lastName;
                        ?>
                            <tr>
                                <td class="text-center">{{$nombre}}</td>
                                <td class="text-center">{{$cuenta->email}}</td>
                                @if ($cuenta->tipo == 1)
                                 <td class="text-center">Administrador</td>
                                @elseif ($cuenta->tipo == 2)
                                <td class="text-center">Especialista</td>
                                @elseif ($cuenta->tipo == 3)
                                <td class="text-center">Asistente</td>
                                @elseif ($cuenta->tipo == 4)
                                <td class="text-center">Paciente</td>
                                @endif
                               
                                <td class="text-center"> 
                                 <a class="btn btn-warning" href="">
                                    <i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    <form style="display:inline" action="{{ route('destroyCuentas', $cuenta->id) }}" method="DELETE" style="display: inline;" onsubmit="return confirm('Desea eliminar el la cuenta de {{$nombre}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn  btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                       
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <h3 class="text-center alert alert-info">No hay nada para mostrar</h3>
            @endif

        </div>
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
        
@stop
