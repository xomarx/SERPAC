@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
        
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('Configuracion') }}"><i class='fa fa-link'></i> <span>Recibos</span></a></li>            
            <li><a href="{{ url('/Usuarios') }}"><i class='fa fa-link'></i> <span>Usuarios</span></a></li>            
        </ul><!-- /.sidebar-menu -->
    </section>
@stop
