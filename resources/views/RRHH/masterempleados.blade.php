@extends('layouts.master')
@section('sidebar')
<section class="sidebar">                       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li ><a href="{{ url('RRHH/empleados') }}"><i class='fa fa-link'></i> <span>Empleados</span></a></li>            
            <li><a href="{{ url('RRHH/Tecnicos') }}"><i class='fa fa-link'></i> <span>Tecnicos</span></a></li>
            <li class="active"><a href="{{ url('RRHH/Area') }}"><i class='fa fa-link'></i> <span>Areas</span></a></li>
            <li ><a href="{{ url('RRHH/Cargos') }}"><i class='fa fa-link'></i> <span>Cargo</span></a></li>                     
            <li ><a href="{{ url('RRHH/Sucursal') }}"><i class='fa fa-link'></i> <span>Sucursal</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
@stop

