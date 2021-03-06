@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
                       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">            
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            @permission('ver fondos')
            <li id="subfondos"><a href="{{ url('Acopio/Fondos-Acopio') }}"><i class='glyphicon glyphicon-list-alt'></i> <span>Fondos Acopio</span></a></li>
            @endpermission
            @permission('ver compras')
            <li id="subcompras"><a href="{{ url('Acopio/Compra-Grano') }}"><i class='glyphicon glyphicon-shopping-cart'></i> <span>Compra Granos</span></a></li>
            @endpermission
            @permission('ver pagos')
                <li id="subpagos"><a href="{{ url('Acopio/Gastos-Almacen') }}"><i class='glyphicon glyphicon-compressed'></i> <span>Gastos Almacen</span></a></li>
            @endpermission
            <li id="subadelaAcopio"><a href="{{ url('Acopio/Adelantos-Acopio') }}"><i class='fa fa-google-wallet'></i> <span>Adelatos de Acopio</span></a></li>
            <li id="subpagos"><a href="{{ url('Acopio/Gastos') }}"><i class='fa fa-simplybuilt'></i> <span>Lotes</span></a></li>
            @permission(['ver semanal'])
            <li class="treeview" id="subplanillas">
                <a href="#"><i class='fa fa-pied-piper'></i> <span>Planillas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver semanal')
                    <li id="subsemanal"><a href="{{ url('/Acopio/Planilla-Semanal') }}">Planilla Semanal</a></li>
                    @endpermission
                    <li id="submensual"><a href="{{ url('/Acopio/Planilla-Mensual') }}">Planilla Mensual</a></li>                                     
                </ul>
            </li>
            @endpermission
            <li class="treeview">
                <a href="#"><i class='fa fa-stack-overflow'></i> <span>Ventas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/socios/basicos/delegados') }}">Clientes</a></li>
                    <li><a href="{{ url('/socios/basicos/delegados') }}">Venta Interna</a></li>
                    <li><a href="{{ url('/socios/basicos/directivos') }}">Venta Externa</a></li>                                     
                </ul>
            </li>
            <li class="treeview" id="subregbasico">
                <a href="#"><i class='fa fa-link'></i> <span>Reg. Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li id="subtara"><a href="{{ url('/Acopio/Tara') }}">Tara</a></li>
                    <li><a href="{{ url('/Acopio/Transporte') }}">Transporte</a></li>
                    <li ><a href="{{ url('/Tesoreria/Tipos-egresos') }}">Tipo de Pagos</a></li>
                    <li ><a href="{{ url('/Acopio/Persona-Juridica') }}">Persona Juridica</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $("#menuacopio").addClass('active');
    })
 </script>
@stop
