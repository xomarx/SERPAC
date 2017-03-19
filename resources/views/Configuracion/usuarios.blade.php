@extends('Configuracion.masterconfiguracion')
@section('contentheader_title')
    USUARIOS
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a href="{{url('register')}}" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Usuario">Nuevo &nbsp;<span class="glyphicon glyphicon-user">  </span></a>
        <a href="{{url('Usuarios')}}" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Lista de Usuarios">Listar &nbsp;<span class="glyphicon glyphicon-list">  </span></a>
        <a href="{{url('register')}}" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Roles de Usuarios">Roles &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-road">  </span></a>
        <a href="{{url('register')}}" class="btn btn-dropbox">Permisos &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal">  </span></a>
    </div>
    <div class="box-body">        
        <table class="table table-hover table-borderless" id="MyTable">
            <thead>
            <th>USUARIO</th>
            <th>CORREO</th>
            <th>EMPLEADO</th>
            <th>FECHA</th>
            <th>ACCIONES</th>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->name}}</td>
                    <td><a href="#">{{$usuario->email}}</a> </td>
                    <td>{{$usuario->paterno}} {{$usuario->materno}} {{$usuario->nombre}}</td>
                    <td>{{$usuario->created_at}}</td>
                    <td>
                        <a href="javascript:void(0);"  class="btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Activar Usuario"><span class="glyphicon glyphicon-ok"></span></a>
                        <a href="javascript:void(0);"  class="btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Desactivar Usuario"><span class="glyphicon glyphicon-remove"></span></a>
                        <a href="javascript:void(0);"  class="btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@include('layouts.partials.scripts_auth')
@stop
@section('script')
<script>
    
    //{{ url('/register') }}     action('AuthController@logOut') 
</script>
@stop

