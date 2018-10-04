@extends ('masterAdmin')
@section ('contenido')

<section class="content">
<div class="panel-heading">
    <div class="content w3-container">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Editar Especialista</h3>
            <a href="/especialistas" class = 'btn btn-primary'><i class="fa fa-home"></i>Ver Especialistas</a>
    <br>
        </div>
    </div>

    <div class="content w3-container">

        
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <form method = 'POST' action = '{!! url("especialistas")!!}/{!!$especialistaEditar->Cédula!!}/actualizarEspecialista'> 
            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <br>
            <label for="cedula">Cédula</label>
            <br>
            <input id="cedula" type = 'text' value = "{{$especialistaEditar->Cédula}}" disabled>
        
        <br>
            <label for="nombre">Nombre</label>
            <br>
            <input id="nombre" name = "nombre" type="text" value="{{$especialistaEditar->Nombre}}"> 

        <br>
            <label for="primer_apellido">Primer Apellido</label>
            <br>
            <input id="primer_apellido" name = "primer_apellido" type="text" 
            value="{{$especialistaEditar->Primer_Apellido}}"> 
            
        <br>
            <label for="segundo_apellido">Segundo Apellido</label>
            <br>
            <input id="segundo_apellido" name = "segundo_apellido" type="text" 
            value="{{$especialistaEditar->Segundo_Apellido}}">
           
        <br>
        <br>
            <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i> Cambiar datos</button>
        </form>
    </div>
    </div>
    </div>
</div>
</section>
@endsection