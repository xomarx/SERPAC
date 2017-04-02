@extends('RRHH.masterempleados')
@section('contentheader_title')
    EXTENSIONISTAS 
@stop
@section('main-content')
@permission('ver tecnicos')
<div class="box box-primary box-solid">
    <div class="box-header" >
        @permission('crear tecnicos')
        <a id="nuevotecnicos" data-toggle='modal' data-target='#tecnicosmodal' class="btn btn-dropbox" style="float: left;">AGREGAR TECNICOS  <span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal"></span></a>
        @endpermission
    </div>
    <div class="box-body">        
        <table class="table table-responsive" id="myTable" >
            <thead>
            <th>CODIGO</th>
            <th>DNI</th> 
            <th>EMPLEADO</th>                            
            <th>N° SECTORES</th>
            <th>CARGO</th>
            <th>AREA</th>                                                          
            <th>ACCION</th>            
            </thead>
            <tbody>
                @foreach($tecnicos as $tecnico)
                {{--*/ @$name = str_replace(' ','&nbsp;', $tecnico->empleados_empleadoId) /*--}}
                <tr>                                                                                
                    <td>{{$tecnico->empleados_empleadoId}}</td>
                    <td>{{$tecnico->personas_dni}}</td>
                    <td>{{$tecnico->paterno}} {{$tecnico->materno}} {{$tecnico->nombre}}</td>
                    <td align="center">{{$tecnico->numzonas}}</td>
                    <td>{{$tecnico->cargo}}</td>
                    <td>{{$tecnico->area}}</td>                                
                    <td>                             
                        <a href="javascropt:void(0);"  class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="ver Tecnicos"><span class="glyphicon glyphicon-eye-open"></span></a>                        
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<section id="conten-modal"></section>
@endpermission
@permission('crear tecnicos')

@endpermission

@stop
@section('script')
<script>
         
  
  
  
    
    
    
    $(document).ready(function(e){    
    $("#subtecnicos").addClass('active');      
    $("#menuRRHH").addClass('active');
 });
    
</script>
@stop