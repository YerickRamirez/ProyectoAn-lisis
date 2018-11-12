@extends ('masterRoot')
@section ('contenido_Admin')
<div class="panel panel-primary">
    <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Editar Recinto</p>
    </div>
    <div class="panel-body">
        <section class="">
        <div class="content-c w3-container">    
            <div class=" center">
  

               <div class="col-md-4 col-md-offset-4">
                <form method = 'POST' action = '{!! url("recintos")!!}/{!!$idRecintos!!}/actualizarRecinto'> 
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
  
                <label for="idRecintos">Ingresar el nuevo nombre</label>
                <br>
                <input id="nombre" name = "nombre" type="text" class="form-control" value="{{$recintoEditar->Nombre}}">         
                <br>
                    <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i> Cambiar datos</button>
                    <a href="{{asset('recintos')}}" class = 'btn btn-primary'><i class=""></i>Ver Recintos</a>
            </form>
        </div>
        </div>
        </div>
        </section>
    </div>
</div>
@stop