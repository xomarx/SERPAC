
@extends('socios.mastersocio')

@section('contentheader_title')
    Parientes y Beneficiario
@stop
@section('main-content')

@permission('ver parientes')
<div class="box box-solid box-primary">    
    <div class="box-body">        
        <table class="table table-responsive" id="myTable">
            <thead>     
            <th>CODIGO SOCIO</th>
            <th>DNI</th>                                                   
            <th>PARIENTE</th>    
            <th>ESTADO CIVIL</th>  
            <th>DIRECCION</th>
            <th>COMITE LOCAL</th>
            <th>COMITE CENTRAL</th>
            <th>USUARIO</th>
            <th>ACCIONES</th>
            </thead>
            <tbody>
                @foreach($parientes as $pariente)
                <tr>                                         
                    <td>{{$pariente->socios_codigo}}</td>                                                        
                    <td>{{$pariente->dni}}</td>
                    <td>{{$pariente->paterno}} {{$pariente->materno}} {{$pariente->nombre}}</td>
                    <td>{{$pariente->estado_civil}}</td>
                    <td>{{$pariente->direccion}}</td>
                    <td>{{ $pariente->comite_local }}</td>
                    <td>{{ $pariente->comite_central }}</td>
                    <td>{{ $pariente->name }}</td>
                    <td>      
                        @permission('editar parientes')
                            <a style="cursor: pointer;" onclick="editPariente('{{$pariente->socios_codigo}}','{{$pariente->dni}}')" class="btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                        @endpermission
                        @permission('eliminar parientes')
                        <a style="cursor: pointer;" onclick="ElimPariente('{{$pariente->dni}}','{{$pariente->socios_codigo}}')" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                        @endpermission
<!--<a data-toggle="modal" data-target="#pariente"><span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Parientes"></span></a>-->
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('socios.formParientes')
@endpermission
@stop
