@extends('Configuracion.masterconfiguracion')
@section('contentheader_title')
    USUARIOS
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a href="{{url('Usuarios/crear-usuario')}}" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Usuario">Nuevo &nbsp;<span class="glyphicon glyphicon-user">  </span></a>
        <a onclick="activarForm(5)" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Lista de Usuarios">Listar &nbsp;<span class="glyphicon glyphicon-list">  </span></a>
        @permission('ver rol')
        <a class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Rol de Usuarios" onclick="Roles()">Roles &nbsp;<span class="glyphicon glyphicon-road">  </span></a>
        @endpermission
        @permission(['crear permiso socio','crear permiso RRHH','crear permiso acopio','crear permiso contabilidad','crear permiso certificacion','crear permiso tesoreria','crear permiso informes','crear permiso configuracion','crear permiso creditos'])
            <a onclick="activarForm(2)" class="btn btn-dropbox">Permisos &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal">  </span></a>
        @endpermission
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
        
    $(document).ready(function(){
        $("#subusuarios").addClass('active');
        $("#menuconfiguracion").addClass('active');               
        
    });
    var cargarLista = function(id){        
        $.get('ListaPermisos/'+$("#rol").val()+'/'+id,function(data){
            $("#SelecListPermiso").html(data);            
        });        
    };  
    
    $(document).ready().on('keyup','#buscaRol',function(){
        ListaRol();
    })
   
    var ListaRol = function(){
        $.ajax({
            type:'get',
            url:'/Usuario/RolList/'+$("#buscaRol").val(),
            success:function(data){                
                $("#lista-body").html(data);                
            } 
        });
    }
        
</script>
@stop

