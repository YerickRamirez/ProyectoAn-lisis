@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-primary border-panel" >
                <div class="panel-heading bg-color-panel" style="text-align: center; font-size: 18px" >Inicio de Sesión</div>

                <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           

                            <div class="">
                                <input placeholder="Correo electrónico" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            

                            <div class="">
                                <input placeholder="Contraseña" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class=""  style="text-align: center;">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Iniciar Sesión
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidó su contraseña?
                                </a>
                            </div>
                        </div>
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if(session()->has('info'))
                        <div class="alert alert-info">
                            {{ session()->get('info') }}
                        </div>
                    @endif
                    
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                        <div class="" style="text-align:center">
                            <img src="{{asset('Imagenes/logo-login.ico')}}" style="height:150px; widght:150px">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection
