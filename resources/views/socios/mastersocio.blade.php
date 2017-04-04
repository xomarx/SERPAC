@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
        <!-- Sidebar user panel (optional) -->               
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header text-bold"><center>SUB MENUS</center></li>
            <!-- Optionally, you can add icons to the links -->
            @permission('ver socios')
            <li id="subsocios"><a href="{{url('socios')}}"><i class='fa fa-child'></i> <span>Socios</span></a></li>
            @endpermission
            @permission('ver parientes')
            <li id="subparientes"><a href="{{ url('/socios/parientes') }}"><i class='fa fa-users'></i> <span>Parientes/Beneficiario</span></a></li>
            @endpermission
            @permission('ver transferencias')
            <li id="subtransferencias"><a href="{{ url('socios/transferencias') }}"><i class='fa fa-exchange'></i> <span>Transferencia Socios</span></a></li>
            @endpermission
            @permission('ver fundos')
            <li id="subfundos"><a href="{{ url('/socios/fundos') }}"><i class='fa fa-home'></i> <span>Fundos</span></a></li>
            @endpermission
            <li id="subasigdelegados"><a href="{{ url('socios/asignacion-delegados') }}"><i class='fa fa-cubes'></i> <span>Asig. Delegados</span></a></li>
            <li id="subasigdirectivos"><a href="{{ url('socios/asignacion-directivos') }}"><i class='fa fa-sitemap'></i> <span>Asig. Directivos</span></a></li>
            @permission(['ver delegados','ver directivos','ver floras','ver faunas','ver inmuebles'])
            <li class="treeview" id="subbasicos">
                <a href="#"><i class='fa fa-link'></i> <span>Reg. Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver delegados')
                    <li id="subdelegados"><a href="{{ url('/socios/basicos/delegados') }}">Cargos Delegados</a></li>
                    @endpermission
                    @permission('ver directivos')
                    <li id="subdirectivos"><a href="{{ url('/socios/basicos/directivos') }}">Cargos Directivos</a></li>
                    @endpermission
                    @permission('ver floras')
                    <li id="subfloras"><a href="{{ url('/socios/basicos/floras') }}">Flora</a></li>
                    @endpermission
                    @permission('ver faunas')
                    <li id="subfaunas"><a href="{{ url('/socios/basicos/faunas') }}">Fauna</a></li>
                    @endpermission
                    @permission('ver inmuebles')
                    <li id="subinmuebles"><a href="{{ url('/socios/basicos/inmuebles') }}">Inmuebles</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission(['ver departamentos','ver provincias','ver distritos','ver central','ver local'])
            <li id="sububigeo">
                <a href="#"><i class='fa fa-link'></i> <span>Ubigeo</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver departamentos')
                    <li id="subdepartamentos"><a href="{{ url('/socios/departamentos') }}">Departamento</a></li>
                    @endpermission
                    @permission('ver provincias')
                    <li id="subprovincias"><a href="{{ url('/socios/provincias') }}">Provincia</a></li>
                    @endpermission
                    @permission('ver distritos')
                    <li id="subdistritos"><a href="{{ url('/socios/distritos') }}">Distrito</a></li>
                    @endpermission
                    @permission('ver central')
                    <li id="subcentral"><a href="{{ url('/socios/comite-central') }}">Comite Central</a></li>
                    @endpermission
                    @permission('ver local')
                    <li id="sublocal"><a href="{{ url('/socios/comite-local') }}">Comite Local</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
        </ul><!-- /.sidebar-menu -->
    </section>
@stop
