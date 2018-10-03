@extends ('masterAdmin')
@section ('contenido')
	<h3>Pantalla de Paciente</h3>

	<br>
	<br>
	<br>
	<br>

<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker5'>
                    <input type='text' class="form-control" onchange="prueba()" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
		<script type="text/javascript">
            $(function () {
                var momento = new Date();
                console.log(momento);
    $('#datetimepicker5').datetimepicker({
        minDate: momento, //Muestra el calendario desde el dia actual y no desde antes
        maxDate: fechaMaxima(momento),
        format: 'DD/MM/YYYY', //Hay que ponerle un formato a la fecha, si no se pone esto se establecen con horas
        daysOfWeekDisabled:[0,6], //Asi se bloquean los fines de semana
        disabledDates: ["10/24/2018"] //Lista de fechas que bloquear. 
    }).on('dp.change', function prueba() {
            var button = document.getElementById("fecha");
            alert("Hace postback");                
            return true;
        });


    function fechaMaxima (actual){
    var maximo = actual;// = new Date();
    //maximo: actual;
    var mes = maximo.getMonth();
    var dia = maximo.getDate();
    var anno = maximo.getFullYear();
    var bisiesto = false;

console.log(dia+"/"+mes+"/"+anno);
    
if ((anno % 4 == 0) && ((anno % 100 != 0) || (anno % 400 == 0))) {
    bisiesto = true;
}
    
switch(mes){
case 0:
if (dia > 28) {
if	(bisiesto == 1) {
maximo = anno + "-02-29";
} else {
    maximo = anno + "-02-28";
}
}
break;

//Los meses que son de 30 dias
case 1:
case 3:
case 5:
case 8:
case 10:

if(dia == 30) {
mes = (mes + 1);
if (mes < 10) {
maximo = "31/" + "/" + "0" + mes + anno;
} else {
maximo = "31/" + "/" + mes + anno ;
}
} else {
mes = (mes + 1);
if (mes < 10) {
maximo = dia + "/" + "0" + mes + "/" + anno;
} else {
maximo = dia + "/" + mes + "/" + anno;
}
}
break;

//Los meses que son de 31 dias
case 2:
case 4:
case 6:
case 7:
case 9:
if(dia == 31) {
mes = (mes + 2);
if (mes < 10) {
maximo = "30/" + "/0" + mes + anno;
} else {
maximo = "30/" + "/" + mes + anno;
}
} else {
mes = (mes + 2);
if (mes < 10) {
maximo = "0" + mes + "/" + dia + "/"  + anno;
} else {
maximo =  mes + "/" + dia + "/" + anno  ;
}
}
break;

case 11:
maximo = dia + "/01/" + (anno + 1);
break;
}
console.log(new Date(Date.parse(maximo)));
    return maximo;
}


});
        </script>
    </div>
</div>


		
@stop