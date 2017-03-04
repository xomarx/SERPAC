@extends('RRHH.masterempleados')
@section('contentheader_title')
    EMPLEADOS
@stop
@section('main-content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-11 col-md-offset-0">
            <div class="panel panel-primary">
                
                <div class="panel-heading">  
                    <a id="nuevoempleado" data-toggle='modal' data-target='#EmpleadoModal' class="btn btn-facebook">NUEVO</a>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    LISTAS DE EMPLEADOS
                </div>
                <div class="panel-body">                                       
                        <table class="table table-responsive" id="myTable" >
                            <thead>                                                            
                            <th>CODIGO</th> 
                            <th>DNI</th>
                            <th>EMPLEADO</th>
                            <th>CARGO</th> 
                            <th>AREA</th> 
                            <th>ESTADO</th> 
                            <th>ACCIONES</th>            
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
                                        <a href="#" data-toggle='modal' data-target='#'><span class="glyphicon glyphicon-eye-open"data-toggle="tooltip" data-placement="top" title="Ver"></span></a>
                                        <a  onclick="EdiEmpleado('{{$empleado->empleadoId}}')" data-toggle='modal' data-target='#EmpleadoModal' ><span data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="#" onclick="EliEmpleado('{{$empleado->empleadoId}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
                                    </td>                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                    
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="EmpleadoModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">NUEVO EMPLEADO</h4>
            </div>
            <div class="modal-body">
                
                {!! Form::open(['id'=>'formempleadp']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="form-group-sm  col-md-12 col-md-offset-0">
                    <div class="col-xs-3">
                        {!! Form::label('codigo','Codigo: ',['class'=>'form-label']) !!}                        
                        {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'EMP-00000','maxlength'=>'9','minlength'=>'9'])!!}
                        <div class="text-danger" id="error_codigoempleado"></div>
                    </div> 
                    <div class="col-xs-3">
                        {!! Form::label('dni','DNI',['class'=>'form-label']) !!}
                        {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° DNI','maxlength'=>'8','mimlength'=>'8','onKeypress'=>'if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'])!!}
                    </div>                                                   
                    <div class="col-xs-3">
                        {!! Form::label('ruc','RUC',['class'=>'form-label']) !!}
                        {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'N° RUC','mimlength'=>'11','maxlength'=>'11'])!!}                                                                                    
                    </div>
                    <div class="col-xs-2">
                        <label class="radio">
                            {!! Form::radio('sexo','M',['id'=>'sexo', 'class'=>'']) !!} Maculino
                        </label>   
                        <label class="radio">
                            {!! Form::radio('sexo','F',['id'=>'sexo', 'class'=>'']) !!} Femenino
                        </label>
                    </div>                                       
                </div>
                
                <div class="form-group-sm col-md-12 col-md-offset-0">
                    <div class="col-xs-4">
                        {!! Form::label('estado','Estado: ',['class'=>'control-label']) !!}
                        {!! Form::select('estado',['ACTIVO'=>'Activo','DESACTIVO'=>'Desactivo'
                        ],null,['id'=>'estado','class' =>'form-control','placeholder'=>'Seleccione']) !!}                                  
                    </div>                     
                    <div class="col-xs-4">
                        {!! Form::label('estadocivilsocio','Estado Civil: ',['class'=>'control-label']) !!}
                        {!! Form::select('estado_civil',['SOLTERO(A)'=>'Soltero(a)','CONVIVIENTE(A)'=>'Conviviente(a)','CASADO(A)'=>'Casado(a)','DIVORCIADO(A)'=>'Divorciado(a)','VIUDO(A)'=>'Viudo(a)']
                        ,null,['id'=>'estadocivil','class' =>'form-control','placeholder'=>'Seleccione']) !!}                                  
                    </div>
                    <div class="col-xs-4">
                        {!! Form::label('area','Area',['class'=>'control-label']) !!}
                        {!! Form::select('area',$areas,null,['id'=>'area','class'=>'form-control']) !!}
                    </div>                                       
                </div> 
                <div class="form-group-sm col-md-12 col-md-offset-0">
                    <div class="col-xs-4">
                        {!! Form::label('cargo','Cargo',['class'=>'control-label']) !!}
                        {!! Form::select('area',$cargos,null,['id'=>'cargo','class'=>'form-control']) !!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::label('paterno','Apellido Paterno',['class'=>'form-label']) !!}
                        {!! Form::text('paterno',null,['id'=>'paterno','class'=>'form-control','placeholder'=>'Apellido paterno','maxlength'=>'60','onkeyup'=>'javascript:this.value=this.value.toUpperCase();'])!!}
                    </div>
                    <div class="col-xs-4">
                        {!! Form::label('materno','Apellido Materno',['class'=>'form-label']) !!}
                        {!! Form::text('materno',null,['id'=>'materno','class'=>'form-control','placeholder'=>'Apellido Materno','maxlength'=>'60'])!!}
                    </div>                     
                </div>

                <div class="form-group-sm col-md-12 col-md-offset-0">
                    <div class=" form-group col-xs-4">
                        {!! Form::label('nombre','Nombre Completo',['class'=>'form-label']) !!}
                        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Nombre Completo','maxlength'=>'60'])!!}
                    </div>                    
                    <div class="col-xs-3">                                
                        {!! Form::label('fecnaci','Fecha Nac.',['class'=>'control-label']) !!}
                        {!! Form::text('fec_nac',null,['id'=>'fec_nac','class'=>'form-control datepicker','required']) !!}                    
                    </div> 
                    <div class=" form-group col-xs-5">
                        {!! Form::label('profesion','Profesion',['class'=>'form-label']) !!}
                        {!! Form::text('profesion',null,['id'=>'profesion','class'=>'form-control','placeholder'=>'Profesion','maxlength'=>'60'])!!}
                    </div> 
                </div>
                <div class="form-group-sm col-md-12 col-md-offset-0">
                    <div class=" col-xs-5">
                        {!! Form::label('correo','Correo Electronico',['class'=>'form-label']) !!}
                        {!! Form::text('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Profesion','maxlength'=>'60'])!!}
                    </div>                                        
                    <div class="col-xs-3">
                        {!! Form::label('telefono','Telefono',['class'=>'control-label']) !!}                        
                        {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Telefono/celular','maxlength'=>'9'])!!}
                    </div>                     
                    <div class=" col-xs-4">
                        {!! Form::label('departamento','Departamento',['class'=>'control-label']) !!}
                        {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control']) !!}
                    </div>                       
                </div>
                <div class="form-group-sm col-md-12 col-md-offset-0">
                    <div class="form-group col-xs-4">
                        {!! Form::label('Provincia','Provincia',['class'=>'control-label']) !!}
                        {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provincia','class'=>'form-control']) !!}
                    </div>
                    <div class="form-group col-xs-4">
                        {!! Form::label('distrito','Distrito',['class'=>'control-label']) !!}
                        {!! Form::select ('distrito',['placeholder'=>'selecciona'],null,['id'=>'distrito','class'=>'form-control']) !!}
                    </div>
                    <div class="form-group col-xs-4">
                        {!! Form::label('Comite ','Comite Central',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_central',['placeholder'=>'selecciona'],null,['id'=>'comite_central','class'=>'form-control']) !!}
                    </div>
                                        
                </div>
                <div class="form-group-sm col-md-12 col-md-offset-0">
                    <div class="form-group col-xs-4">
                        {!! Form::label('local','Comite Local',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_local',['placeholder'=>'selecciona'],null,['id'=>'comite_local','class'=>'form-control']) !!}
                    </div> 
                    <div class=" form-group col-xs-4">
                        {!! Form::label('direccion','Direccion',['class'=>'form-label']) !!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion de la vivienda'])!!}
                    </div>
                    <div class=" form-group col-xs-4">
                        {!! Form::label('referencia','referencia',['class'=>'form-label']) !!}
                        {!! Form::text('referencia',null,['id'=>'referencia','class'=>'form-control','placeholder'=>'Referencia de la vivienda'])!!}
                    </div>                                    
                </div>
                {!! Form::close() !!}
                
                
                
            </div>
            <div class="modal-footer">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegEmpleado', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


@endsection

@section('script')
<script>
 
    $(document).ready(function(){
        $('#actualizar').hide();
    });
    var mostrar = function(valor)
    {               
        $('#actualizar').hide();
        $('#Registrar').show();
    }
   
 //*******************************   
    $(document).ready(function () {        
        $('#myTable').DataTable();
    });
//************************  LISTA



  $("#comite_central").change(function(event){          
     var route = "{{url('comite_locales')}}/"+event.target.value + "";        
    $.get(route,function(response){        
        $("#comite_local").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#comite_local").append("<option value='" + response[i].id+"'>"+response[i].comite_local+"</option>");
        }
    }); 
 });
// 
 $("#distrito").change(function(event){     
     var route = "/comites_centrales/"+event.target.value + "";   
     
    $.get(route,function(response){           
        $("#comite_central").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#comite_central").append("<option value='" + response[i].id+"'>"+response[i].comite_central+"</option>");
        }
    }); 
 });
 
 
 $("#provincia").change(function(event){     
     var route = "/distritos/"+event.target.value + "";         
    $.get(route,function(response){          
        $("#distrito").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#distrito").append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
        }
    }); 
 });
// 
// 
 $("#departamento").change(function(event){     
     var route = "/provincias/"+event.target.value + "";       
    $.get(route,function(response){        
        $("#provincia").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#provincia").append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
        }
    }); 
 });
 
  
</script>
@stop

