@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
                       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->                      
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Reporte de Socios</span> <i class="fa fa-angle-left pull-right"></i></a>
                
                <ul class="treeview-menu">
                    @permission('ver padron socios')
                    <li ><a href="{{ url('/Informes/Padron-Socios') }}">Padron de Socios</a></li>     
                    @endpermission
                </ul>
                
            </li>            
            <li class="treeview" id="infoacopio">
                <a href="#"><i class='glyphicon glyphicon-inbox'></i> <span>Reporte de Acopio</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver kardex dinero')
                    <li id="subdinero"><a href="{{ url('Informes/Acopio/Grafica-Fondos') }}">Kardex de Dinero</a></li>
                    @endpermission
                    <li><a href="{{ url('/Acopio/Transporte') }}">Kardex de Compra de Acopio</a></li>
                    <li><a href="{{ url('/Tesoreria/Tipos-egresos') }}">Reporte de Ingreso de Acopio</a></li>                    
                </ul>
            </li>
            <li class="treeview" id="infotesoreria">
                <a href="#"><i class='fa fa-link'></i> <span>Reporte de Tesoreria</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver movimiento cheques')
                    <li id="subgiros"><a href="{{ url('/Informes/Tesoreria/Giro-Cheques') }}">Giros de Cheques</a></li>
                    @endpermission
                    @permission('ver distribucion fondos')
                        <li id="subdistribucion"><a href="{{ url('/Acopio/Tara') }}">Distribucion de Fondos</a></li>
                    @endpermission                 
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
@stop

@section('script')
<script>
    $(document).ready(function(){
       $("#menuinformes").addClass('active');
    });
 </script>
@stop
