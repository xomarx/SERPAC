
@extends('socios.mastersocio')

@section('contentheader_title')
    Parientes y Beneficiario
@stop
@section('main-content')

<div class="box box-solid box-primary">
    <div class="box-header">        
        <center> <h3 class="box-title">LISTA DE PARIENTES DE LOS SOCIOS</h3></center>
    </div>
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
                                    <a href="javascript:void(0)" onclick="editPariente('{{$pariente->socios_codigo}}','{{$pariente->dni}}')" data-toggle="modal" data-target="#pariente"><span  data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                                    <!--<a data-toggle="modal" data-target="#pariente"><span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Parientes"></span></a>-->
                                </td>                    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
    </div>
</div>

@include('socios.formParientes')
@stop
@section('script')
<script>
    $("#comite_central_1").change(function(event){          
     var route = "{{url('comite_locales')}}/"+event.target.value + "";  
     
    $.get(route,function(response){         
        $("#comites_locales_id").empty();
        $("#comites_locales_id").append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#comites_locales_id").append("<option value='" + response[i].id+"'>"+response[i].comite_local+"</option>");
        }
    }); 
 });
// 
 $("#distrito_1").change(function(event){     
     var route = "/comites_centrales/"+event.target.value + "";   
     
    $.get(route,function(response){           
        $("#comite_central_1").empty();
        $("#comite_central_1").append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#comite_central_1").append("<option value='" + response[i].id+"'>"+response[i].comite_central+"</option>");
        }
    }); 
 });
  
 $("#provincia_1").change(function(event){     
     var route = "/distritos/"+event.target.value + "";         
    $.get(route,function(response){          
        $("#distrito_1").empty();
        $("#distrito_1").append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#distrito_1").append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
        }
    }); 
 });

 $("#departamento_1").change(function(event){     
     var route = "/provincias/"+event.target.value + "";       
    $.get(route,function(response){        
        $("#provincia_1").empty();
        $("#provincia_1").append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#provincia_1").append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
        }
    }); 
 });
</script>

@stop