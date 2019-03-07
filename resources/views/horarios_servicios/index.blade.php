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

        </section>
    </div>
    </div>
</div>
 @endsection