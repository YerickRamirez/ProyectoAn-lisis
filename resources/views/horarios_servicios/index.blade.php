@extends ('masterRoot')
@section ('contenido_Admin')
<script src="{{asset('js/horarios_servicios.js')}}"></script>
<div class="panel panel-primary class border-panel " >
    <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Configuración de horarios</p>
    </div>
    <div class="panel-body">
    <section class="">
        <div class="panel-heading">
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropRecintos" class="form-control"></select></div>
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropServicios" class="form-control"></select></div>
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropEspecialistas" class="form-control" onChange="revisarHorario()"></select></div>

        <?php
            $semana = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");
            $id = 1;
        ?>
        <p id="info" style="display:none; text-align:center; font-size: 2.5vh;">Horarios</p>
        <div class="panel-heading">
            <div class="table-responsive" id="ocultar-tabla" style="display: none;">
            
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th class="text-center">Día</th>
                            <th class="text-center">Mañana</th>
                            <th class="text-center">Tarde</th>                        
                        </thead>
                        @foreach($semana as $dia)
                        <tbody>
                            <tr>
                                <td class="text-center">{{$dia}}</td>
                                <td class="text-center"><input type="checkbox" id="{{$id}}" autocomplete="off"></td>
                                <?php $id = $id +1;?>
                                <td class="text-center"><input type="checkbox" id="{{$id}}"autocomplete="off"></td>        
                                <?php $id = $id +1;?>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary center" onClick="guardarHorario()">Guardar cambios</button>
                <a class="btn btn-link pull-right" href="{{ route('Admin.horarios') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
            </div>
        </div>
           
        <script>
        function guardarHorario() {
            var recinto = $('#dropRecintos').val();
            var servicio = $('#dropServicios').val();
            var especialista = $('#dropEspecialistas').val();
            var cuenta = 1;
            var manana = 0;
            var tarde = 0;
            if(document.getElementById("3").checked) { manana = 1;} else { manana = 0;}
            if(document.getElementById("4").checked) { tarde = 1;} else { tarde = 0;}
            
            array_horario_servicio = [];
            for (var dia = 1; dia < 6; dia++) {
                if(document.getElementById(cuenta).checked) { manana = 1;} else { manana = 0;}
                cuenta =  cuenta + 1;
                if(document.getElementById(cuenta).checked) { tarde = 1;} else { tarde = 0;}

                var horario_servicio = {id_dia: dia, id_recinto: recinto, id_servicio: servicio, id_especialista: especialista,
                disponibilidad_manana: manana, disponibilidad_tarde: tarde};
                //alert(horario_servicio.id_dia);
                array_horario_servicio.push(horario_servicio);
                cuenta =  cuenta + 1;
            }
            alert(array_horario_servicio); 
/*
            $.ajax({
        type: "POST",
        url: "readArray.php",
        data: { array_horario_servicio : array_horario_servicio },
        success: function(datos) {
            alert1(datos);
        }, error:function() {   
        alert("¡Ha habido un error actualizando los servicios del horario!");
        }
    });*/

            window.location.replace("/annadirHorarioServicio/" + JSON.stringify(array_horario_servicio));
        }
        
        </script>
        </section>
    </div>
    </div>
</div>
 @endsection