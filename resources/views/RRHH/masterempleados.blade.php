@extends('layouts.master')
@section('sidebar')
<section class="sidebar">                       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            @permission('ver empleados')
            <li id="subempleado"><a href="{{ url('RRHH/Empleados') }}"><i class='fa fa-child'></i> <span>Empleados</span></a></li>
            @endpermission
            @permission('ver tecnicos')
            <li id="subtecnicos"><a href="{{ url('RRHH/Tecnicos') }}"><i class='fa fa-street-view'></i> <span>Tecnicos</span></a></li>
            @endpermission
            @permission('ver areas')
            <li id="subareas"><a href="{{ url('RRHH/Area') }}"><i class='fa fa-fire'></i> <span>Areas</span></a></li>
            @endpermission
            @permission('ver cargos')
            <li id="subcargos"><a href="{{ url('RRHH/Cargos') }}"><i class='fa fa-level-up'></i> <span>Cargo</span></a></li>
            @endpermission
            @permission('ver almacen')
            <li id="subalmacen"><a href="{{ url('RRHH/Sucursal') }}"><i class='fa fa-hospital-o'></i> <span>Almacen</span></a></li>
            @endpermission
            @permission('ver empresas')
            <li id="subempresa"><a href="{{ url('RRHH/Empresas') }}"><i class='fa fa-institution'></i> <span>Empresa</span></a></li>
            @endpermission
        </ul><!-- /.sidebar-menu -->
    </section>
@stop

@section('script')
<script>
    $(document).ready(function(){
        $("#menuRRHH").addClass('active');
    })
 </script>
@stop