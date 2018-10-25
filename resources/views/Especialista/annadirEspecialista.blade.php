@extends ('masterAdmin')
@section ('contenido')

<div class="panel panel-primary">
    <div class="panel-heading">
        <p style="text-align: center; font-size: 3vh;">Agregar especialistas</p>
    </div>
    <div class="panel-body">
        <section class="">
        <div class="content-c w3-container">    
            <div class=" center">
                <div class="col-md-4 col-md-offset-4">
                    <form method = 'POST' action = '{!! url("especialistas")!!}/agregarEspecialista'>
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <input id="cedula" placeholder="Cédula" class="form-control" name = "cedula" type = 'text' required>
                        <br>
                        <input id="nombre" placeholder="Nombre" class="form-control" name = "nombre" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo"> 
                        <br>
                        <input id="primer_apellido"placeholder="Primer Apellido" class="form-control" name = "primer_apellido" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo" required>            
                        <br>
                        <input id="segundo_apellido" placeholder="Segundo Apellido" class="form-control" name = "segundo_apellido" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo" required>    
                        <br>
                        <button  style="margin-top: 5px;" class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i>Agregar Especialista</button>
                        <a style="margin-top: 5px;" href="/especialistas" class = 'btn btn-primary'><i class="fa fa-home"></i>Ver Especialistas</a>
                    </form>
                </div>
        </div>
        </div>
        </section>
    </div>
</div>

@endsection