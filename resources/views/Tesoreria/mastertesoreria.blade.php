@extends('layouts.master')

@section('sidebar')
<section class="sidebar">
        
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ $_SERVER['REQUEST_URI'] == 'Tesoreria/Distribucion-Fondos' ? 'active':'' }}" ><a href="{{ url('Tesoreria/Distribucion-Fondos') }}" ><i class='fa fa-share-alt'></i> <span>Distribucion Acopio</span></a></li>
            <li ><a href="{{ url('Tesoreria/Cheques-Girados') }}"><i class='fa fa-credit-card'></i> <span>Movimientos Cheque</span></a></li>
            <li ><a href="{{ url('Tesoreria/Distribucion-Fondos') }}"><i class='fa fa-money'></i> <span>Adelanto Efectivos</span></a></li>
            <li class="treeview active">              
                <a href="#"><i class='fa fa-chain-broken'></i> <span>Reg. Basico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{url('Tesoreria/Cheques')}}"><i class="fa fa-cc-mastercard"></i> Cheques </a></li>                    
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
</section>
@stop