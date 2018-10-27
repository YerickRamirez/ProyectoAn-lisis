@extends ('masterAdmin')
@section ('contenido')

            
@foreach ($recinto_especialista as $especialista)
<p>aserejé {!! print_r($especialista) !!}</p>

@endforeach
				
<p>recinto {{ print_r($recinto) }}</p>

@endsection
