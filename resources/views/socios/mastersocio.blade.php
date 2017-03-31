@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
        <!-- Sidebar user panel (optional) -->               
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header text-bold"><center>SUB MENUS</center></li>
            <!-- Optionally, you can add icons to the links -->
            @permission('ver socios')
            <li ><a href="{{url('socios')}}"><i class='fa fa-child'></i> <span>Socios</span></a></li>
            @endpermission
            @permission('ver parientes')
            <li><a href="{{ url('/socios/parientes') }}"><i class='fa fa-users'></i> <span>Parientes/Beneficiario</span></a></li>
            @endpermission
            @permission('ver transferencias')
            <li ><a href="{{ url('socios/transferencias') }}"><i class='fa fa-exchange'></i> <span>Transferencia Socios</span></a></li>
            @endpermission
            <li ><a href="{{ url('/socios/fundos') }}"><i class='fa fa-home'></i> <span>Fundos</span></a></li>
            <li><a href="{{ url('socios/asignacion-delegados') }}"><i class='fa fa-cubes'></i> <span>Asig. Delegados</span></a></li>
            <li><a href="{{ url('socios/asignacion-directivos') }}"><i class='fa fa-sitemap'></i> <span>Asig. Directivos</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Reg. Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li ><a href="{{ url('/socios/basicos/delegados') }}">Cargos Delegados</a></li>
                    <li ><a href="{{ url('/socios/basicos/directivos') }}">Cargos Directivos</a></li>
                    <li ><a href="{{ url('/socios/basicos/floras') }}">Flora</a></li>
                    <li ><a href="{{ url('/socios/basicos/faunas') }}">Fauna</a></li>
                    <li ><a href="{{ url('/socios/basicos/inmuebles') }}">Inmuebles</a></li>                    
                </ul>
            </li>
            <li class="treeview active">
                <a href="#"><i class='fa fa-link'></i> <span>Ubigeo</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">                    
                    <li ><a href="{{ url('/socios/departamentos') }}">Departamento</a></li>
                    <li ><a href="{{ url('/socios/provincias') }}">Provincia</a></li>
                    <li ><a href="{{ url('/socios/distritos') }}">Distrito</a></li>                    
                    <li ><a href="{{ url('/socios/comite-central') }}">Comite Central</a></li>
                    <li class="active"><a href="{{ url('/socios/comite-local') }}">Comite Local</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
@stop
