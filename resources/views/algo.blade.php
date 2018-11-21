@if(Auth::user()->tipo == 1)
@extends ('masterRoot')
@section ('contenido_Admin')
<h2><li><a href="{{ url('/') }}">Root</a></li></h2>
@endsection
@endif

@if(Auth::user()->tipo == 2)
@extends ('masterEspecialista')
@section ('contenido_Especialista')
<h2><li><a href="{{ url('/') }}">Esp</a></li></h2>
@endsection
@endif




