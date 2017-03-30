@extends('layouts.master')
@section('sidebar')
<section class="sidebar">                       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li ><a href="{{ url('RRHH/empleados') }}"><i class='fa fa-child'></i> <span>Empleados</span></a></li>            
            <li ><a href="{{ url('RRHH/Tecnicos') }}"><i class='fa fa-street-view'></i> <span>Tecnicos</span></a></li>
            <li ><a href="{{ url('RRHH/Area') }}"><i class='fa fa-fire'></i> <span>Areas</span></a></li>
            <li ><a href="{{ url('RRHH/Cargos') }}"><i class='fa fa-level-up'></i> <span>Cargo</span></a></li>                     
            <li class="active"><a href="{{ url('RRHH/Sucursal') }}"><i class='fa fa-hospital-o'></i> <span>Almacen</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
@stop

