@extends ('masterAsistente')
@section ('contenido_Asistente')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<div class="panel panel-primary class border-panel " >

    
     <div class="panel-heading border-panel bg-color-panel">
     <p class="center" style="font-size: 3vh;">Histórico Citas</p>
    </div>
    <div class="panel-body">
            <div style="margin-bottom: 15px;" class="col-md-4 col-md-offset-2"><select id="dropRecintos" class="form-control"></select> </div>
            <div style="margin-bottom: 15px;" class="col-md-4">
            <select id="dropEstados" class="form-control"></select>
            </div>
            <br>
            <br>
    <section class="">
    <div class="panel-heading">
    <div>
    <a class="btn btn-primary" style="" href="{{url('reservarCita')}}">Reservar cita</a></div>
        <!--<div class="margin-dwn btn">
    <a class="margin-button-agregar margin-dwn btn btn-success mobile" href="{{ url('redirCitasHoyAsist') }}">Ver citas del {{ \Carbon\Carbon::now(new \DateTimeZone('America/Costa_Rica'))->format('d/m/Y') }}</a> <span>    
    <a class="margin-button-agregar margin-dwn btn btn-success mobile" href="{{ url('redirCitasAPartirHoyAsist') }}">Ver citas a partir del {{ \Carbon\Carbon::now(new \DateTimeZone('America/Costa_Rica'))->format('d/m/Y') }}</a> <span>
        </div>-->       
    <div class="margin-up">
    <br> 
        <div class="margin-up">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="tablita">
                    <thead>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Teléfono</th>
                        <!--<th class="text-center">Correo</th>-->  
                        <th class="text-center">Especialista</th> 
                        <th class="text-center">Servicio</th>
                        <th class="text-center">Recinto</th> 
                        <th class="text-center">Fecha/Hora</th> 
                        <th class="text-center">Estado</th>                          
                    </thead>

                    <tbody>
                     
                    </tbody>
                </table>
            </div>
            </div>

        </div>
        </div> 
	</section>
   </div>
 </div>

 <script src="{{asset('js/lenguajeTabla.js')}}"></script>

 <script src="{{asset('js/listaCitasTotalesAsistente.js')}}"></script>

    
@endsection