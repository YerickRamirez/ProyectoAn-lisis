@if (count($errors) > 0)
    <div class="ui icon error message">
      <i class="remove icon"></i>
      <div class="content">
        <div class="header">Exiten algunos problemas con los datos ingresados.</div>
        <p>Solucione el problema y vuelva a intentarlo.</p>
        <ul class="list">
          @foreach ($errors->all() as $error)
              <li><i class="remove icon"></i> {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
@endif
