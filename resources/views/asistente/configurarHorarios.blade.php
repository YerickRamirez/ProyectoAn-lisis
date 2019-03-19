@extends ('masterAsistente')
@section ('contenido_Asistente')

<div class="panel panel-primary class border-panel " >
     <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Configuración de horarios</p>
    </div>
    <div class="panel-body">
    <section class="">
        
    <div class="panel-heading">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{@session('message')}}
        </div>
        <br>
        @endif
    	<div class="center">
  			<div class="col-md-5 col-md-offset-1" >
                  <div class="panel panel-default class border-panel">
                  
                  <div class="panel-body center">
                  <img class="img-responsive" src="{{asset('Imagenes/doc.jpg')}}" alt="Smiley face" max-width="100%" height="200" border="1" >
                  	<br>
                    <a class="btn btn-primary btn-block" href="{{ route('bloqueo_especialistas_asist.index') }}" style="margin-top: 7px"><strong>Bloqueo Horario Especialistas</strong></a>
                    <a class="btn btn-primary btn-block" href="{{ route('deshab_asist.index') }}" style="margin-top: 7px"><strong>Deshabilitar Horario Especialistas</strong></a>
                  </div>
                  </div>
            </div>
            <div class="col-md-5 ">
                  <div class="panel panel-default class border-panel">   
                  <div class="panel-body center">
                  <img class="img-responsive" src="{{asset('Imagenes/servicios.jpg')}}"  max-width="100%" height="220" border="1">
                  <a class="btn btn-primary btn-block" style="margin-top: 41px" href="{{ route('horarios_serv_asis.index') }}"><strong>Horarios Servicios</strong></a>
                  </div>
                  </div>
            </div>
         </div>
    </div> 
	</section>
   </div>
 </div>
@stop