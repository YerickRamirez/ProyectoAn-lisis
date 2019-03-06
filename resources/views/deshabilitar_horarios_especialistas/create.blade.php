@extends ('masterRoot')
@section ('contenido_Admin')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<div class="panel panel-primary border-panel">
        <div class="panel-heading bg-color-panel">
           <p style="text-align: center; font-size: 3vh;">Deshabilitar Horario</p>
       </div>
       <div class="panel-body">
        <script src="{{('js/deshabilitarHorariosEspecialistas.js')}}"></script>

<!-- sdfghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh-->

    <div style="text-align: center">
        <div class="row" style="text-align: center">
                
              

            <div class='col-sm-3'>
                    <h4 style="text-align: center;">Fecha Inicio<h4>
                <div class="form-group">
                    <div class='input-group date' id='datetimepickerInicio'>
                        <input type='text' class="form-control" onchange="prueba()" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class='col-sm-3'>
                    <h4 style="text-align: center;">Fecha Fin<h4>
            <div class='input-group date' id='datetimepickerFin'>
                <input type='text' class="form-control" onchange="prueba()" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-3"style="text-align: center;">
                <h4 style="text-align: center;">Especialista<h4> 
                <select id="dropEspecialistas" class="form-control"></select>
            </div>
            <div class='col-sm-3'>
                 <h4 style="text-align: center;">Hora Inicio<h4>
                <input style="margin-left: 22px; margin-top: 5px;"class="timepicker" id="timeInicio">
            </div>
            <div class='col-sm-3 offset-sm-2'>
                <h4 style="text-align: center;">Hora Fin<h4>
                <input style="margin-left: 17px; margin-top: 5px;" class="timepicker" id="timeFin">
            </div>
        </div>
    
    
        <br>
            <button  class = 'btn btn-success mobile bloquear' 
            onclick="insertarDeshabEsp()" >Agregar bloqueo</button>
    

    <!-- /////////////////////////////////////////////////////////////////////////// -->
    
</div>
</div>
</div>
@endsection
