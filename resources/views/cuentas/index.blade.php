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
                @if(session('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{@session('message')}}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{@session('error')}}
                </div>
                @endif
            <a  class="btn btn-success"href="{{ route('cuentas.create') }} " style="margin-left: 15px;">Registrar </a>
            
            <form action="{{ url('activardesactivar') }}" method='POST' style="float:right;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
                <label for="name" ><strong>Creación de cuentas activas/bloqueadas por defecto</strong></label> 
                    <div class="radio">
                    @if($opcion->cuentas_activas == 0)
                        <label><input type="radio" name="tipo" value="1">Activadas</label>
                        <label style="margin-left: 15px;"><input type="radio" name="tipo" value="2" checked>Bloqueadas</label>
                    @else
                        <label><input type="radio" name="tipo" value="1" checked>Activadas</label>
                        <label style="margin-left: 15px;"><input type="radio" name="tipo" value="2">Bloqueadas</label>
                    @endif    
                        <button style="margin-left: 20px;" class = 'btn btn-primary' type ='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                    </div>
                    
            </form>

            <br>
            <br>
            <br>
            <div></div>
           
            
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
                <table class="table table-striped table-bordered table-condensed table-hover" id="tablaDatos">
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
                                 
                                        <a class="btn btn-warning" href="{{ route('cuentas.edit', $cuenta->id) }}">
                                                 Editar
                                        </a>

                                    <form style="display:inline" action="{{ route('destroyCuentas', $cuenta->id) }}" method="DELETE" style="display: inline;" onsubmit="return confirm('¿Desea desactivar la cuenta de {{$nombre}}?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{csrf_field()}}
                                        @if($cuenta->active_flag == 1)
                                        <button type="submit" class="btn  btn-danger">Desactivar</button>
                                        
                                        @endif
                                    </form>
                                    <form style="display:inline" action="{{ route('reactivarCuentas', $cuenta->id) }}" method="DELETE" style="display: inline;" onsubmit="return confirm('¿Desea activar la cuenta de {{$nombre}}?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            @if($cuenta->active_flag == 0)
                                            <button type="submit" class="btn  btn-success">&nbsp&nbsp&nbsp Activar &nbsp&nbsp</button>
                                           
                                            @endif
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

<script src="{{asset('js/lenguajeTabla.js')}}"></script>
        
@stop
