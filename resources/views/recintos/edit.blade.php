@extends ('masterRoot')
@section ('contenido_Admin')
<div class="panel panel-primary border-panel">
    <div class="panel-heading bg-color-panel">
        <p style="text-align: center; font-size: 3vh;">Editar Recinto</p>
    </div>
    <div class="panel-body">
        <div class="row">
       
  
               <div class="col-md-6 col-md-offset-3">
                
                    <form action="{{ route('recintos.update', $recinto->id) }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        

                        <div class="form-group">
                            <input class="form-control" type="text" name="descripcion" id="nombre-field" value="{{$recinto['descripcion']}}" />
                        </div> 
                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-link pull-right" href="{{ route('recintos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@stop