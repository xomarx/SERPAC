@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
        <!-- Sidebar user panel (optional) -->               
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header text-bold"><center>SUB MENUS</center></li>
            <!-- Optionally, you can add icons to the links -->
            @permission('ver socios')
            <li id="subsocios"><a href="{{url('Socios/Socios')}}"><i class='fa fa-child'></i> <span>Socios</span></a></li>
            @endpermission
            @permission('ver parientes')
            <li id="subparientes"><a href="{{ url('/Socios/parientes') }}"><i class='fa fa-users'></i> <span>Parientes/Beneficiario</span></a></li>
            @endpermission
            @permission('ver transferencias')
            <li id="subtransferencias"><a href="{{ url('Socios/transferencias') }}"><i class='fa fa-exchange'></i> <span>Transferencia Socios</span></a></li>
            @endpermission
            @permission('ver fundos')
            <li id="subfundos"><a href="{{ url('/Socios/fundos') }}"><i class='fa fa-home'></i> <span>Fundos</span></a></li>
            @endpermission
            @permission('ver asig delegados')
            <li id="subasigdelegados"><a href="{{ url('Socios/Asignacion-Delegados') }}"><i class='fa fa-cubes'></i> <span>Asignacion de Delegados</span></a></li>
            @endpermission
            @permission('ver asigDirectivos')
            <li id="subasigdirectivos"><a href="{{ url('Socios/Asignacion-Directivos') }}"><i class='fa fa-sitemap'></i> <span>Asignacion de Directivos</span></a></li>
            @endpermission
            @permission(['ver delegados','ver directivos','ver floras','ver faunas','ver inmuebles'])
            <li class="treeview" id="subbasicos">
                <a href="#"><i class='fa fa-link'></i> <span>Reg. Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver delegados')
                    <li id="subdelegados"><a href="{{ url('/Socios/basicos/delegados') }}">Cargos Delegados</a></li>
                    @endpermission
                    @permission('ver directivos')
                    <li id="subdirectivos"><a href="{{ url('/Socios/basicos/directivos') }}">Cargos Directivos</a></li>
                    @endpermission
                    @permission('ver floras')
                    <li id="subfloras"><a href="{{ url('/Socios/basicos/floras') }}">Flora</a></li>
                    @endpermission
                    @permission('ver faunas')
                    <li id="subfaunas"><a href="{{ url('/Socios/basicos/faunas') }}">Fauna</a></li>
                    @endpermission
                    @permission('ver inmuebles')
                    <li id="subinmuebles"><a href="{{ url('/Socios/basicos/inmuebles') }}">Inmuebles</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission(['ver departamentos','ver provincias','ver distritos','ver central','ver local'])
            <li id="sububigeo">
                <a href="#"><i class='fa fa-link'></i> <span>Ubigeo</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver departamentos')
                    <li id="subdepartamentos"><a href="{{ url('/Socios/departamentos') }}">Departamento</a></li>
                    @endpermission
                    @permission('ver provincias')
                    <li id="subprovincias"><a href="{{ url('/Socios/provincias') }}">Provincia</a></li>
                    @endpermission
                    @permission('ver distritos')
                    <li id="subdistritos"><a href="{{ url('/Socios/distritos') }}">Distrito</a></li>
                    @endpermission
                    @permission('ver central')
                    <li id="subcentral"><a href="{{ url('/Socios/comite-central') }}">Comite Central</a></li>
                    @endpermission
                    @permission('ver local')
                    <li id="sublocal"><a href="{{ url('/Socios/comite-local') }}">Comite Local</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
        </ul><!-- /.sidebar-menu -->
    </section>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $("#menusocios").addClass('active');
    })
 </script>
@stop