@extends ('masterError')
@section ('contenido_error')
<h2>¡Ha habido un error! Si este persiste comuníquese con el 
    Servicio de Salud.
</h2>

 <div style="text-align:center">
<button  class = 'btn btn-primary mobile bloquear' onclick="redirect()">Ir al inicio</button>

 </div>
 <!--<h2>{{ $exception->getMessage() }}</h2>-->
 
 <script>
    function redirect() {
        window.location.replace('/');    
    }
</script>
@endsection