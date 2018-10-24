@extends('masterPaciente')
@section('contenido_Paciente')
<h3>Informacion Paciente<h3>
<br>
<br>


<style>
* {
    box-sizing: border-box;
}

.zoom {
    padding: 50px;
    transition: transform .2s;
    width: 200px;
    height: 200px;
    margin: 0 auto;
}

.zoom:hover {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Safari 3-8 */
    transform: scale(1.5); 
}
</style>



 <div class="col-md-4">
 <a href="citas">
<img class="zoom" src="https://cdn.onlinewebfonts.com/svg/img_493643.png" >
</a>
 </div>
 <div class='col-md-4'>
<a href="citas">
<img class="zoom" src="https://image.flaticon.com/icons/png/512/42/42954.png" >
</a>
 </div>
 <div class='col-md-3'>
 <a href="citas">
<img class="zoom" src="https://png2.kisspng.com/20180221/giw/kisspng-medicine-cartoon-medical-equipment-electron-microscope-5a8d900acdf0d7.1266975115192268908435.png" >
</a>
 </div>
@stop