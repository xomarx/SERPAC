@extends('Configuracion.masterconfiguracion')
@section('contentheader_title')
    USUARIOS
@stop
@section('main-content')
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <a href="{{url('/Usuarios')}}"  class="close "><i class="fa fa-remove"></i></a>
                    NUEVO USUARIO
                </div>
                <div class="box-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('empleado') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Empleado</label>
                            <div class="col-md-6 has-feedback">
                            <select name="empleado" id="empleado" class="form-control">
                                    <option selected="selected" value="">Seleccione un Empleado</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{$empleado->empleadoId}}">{{$empleado->empleados }}</option>
                                    @endforeach
                                </select>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('empleado'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('empleado') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Usuario</label>                            
                            <div class="col-md-6 has-feedback">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail / Correo Elecronico</label>

                            <div class="col-md-6 has-feedback">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6 has-feedback">
                                <input id="password" type="password" class="form-control" name="password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirme Contraseña</label>

                            <div class="col-md-6 has-feedback">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-dropbox">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                                <a href="{{url('/Usuarios')}}" class="btn btn-primary"><i class="fa fa-btn fa-remove"></i> Salir</a>                                                                    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@include('layouts.partials.scripts_auth')
@stop
@section('script')
<script>
    $("#empleado").change(function(event){
        
        var texto = $("#empleado option:selected").text();
        texto = texto.split(' ');
        var usuario = texto[0]+".";        
        $.each(texto, function( index, value ){
            if(index > 0)
                usuario += value.charAt(0);
        })        
        $("#name").val(usuario);
    });
</script>
@stop