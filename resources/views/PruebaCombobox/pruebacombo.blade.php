@extends ('masterAdmin')
@section ('contenido')


<select id="comboRecintos" class="form-control">
@foreach ($recintos as $recinto)
<option value="{{ $recinto->ID_Recinto }}" {!! ($conditionForSelected ? "selected=\"selected\"" : "") !!}> {{ $recinto->Nombre }}</option>
@endforeach
</select>

<p id="p">a</p>


<script>
        var combo = document.getElementById("comboRecintos");
        document.getElementById("p").innerHTML = combo.options[combo.selectedIndex].text; //.text
        </script>
        
@endsection