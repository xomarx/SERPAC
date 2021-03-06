@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
        
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li id="subusuarios"><a href="{{ url('/Usuarios') }}"><i class='fa fa-users'></i> <span>Usuarios</span></a></li>
            @permission(['crear documentos','ver documentos'])
                <li id="subdocumento"><a href="{{ url('Configuracion/Documentos') }}"><i class='fa fa-file-o'></i> <span>Recibos</span></a></li>
            @endpermission
            <li id="subdatos"><a href="{{ url('/Datos') }}"><i class='fa fa-database'></i> <span>Datos</span></a></li>
                        
        </ul><!-- /.sidebar-menu -->
    </section>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $("#menuconfiguracion").addClass('active');
    })
 </script>
@stop