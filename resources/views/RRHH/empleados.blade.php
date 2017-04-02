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
            <a id="nuevoempleado" class="btn btn-dropbox">NUEVO &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal">  </span></a>            
            @endpermission
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
 
</script>
@stop

