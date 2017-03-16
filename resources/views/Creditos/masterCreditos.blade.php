@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
    
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('Tesoreria/Distribucion-Fondos') }}"><i class='fa fa-link'></i> <span>Creditos</span></a></li>
            <li class="active"><a href="#"><i class='fa fa-link'></i> <span>Creditos</span></a></li>
            <li class="active"><a href="#"><i class='fa fa-link'></i> <span>Sepelio</span></a></li>
            <li class="active"><a href="#"><i class='fa fa-link'></i> <span>Aportes</span></a></li>
            <li class="active"><a href="#"><i class='fa fa-link'></i> <span>Ahorro Mutuo</span></a></li>
            <li class="active"><a href="#"><i class='fa fa-link'></i> <span>Reintegros</span></a></li>
            <li class="active"><a href="#"><i class='fa fa-link'></i> <span>Garantias</span></a></li>
            <li class="active"><a href="#"><i class='fa fa-link'></i> <span>Bono universitario</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Reg. Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/Acopio/Tara') }}">Sepelio</a></li>
                    <li><a href="{{ url('/Acopio/Transporte') }}">Productos Credito</a></li>
                    <li><a href="{{ url('/Tesoreria/Tipos-egresos') }}">Rubros</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
@stop
