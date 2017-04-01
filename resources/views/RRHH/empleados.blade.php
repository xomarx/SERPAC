@extends('RRHH.masterempleados')
@section('contentheader_title')
    EMPLEADOS
@stop
@section('main-content')
<div class="box-body">
    <div class="box box-solid box-primary">
        <div class="box-header">
            <a id="nuevoempleado" data-toggle='modal' data-target='#EmpleadoModal' class="btn btn-dropbox">NUEVO &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal">  </span></a>            
        </div>
        <div class="box-body">
            <table class="table table-hover table-responsive" id="myTable" >
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
                            <a href="{{url('RRHH/empleados')}}/{{$empleado->empleadoId}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"data-toggle="tooltip" data-placement="top" title="Ver"></span></a>
                            <a  onclick="EdiEmpleado('{{$empleado->empleadoId}}')" data-toggle='modal' data-target='#EmpleadoModal' class="btn btn-primary btn-xs"><span data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-pencil"></span></a>
                            <a href="#" onclick="EliEmpleado('{{$empleado->empleadoId}}','{{$name}}')" class="btn btn-danger btn-xs" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="EmpleadoModal" role="dialog">
    <div class="modal-dialog modal-primary">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titulo-empleado">NUEVO EMPLEADO</h4>
            </div>
            {!! Form::open(['id'=>'formempleado']) !!}
            <div class="modal-body form-group-sm">
                <div id="msj-infoempleados" class="alert alert-success" role='alert' style="display: none">
                    <strong id='succesempleados'></strong>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">                
                <div class="col-md-12">
                    <div class="col-sm-3">
                        {!! Form::label('codigo','Codigo: ',['class'=>'form-label']) !!}                        
                        {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'EMP-00000','maxlength'=>'9','minlength'=>'9'])!!}
                        <div class="text-danger" id="error_codigo"></div>
                    </div> 
                    <div class="col-sm-3">
                        {!! Form::label('dni','DNI',['class'=>'form-label']) !!}
                        {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° DNI','maxlength'=>'8','mimlength'=>'8','onKeypress'=>'if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'])!!}
                        <div class="text-danger" id="error_dni"></div>
                    </div>                                                   
                    <div class="col-sm-3">
                        {!! Form::label('ruc','RUC',['class'=>'form-label']) !!}
                        {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'N° RUC','mimlength'=>'11','maxlength'=>'11'])!!}
                        <div class="text-danger" id="error_ruc"></div>
                    </div>
                    <div class="col-sm-2">
                        <label class="radio">
                            <input type="radio" name="sexo" id="sexoM" value="M" checked="true"/>
                            Maculino
                        </label>   
                        <label class="radio">
                            <input type="radio" name="sexo" id="sexoF" value="F" />
                            Femenino
                        </label>
                        <div class="text-danger" id="error_sexo"></div>
                    </div>                                       
                </div>
                
                <div class="col-md-12">
                    <div class="col-sm-4">
                        {!! Form::label('estado','Estado: ',['class'=>'control-label']) !!}
                        {!! Form::select('estado',['ACTIVO'=>'Activo','DESACTIVO'=>'Desactivo'
                        ],null,['id'=>'estado','class' =>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_estado"></div>
                    </div>                     
                    <div class="col-sm-4">
                        {!! Form::label('estadocivilsocio','Estado Civil: ',['class'=>'control-label']) !!}
                        {!! Form::select('estado_civil',['SOLTERO(A)'=>'Soltero(a)','CONVIVIENTE(A)'=>'Conviviente(a)','CASADO(A)'=>'Casado(a)','DIVORCIADO(A)'=>'Divorciado(a)','VIUDO(A)'=>'Viudo(a)']
                        ,null,['id'=>'estado_civil','class' =>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_estado_civil"></div>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('area','Area',['class'=>'control-label']) !!}
                        {!! Form::select('area',$areas,null,['id'=>'area','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_area"></div>
                    </div>                                       
                </div> 
                
                <div class="col-md-12">
                    <div class="col-sm-4">
                        {!! Form::label('cargo','Cargo',['class'=>'control-label']) !!}
                        {!! Form::select('cargo',$cargos,null,['id'=>'cargo','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_cargo"></div>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('paterno','Apellido Paterno',['class'=>'form-label']) !!}
                        {!! Form::text('paterno',null,['id'=>'paterno','class'=>'form-control','placeholder'=>'Apellido paterno','maxlength'=>'60','onkeyup'=>'javascript:this.value=this.value.toUpperCase();'])!!}
                        <div class="text-danger" id="error_paterno"></div>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('materno','Apellido Materno',['class'=>'form-label']) !!}
                        {!! Form::text('materno',null,['id'=>'materno','class'=>'form-control','placeholder'=>'Apellido Materno','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_materno"></div>
                    </div>                     
                </div>

                <div class="col-md-12">
                    <div class=" form-group col-sm-4">
                        {!! Form::label('nombre','Nombre Completo',['class'=>'form-label']) !!}
                        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Nombre Completo','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_nombre"></div>
                    </div>                    
                    <div class="col-sm-3">                                
                        {!! Form::label('fecnaci','Fecha Nac.',['class'=>'control-label']) !!}
                        {!! Form::text('fec_nac',null,['id'=>'fec_nac','class'=>'form-control datepicker','placeholder'=>'mm/dd/yyyy']) !!}    
                        <div class="text-danger" id="error_fec_nac"></div>
                    </div> 
                    <div class="col-sm-5">
                        {!! Form::label('profesion','Profesion',['class'=>'form-label']) !!}
                        {!! Form::text('profesion',null,['id'=>'profesion','class'=>'form-control','placeholder'=>'Profesion','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_profesion"></div>
                    </div> 
                </div>
                <div class="col-md-12 ">
                                                           
                    <div class="col-sm-4">
                        {!! Form::label('telefono','Telefono',['class'=>'control-label']) !!}                        
                        {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Telefono/celular','maxlength'=>'9'])!!}                        
                    </div>                     
                    <div class=" col-sm-4">
                        {!! Form::label('departamento','Departamento',['class'=>'control-label']) !!}
                        {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_departamento"></div>
                    </div>  
                    <div class="col-sm-4">
                        {!! Form::label('Provincia','Provincia',['class'=>'control-label']) !!}
                        {!! Form::select ('provincia',[],null,['id'=>'provincia','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_provincia"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    
                    <div class="col-sm-4">
                        {!! Form::label('distrito','Distrito',['class'=>'control-label']) !!}
                        {!! Form::select ('distrito',[],null,['id'=>'distrito','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_distrito"></div>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('Comite ','Comite Central',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_central',[],null,['id'=>'comite_central','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_central"></div>
                    </div>
                     <div class="col-sm-4">
                        {!! Form::label('local','Comite Local',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_local',[],null,['id'=>'comite_local','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_local"></div>                        
                    </div>                   
                </div>
                <div class="col-md-12">
                     <div class=" col-sm-6">
                        {!! Form::label('correo','Correo Electronico',['class'=>'form-label']) !!}
                        {!! Form::text('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'ejemplo@acopagro.com.pe','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_email"></div>
                    </div>                     
                    <div class="col-sm-6">
                        {!! Form::label('direccion','Direccion',['class'=>'form-label']) !!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion de la vivienda'])!!}
                        <div class="text-danger" id="error_direccion"></div>
                    </div>                                                       
                </div>
                                                           
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <br>
                    {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegEmpleado', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                
            </div>
            {!! Form::close() !!} 
        </div>

    </div>
</div>


@endsection

@section('script')
<script>
 
$("#fec_nac").datepicker({
        autoclose: true,
        language: "es"
    });
    
    $("#departamento").change(function(event){
        cargarprovincia(event.target.value,"provincia");
    });
    
    $("#provincia").change(function(event){
        cargardistrito(event.target.value,"distrito");
    });
    
    $("#distrito").change(function(event){
        cargarcomite_central(event.target.value,"comite_central");
    });
    
    $("#comite_central").change(function(event){
        cargarComitelocal(event.target.value,"comite_local");
    });
</script>
@stop

