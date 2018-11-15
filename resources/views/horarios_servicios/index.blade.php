@extends ('masterRoot')
@section ('contenido_Admin')

<div class="panel panel-primary class border-panel " >
    <div class="panel-heading border-panel bg-color-panel">
        <p class="center" style="font-size: 3vh;">Configuración de horarios</p>
    </div>
    <div class="panel-body">
    <section class="">
        <div class="panel-heading">
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropRecintos" class="form-control"></select></div>
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropServicios" class="form-control"></select></div>
        <div style="margin-bottom: 15px;" class="col-md-4"><select id="dropEspecialistas" class="form-control"></select></div>

        <?php
            $holas = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes");
        ?>

        <div class="panel-heading" style="height:100%;">
            <div class="table-responsive" id="ocultar-tabla" style="display: none;">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th class="text-center">Día</th>
                            <th class="text-center">Mañana</th>
                            <th class="text-center">Tarde</th>                        
                        </thead>
                        @foreach($holas as $hola)
                        <tbody>
                            <tr>
                                <td class="text-center">{{$hola}}</td>
                                <td class="text-center"><input type="checkbox" autocomplete="off"></td>
                                <td class="text-center"><input type="checkbox" autocomplete="off"></td>        
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </section>
    </div>
    </div>
</div>
 @endsection