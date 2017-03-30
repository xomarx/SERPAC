@extends('Configuracion.masterconfiguracion')
@section('contentheader_title')
    USUARIOS
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a href="{{url('Usuarios/crear-usuario')}}" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Usuario">Nuevo &nbsp;<span class="glyphicon glyphicon-user">  </span></a>
        <a onclick="activarForm(5)" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Lista de Usuarios">Listar &nbsp;<span class="glyphicon glyphicon-list">  </span></a>
        <a onclick="activarForm(1)"  class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Rol de Usuarios">Roles &nbsp;<span class="glyphicon glyphicon-road">  </span></a>
        <a onclick="activarForm(2)" class="btn btn-dropbox">Permisos &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal">  </span></a>
    </div>
    <div class="box-body" id="contenidos-box">  
        @include('Configuracion.listUsers')
    </div>
</div>
<section id="conten-modal">
    
</section>

@stop
@section('script')
<script>
        
    var cargarLista = function(){
        
        $.get('ListaPermisos/'+$("#rol").val(),function(data){
            $("#SelecListPermiso").html(data);            
        });
        
    };               
</script>
@stop

