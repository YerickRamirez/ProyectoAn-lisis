@extends ('masterRoot')
@section ('contenido_Admin')
@include('error')
<div class="panel panel-primary border-panel">
     <div class="panel-heading  bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Configuración de recintos</p>
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
            <button id="mybutton" class = ' margin-button-agregar btn btn-success mobile' onclick="myFunction()">Nuevo Recinto</button>

            <form action="{{ route('recintos.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div id="myDIV" style="display: none;">
                    <div class="row col-md-3" id="agregar">
                        <input placeholder="Nombre" class="nombre margin-lft form-control" name = "descripcion" type="text" id="nombre_recinto" pattern="[a-zA-Z áéíóúÁÉÍÓÚñÑ]{2,48}" title="No se permiten números en este campo"> 
                    </div>
                    <button  class = 'margin-button btn btn-success mobile' type ='submit'>Crear</button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel-heading">
        <div class="">
        <div class="">
            @if($recintos->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Editar</th>                        
                    </thead>

                    <tbody>
                          <?php
                        $a = 1;
                        ?>
                        @foreach($recintos as $recinto)
                            <tr>
                                <td class="text-center"><strong>{{$a}}</strong></td>
                                <td class="text-center">{{$recinto->descripcion}}</td>
                                <td class="text-center"> 
                                 <a class="btn btn-warning" href="{{ route('recintos.edit', $recinto->id) }}">Editar</a>
                                    <form style="display:inline" action="{{ route('recintos.destroy', $recinto->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar el recinto?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn  btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        $a = $a + 1;
                        ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
                {!! $recintos->render() !!}
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
        
@stop
