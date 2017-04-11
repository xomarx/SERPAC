@extends('layouts.master')

@section('sidebar')
<section class="sidebar">
        
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            @permission('ver movimientos')
            <li id="submovcheque"><a href="{{ url('Tesoreria/Cheques-Girados') }}"><i class='fa fa-credit-card'></i> <span>Movimientos Cheque</span></a></li>
            @endpermission
            @permission('ver distribucion')
            <li id="subdistribucion"><a href="{{ url('Tesoreria/Distribucion-Fondos') }}" ><i class='fa fa-share-alt'></i> <span>Distribucion Acopio</span></a></li>
            @endpermission
            
            <li id="subadelante"><a href="{{ url('Tesoreria/Distribucion-Fondos') }}"><i class='fa fa-money'></i> <span>Adelanto - Sueldo</span></a></li>
            <li class="treeview" id="subbasico">              
                <a href="#"><i class='fa fa-chain-broken'></i> <span>Reg. Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li id="subcheque"><a href="{{url('Tesoreria/Cheques')}}"><i class="fa fa-cc-mastercard"></i> Cheques </a></li>                    
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
</section>
@stop
@section('script')
<script>
$(document).ready(function(){
    $("#menutesoreria").addClass('active');
});
</script>

@stop