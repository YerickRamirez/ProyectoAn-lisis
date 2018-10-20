@extends ('masterAdmin')
@section ('contenido')

<section class="content">
    <div class="content w3-container">
         
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Añadir Especialistas</h3>
            <a href="/especialistas" class = 'btn btn-primary'><i class="fa fa-home"></i>Ver Especialistas</a>
        </div>
        <br>


    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    <form method = 'POST' action = '{!! url("especialistas")!!}/agregarEspecialista'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <br>
            <label for="cedula">Cédula</label>
            <br>
            <input id="cedula"  name = "cedula" type = 'text' required>
        
        <br>
            <label for="nombre">Nombre</label>
            <br>
            <input id="nombre" name = "nombre" type="text" required> 

        <br>
            <label for="primer_apellido">Primer Apellido</label>
            <br>
            <input id="primer_apellido" name = "primer_apellido" type="text" required> 
            
        <br>
            <label for="segundo_apellido">Segundo Apellido</label>
            <br>
            <input id="segundo_apellido" name = "segundo_apellido" type="text" required>
           
        <br>
        <br>
            <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i>Agregar Especialista</button>
        </form>
    </div>
    </div>
</section>
@endsection