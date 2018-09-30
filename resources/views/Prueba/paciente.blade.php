@extends ('masterAdmin')
@section ('contenido')
	<h3>Pantalla de Paciente</h3>

	<br>
	<br>
	<br>
	<br>

<?php 
 $hoy=date("Y-m-d");
 $fechaFinal = $hoy;
$mes = date("m");
$dia = date("d");
$anno = date("Y");
$bisiesto = date("L");

 switch($mes){
	 case 1:
	 if ($dia > 28) {
		if	($bisiesto == 1) {
			$fechaFinal = $anno. "-02-29";
		} else {
			$fechaFinal = $anno."-02-28";
		}
	 }
	 break;

	 //Los meses que son de 30 dias
	 case 2:
	 case 4:
	 case 6:
	 case 9:
	 case 11:
	 
	 if($dia == 30) {
		$mes = ($mes + 1);
		if ($mes < 10) {
		$fechaFinal = $anno."-"."0".$mes."-31";
		} else {
			$fechaFinal = $anno."-".$mes."-31";
		}
	 } else {
		 $mes = ($mes + 1);
		 if ($mes < 10) {
			$fechaFinal = $anno."-"."0".$mes."-".$dia;
		 } else {
			$fechaFinal = $anno."-".$mes."-".$dia;
		 }
	 }
	 break;

	 //Los meses que son de 31 dias
	 case 3:
	 case 5:
	 case 7:
	 case 8:
	 case 10:
	 if($dia == 31) {
		$mes = ($mes + 1);
		if ($mes < 10) {
		$fechaFinal = $anno."-0".$mes."-30";
		} else {
			$fechaFinal = $anno."-".$mes."-30";
		}
	 } else {
		$mes = ($mes + 1);
		if ($mes < 10) {
		$fechaFinal = $anno."-0".$mes."-" .$dia;
		} else {
			$fechaFinal = $anno."-".$mes."-" .$dia;
		}
	 }
	 break;
	 
	 case 12:
	 $fechaFinal = ($anno + 1)."-01-".$dia;
	 break;
 }
 ?>


<h1>
<?php
 echo $hoy;
?>
</h1>

<input type="date" id="fecha" name="fecha" onchange="prueba()" min="<?php echo $hoy;?>" max="<?php echo $fechaFinal;?>">
<h1>
<?php
 echo $fechaFinal;
?></h1>

<script type="text/javascript">
function prueba() {
            var button = document.getElementById("fecha");
            alert("Hace postback");                
            return true;
        }
</script>



		
@stop