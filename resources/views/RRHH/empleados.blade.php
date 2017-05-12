@extends('RRHH.masterempleados')
@section('contentheader_title')
    EMPLEADOS
@stop
@section('main-content')
@permission('ver empleados')
<div class="box-body" >
    
    <div class="box box-solid box-primary">
        <div class="box-header">
            @permission('crear empleados')
            <a id="nuevoempleado" class="btn btn-dropbox" data-toggle="tooltip" title="Agregar Empleado">AGREGAR EMPLEADO &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus">  </span></a>            
            @endpermission
            <a onclick="activarmodal(10)" class="btn btn-dropbox" data-toggle="tooltip" title="Amonestaciones">AMONESTACIONES &nbsp;&nbsp;&nbsp;<span class="fa fa-clipboard">  </span></a>            
        </div>
        <div class="box-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <table class="table table-responsive table-hover" id="myTable" >
                <thead>                                                            
                <th>CODIGO</th> 
                <th>DNI</th>
                <th>EMPLEADO</th>
                <th>CARGO</th> 
                <th>AREA</th> 
                <th>EMPRESA</th> 
                <th>ESTADO</th> 
                <th>ACCION</th>            
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                    {{--*/ @$name = str_replace(' ','&nbsp;', $empleado->empleadoId) /*--}}
                    <tr>                                            
                        <td>{{$empleado->empleadoId}}</td>
                        <td>{{$empleado->personas_dni}}</td>
                        <td>{{$empleado->paterno}} {{$empleado->materno}} {{$empleado->nombre}}</td>
                        <td>{{$empleado->cargo}}</td>
                        <td>{{$empleado->area}}</td>
                        <td>{{$empleado->empresa}}</td>
                        <td>{{$empleado->estado}}</td>
                        <td>      
                            <a href="{{url('RRHH/empleados')}}/{{$empleado->empleadoId}}" class="btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><span class="glyphicon glyphicon-eye-open"></span></a>
                            @permission('editar empleados')
                            <a  onclick="EdiEmpleado('{{$empleado->empleadoId}}')" href="javascript:void(0)" class="btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Empleado"><span  class="glyphicon glyphicon-pencil"></span></a>
                            @endpermission
                            @permission('eliminar empleados')
                            <a href="javascript:void(0)" onclick="EliEmpleado('{{$empleado->empleadoId}}','{{$name}}')" class="btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Empleado"><span class="glyphicon glyphicon-remove"></span></a>                                                            
                            @endpermission
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>
    
</div>
<section id="conten-modal"></section>
@endpermission
<!-- Modal -->
@endsection

@section('script')
<script>
 
 $(document).ready(function(e){    
    $("#subempleado").addClass('active');      
    $("#menuRRHH").addClass('active');
 });
 
 $(document).ready().on('blur','#codigo',function(event){
     $("#codigo").empty();
        var num = event.target.value.length;var valor=''
        for(var i=0;i < 5 - num ; i++)
            valor = valor + '0';             
        $("#codigo").val('EMP-'+valor+event.target.value);
    });
</script>
@stop

