
<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary modal-lg">
        <!-- Modal content-->
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titulo-empleado" align='center'>EMPLEADO</h4>
            </div>            
            <div class="modal-body">
                {!! Form::open(['id'=>'formempleado']) !!}
                @include('mensajes.mensaje')                
                <div class="col-md-2">
                        {!! Form::label('codigo','Codigo: ',['class'=>'control-label']) !!}                        
                        {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'EMP-00000','maxlength'=>'5','onKeypress'=>'return soloNumeros(event)'])!!}
                        <div class="text-danger" id="error_codigo"></div>
                    </div> 
                    <div class="col-sm-2">
                        {!! Form::label('dni','DNI',['class'=>'control-label']) !!}
                        {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° DNI','maxlength'=>'8','mimlength'=>'8','onKeypress'=>'if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'])!!}
                        <div class="text-danger" id="error_dni"></div>
                    </div>                                                   
                    <div class="col-sm-2">
                        {!! Form::label('ruc','RUC',['class'=>'control-label']) !!}
                        {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'N° RUC','mimlength'=>'11','maxlength'=>'11'])!!}
                        <div class="text-danger" id="error_ruc"></div>
                    </div>
                <div class=" col-md-offset-0 col-sm-1">
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
                    
                                                          
                    <div class=" col-sm-5">
                        {!! Form::label('empresa','Empresa',['class'=>'control-label']) !!}
                        {!! Form::select('empresa',$empresas,null,['id'=>'empresa','class'=>'form-control','placeholder'=>'Seleccione','onclick'=>'department()']) !!}
                        <div class="text-danger" id="error_departamento"></div>
                    </div> 
                <div class="col-md-12 col-md-pull-0">
                    <div class="col-sm-3">
                        {!! Form::label('estadocivilsocio','Estado Civil: ',['class'=>'control-label']) !!}
                        {!! Form::select('estado_civil',['SOLTERO(A)'=>'Soltero(a)','CONVIVIENTE(A)'=>'Conviviente(a)','CASADO(A)'=>'Casado(a)','DIVORCIADO(A)'=>'Divorciado(a)','VIUDO(A)'=>'Viudo(a)']
                        ,null,['id'=>'estado_civil','class' =>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_estado_civil"></div>
                    </div>        
                    <div class="col-sm-2">
                        {!! Form::label('estado','Estado: ',['class'=>'control-label']) !!}
                        {!! Form::select('estado',['ACTIVO'=>'Activo','INACTIVO'=>'Inactivo'
                        ],null,['id'=>'estado','class' =>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_estado"></div>
                    </div>                     
                    
                    <div class="col-sm-4">
                        {!! Form::label('area','Area',['class'=>'control-label']) !!}
                        {!! Form::select('area',$areas,null,['id'=>'area','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_area"></div>
                    </div> 
                    <div class="col-sm-3">                                
                        {!! Form::label('fecnaci','Fecha Nac.',['class'=>'control-label']) !!}
                        {!! Form::date('fec_nac',null,['id'=>'fec_nac','class'=>'form-control datepicker','placeholder'=>'mm/dd/yyyy']) !!}    
                        <div class="text-danger" id="error_fec_nac"></div>
                    </div>
                </div>
                                                                             
                                
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
                
                    <div class="col-sm-4">
                        {!! Form::label('nombre','Nombre Completo',['class'=>'form-label']) !!}
                        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Nombre Completo','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_nombre"></div>
                    </div>                    
                     
                    <div class="col-sm-4">
                        {!! Form::label('profesion','Profesion',['class'=>'form-label']) !!}
                        {!! Form::text('profesion',null,['id'=>'profesion','class'=>'form-control','placeholder'=>'Profesion','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_profesion"></div>
                    </div> 
                           <div class=" col-sm-4">
                        {!! Form::label('correo','Correo Electronico',['class'=>'form-label']) !!}
                        {!! Form::text('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'ejemplo@acopagro.com.pe','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_email"></div>
                    </div>        
                                         
                    <div class=" col-sm-3">
                        {!! Form::label('departamento','Departamento',['class'=>'control-label']) !!}
                        {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','placeholder'=>'Seleccione','onchange'=>'department(event)']) !!}
                        <div class="text-danger" id="error_departamento"></div>
                    </div>  
                    <div class="col-sm-3">
                        {!! Form::label('Provincia','Provincia',['class'=>'control-label']) !!}
                        {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provincia','class'=>'form-control','onchange'=>'province()']) !!}
                        <div class="text-danger" id="error_provincia"></div>
                    </div>
                
                    <div class="col-sm-3">
                        {!! Form::label('distrito','Distrito',['class'=>'control-label']) !!}
                        {!! Form::select ('distrito',[],null,['id'=>'distrito','class'=>'form-control','placeholder'=>'Seleccione','onclick'=>'district()']) !!}
                        <div class="text-danger" id="error_distrito"></div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('Comite ','Comite Central',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_central',[],null,['id'=>'comite_central','class'=>'form-control','placeholder'=>'Seleccione','onclick'=>'central_committe()']) !!}
                        <div class="text-danger" id="error_central"></div>
                    </div>
                     <div class="col-sm-4">
                        {!! Form::label('local','Comite Local',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_local',[],null,['id'=>'comite_local','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_local"></div>                        
                    </div>                   
                
                                          
                    <div class="col-sm-5">
                        {!! Form::label('direccion','Direccion',['class'=>'form-label']) !!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion de la vivienda'])!!}
                        <div class="text-danger" id="error_direccion"></div>
                    </div>
                <div class="col-sm-3" style="padding-bottom: 10px;">
                        {!! Form::label('celular','Celular',['class'=>'form-label']) !!}
                        {!! Form::text('celular',null,['id'=>'celular','class'=>'form-control','placeholder'=>'Nombre Completo','maxlength'=>'9'])!!}
                        <div class="text-danger" id="error_nombre"></div>
                    </div>
                <div class="col-md-12" style="float: right;">
                    {!!link_to('#', $title='Registrar', $attributes = ['id'=>'Regempleado', 'class'=>'btn btn-dropbox','onclick'=>'RegEmpleado()'])!!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>                 
                </div>
                    
               
                     
                {!! Form::close() !!} 
                <div class="modal-footer">                        
                                                                                     
                </div>
            </div>
            
            
        </div>

    </div>
</div>

