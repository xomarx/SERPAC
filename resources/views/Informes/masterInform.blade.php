<@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
                       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li ><a href="{{ url('Acopio/Fondos-Acopio') }}"><i class='fa fa-link'></i> <span>Fondos Acopio</span></a></li>            
            <li ><a href="{{ url('Acopio/Compra-Grano') }}"><i class='fa fa-link'></i> <span>Compra Granos</span></a></li>
            <li><a href="{{ url('Acopio/Gastos') }}"><i class='fa fa-link'></i> <span>Gastos</span></a></li>           
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Planillas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('/Acopio/Planilla-Semanal') }}">Planilla Semanal</a></li>
                    <li><a href="{{ url('/Acopio/Planilla-Mensual') }}">Planilla Mensual</a></li>                                     
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Ventas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/socios/basicos/delegados') }}">Venta Interna</a></li>
                    <li><a href="{{ url('/socios/basicos/directivos') }}">Venta Externa</a></li>                                     
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Reg. Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/Acopio/Tara') }}">Tara</a></li>
                    <li><a href="{{ url('/Acopio/Transporte') }}">Transporte</a></li>
                    <li><a href="{{ url('/Tesoreria/Tipos-egresos') }}">Tipo de Egresos</a></li>
                    <li><a href="{{ url('/Acopio/Persona-Juridica') }}">Persona Juridica</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
@stop