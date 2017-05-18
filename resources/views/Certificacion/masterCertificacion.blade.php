@extends('layouts.master')
@section('sidebar')
<section class="sidebar">
                       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            @permission(['ver condicion'])
            <li class="treeview" id="subbasicoCert">
                <a href="#"><i class='fa fa-link'></i> <span>Registro Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver condicion')
                    <li id="subcondicion"><a href="{{ url('/Certificacion/Condicion') }}">Condicion</a></li>
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
    $("#menucertificacion").addClass('active');
 });
</script>
@stop