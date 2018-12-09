@extends ('masterAsistente')
@section ('contenido_Asistente')
<script src="{{asset('js/reprogramarCitaAsistente.js')}}"></script>
<div class="panel panel-primary class border-panel " >
     <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Reservar citas</p>
    </div>
    <div class="panel-body">
    <section class="">
    <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropRecintos" class="form-control"></select></div>
    <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropServicios" class="form-control"></select></div>
    <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropEspecialistas" class="form-control"></select></div>
    <div class="col-md-4">
    <input style="margin-bottom: 15px;" placeholder="Cédula paciente" class="nombre form-control" name="cedula" type="text" id="cedula" value="{{$cedula}}" readonly> 
</div>


<!-- -->
<div class="container">
        <div class="row">
            <div class='col-sm-3'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker5'>
                        <input type='text' class="form-control" onchange="prueba()" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <button id="mostar-tabla"  class = 'margin-button-agregar btn btn-success mobile' 
    onclick="revisarDisponibilidad()">Mostrar horario</button>

    <!-- /////////////////////////////////////////////////////////////////////////// -->
    <p style="display:none; margin-top:15px; text-align:center; font-size: 3vh;" id="Fecha">Hola</p>  
    <div class="panel-heading">
<div class="table-responsive" id="ocultar-tabla" style="display: none;">
       
<table class="table table-striped table-bordered table-condensed table-hover">
                    
                    <?php $hora = 8; $des = "am"; $horaMilitar = 8;?>
                <tbody>
                    @for ($i = 0; $i < 4; $i++)
                        <?php $minutos = 00;?>
                        <tr>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar . '0' . $minutos}}" type="submit" style=" width:80px;" class="size btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:0{{$minutos}} {{$des}}</button>
                                 <?php $minutos = $minutos + 20;?>
                            </td>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar.$minutos}}" type="submit" style=" width:80px;" class="btn btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:{{$minutos}} {{$des}}</button>
                            </td><?php $minutos = $minutos + 20;?>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar.$minutos}}" type="submit" style=" width:80px;" class="btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:{{$minutos}} {{$des}}</button>
                            </td><?php $minutos = 00;  $hora = $hora + 1; $horaMilitar = $horaMilitar + 1;?>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar. 0 . $minutos}}" type="submit" style=" width:80px;" class="btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:0{{$minutos}} {{$des}}</button>
                            </td><?php $minutos = $minutos + 20;?>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar.$minutos}}" type="submit" style=" width:80px;" class="btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:{{$minutos}} {{$des}}</button>
                            </td><?php $minutos = $minutos + 20;?>
                            <td style="text-align: center">
                                        {{csrf_field()}}
                                        <button id="{{$horaMilitar.$minutos}}" type="submit" style=" width:80px;" class="btn  btn-success" onclick="confirmarCita({{json_encode($horaMilitar)}}, {{json_encode($minutos)}})">{{$hora}}:{{$minutos}} {{$des}}</button>
                            </td><?php $hora = $hora + 1; $horaMilitar = $horaMilitar + 1;?>
                        </tr>

                        @if ($i == 1)
                            <?php $des = "pm"; $hora = 1; $horaMilitar = 13;?>
                        @endif
                    @endfor
                </tbody>
    </table>

</div>
</div>
	</section>
   </div>
 </div>
@stop