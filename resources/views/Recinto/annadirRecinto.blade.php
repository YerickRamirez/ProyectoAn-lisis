@extends ('masterRoot')
@section ('contenido_Admin')
<div class="panel panel-primary">
    <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Agregar recinto</p>
    </div>
    <div class="panel-body">
        <section class="">
        <div class="content-c w3-container">    
            <div class=" center">
                <div class="col-md-4 col-md-offset-4">
                    <form method = 'POST' action = '{!! url("recintos")!!}/agregarRecinto'>
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <input id="nombre" placeholder="Nombre" class="form-control" name = "nombre" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo"> 
                        <button  style="margin-top: 5px;" class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o">
                        </i>Agregar Recinto</button>
                    </form>
                </div>
        </div>
        </div>
        </section>
    </div>
</div>
@stop