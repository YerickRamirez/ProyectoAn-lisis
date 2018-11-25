@extends ('masterEspecialista')
@section ('contenido_Especialista')

<div class="panel panel-primary class border-panel " >
     <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Configuración de horarios</p>
    </div>
    <div class="panel-body">
    <section class="">
        
    <div class="panel-heading">
    	<div class="center">
  			<div class="col-md-5 col-md-offset-1" >
                  <div class="panel panel-default class border-panel">
                  
                  <div class="panel-body center">
                  	<img class="img-responsive" src="http://confidentalstudio.com/wp-content/uploads/2014/05/doctor-5.jpg" alt="Smiley face" max-width="100%" height="200" border="1" >
                  	<br>
                    <a class="btn btn-primary btn-block" href="{{ route('bloqueo_especialistas_especial.index') }}" style="margin-top: 7px"><strong>Bloqueo Horario Especialistas</strong></a>
                    <a class="btn btn-primary btn-block" href="{{ route('deshab_especial.index') }}" style="margin-top: 7px"><strong>Deshabilitar Horario Especialistas</strong></a>
                  </div>
                  </div>
            </div>
            <div class="col-md-5 ">
                  <div class="panel panel-default class border-panel">   
                  <div class="panel-body center">
                    <img class="img-responsive" src="http://rusregioninform.ru/images/1498071845_otr_shutterstock_260251175.jpg"  max-width="100%" height="220" border="1">
                  <a class="btn btn-primary btn-block" style="margin-top: 41px" href="{{ route('Especilista.horarios') }}"><strong>Horarios Servicios</strong></a>
                  </div>
                  </div>
            </div>
         </div>
    </div> 
	</section>
   </div>
 </div>
@stop