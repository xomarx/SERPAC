@extends('Configuracion.masterconfiguracion')
@section('contentheader_title')
    USUARIOS
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a id="nuevousuario" data-toggle='modal' data-target='#EmpleadoMo' class="btn btn-dropbox">NUEVO &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal">  </span></a>
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
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

