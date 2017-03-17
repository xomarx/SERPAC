@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
        
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('Configuracion') }}"><i class='fa fa-link'></i> <span>Recibos</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Usuario</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/Configuracion/Usuarios') }}">Usuarios</a></li>
                    <li><a href="{{ url('/socios/basicos/directivos') }}">Roles</a></li>                                     
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
@stop
