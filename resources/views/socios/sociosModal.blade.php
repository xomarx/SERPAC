<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-lg modal-primary">
        <div class="modal-content" id="error-modal">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titulosocio"><center>DATOS DEL SOCIO</center></h4>          
            </div>
            <div class="modal-body">    
                {!! Form::open(['id'=>'formsocios']) !!}
                @include('mensajes.mensaje')
                <div class="col-md-12 col-md-offset-0 row form-group">   
                    <div class=" col-sm-2">
                        {!! Form::label('codigo','Codigo: ',['class'=>'form-label']) !!}                        
                        {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'ACO-00000','minlength'=>'1','maxlength'=>'5','onKeypress'=>'return soloNumeros(event)'])!!}
                        <div class="text-danger" id="error_codigo"></div>
                    </div> 
                    <div class=" col-sm-2">
                        {!! Form::label('dni','DNI',['class'=>'form-label col-xs-1']) !!}
                        {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° DNI','minlength'=>'8','maxlength'=>'8','onKeypress'=>'return soloNumeros(event)'])!!}
                        <div class="text-danger" id="error_dni"></div>
                    </div>                                                   
                    <div class=" col-sm-1">
                        <label class="radio">
                            <input type="radio" name="sexo" id="sexoM" value="M"  /> Maculino
                        </label>   
                        <label class="radio">
                            <input type="radio" name="sexo" id="sexoF" value="F" /> Femenino
                        </label>
                        <div class="text-danger" id="error_sexo"></div>
                    </div>
                    <div class=" col-sm-3">
                        {!! Form::label('estado','Estado: ',['class'=>'control-label col-xs-1']) !!}                        
                        {!! Form::select('estado',['ACTIVO'=>'Activo','REINSCRITO'=>'Reinscrito','RENUNCIANTE'=>'Renunciante','FALLECIDO'=>'Fallecido','RETIRADO'=>'Retirado'
                        ],null,['id'=>'estado','class' =>'form-control','placeholder'=>'Seleccione']) !!}   
                        <div class="text-danger" id="error_estado"></div>
                    </div>
                    {!! Form::label('estadocivilsocio','Estado Civil: ',['class'=>'control-label col-xs-2']) !!}
                    <div class=" col-sm-4">
                        {!! Form::select('estado_civil',['SOLTERO(A)'=>'Soltero(a)','CONVIVIENTE(A)'=>'Conviviente(a)','CASADO(A)'=>'Casado(a)','DIVORCIADO(A)'=>'Divorciado(a)','VIUDO(A)'=>'Viudo(a)']
                        ,null,['id'=>'estado_civil','class' =>'form-control','placeholder'=>'Seleccione']) !!}    
                        <div class="text-danger" id="error_estado_civil"></div>
                    </div>
                </div>

                <div class="col-md-12 col-md-offset-0 row form-group">   
                    <div class="col-sm-4">
                        {!! Form::label('paterno','Apellido Paterno',['class'=>'control-label']) !!}
                        {!! Form::text('paterno',null,['id'=>'paterno','class'=>'form-control','placeholder'=>'Apellido paterno','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_paterno"></div>
                    </div>
                    <div class=" col-sm-4">
                        {!! Form::label('materno','Apellido Materno',['class'=>'control-label']) !!}
                        {!! Form::text('materno',null,['id'=>'materno','class'=>'form-control','placeholder'=>'Apellido Materno','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_materno"></div>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('nombre','Nombre Completo',['class'=>'control-label']) !!}
                        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Nombre Completo','maxlength'=>'60'])!!}
                        <div class="text-danger" id="error_nombre"></div>
                    </div>
                </div> 

                <div class="col-md-12 col-md-offset-0 row form-group">
                    <div class=" col-md-3">                                
                        {!! Form::label('fecnaci','Fec. Nacimiento',['class'=>'control-label']) !!}
                        {!! Form::date('fec_nac',null,['id'=>'fec_nac','class'=>'form-control']) !!}
                        <div class="text-danger" id="error_fec_nac"></div>
                    </div> 
                    <div class="col-sm-3">
                        {!! Form::label('empadronsocio','Fecha Empadron',['class'=>'control-label']) !!}                        
                        {!! Form::date('fec_empadron',null,['id'=>'fec_empadron','class'=>'form-control','required','placeholder'=>'mm/dd/año']) !!}
                        <div class="text-danger" id="error_fec_empadron"></div>
                    </div>
                    <div class=" col-sm-3">
                        {!! Form::label('asociadosocio','Fecha Asociado',['class'=>'control-label']) !!}    
                        {!! Form::date('fec_asociado',null,['id'=>'fec_asociado','class'=>'form-control']) !!}
                        <div class="text-danger" id="error_fec_asociado"></div>
                    </div>
                    
                    
                    <div class=" col-sm-3">
                        {!! Form::label('gradosocio','Grado Instruccion: ',['class'=>'control-label']) !!}
                        {!! Form::select('grado_inst',[''=>'Grado Socio','PRIMARIA INCOMPLETA'=>'Primaria Incompleta','PRIMARIA COMPLETA'=>'Primaria Completa','ILETRADO'=>'Iletrado','SECUNDARIA COMPLETA'=>'Secundaria Completa','SECUNDARIA INCOMPLETA'=>'Secundaria Incompleta'
                        ,'SUPERIOR TECNICO'=>'Superior Tecnico','SUPERIOR UNIVERSITARIO'=>'Superior Universitario'],null,['id'=>'grado_inst','class' =>'form-control']) !!}
                        <div class="text-danger" id="error_grado_inst"></div>
                    </div>  
                </div>

                <div class="col-md-12 col-md-offset-0 row form-group" >
                    <div class="col-sm-3">
                        {!! Form::label('departamento','Departamento',['class'=>'control-label']) !!}
                        {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','placeholder'=>'Seleccione','onchange'=>'department(event)']) !!}
                        <div class="text-danger" id="error_departamento"></div>
                    </div>
                    <div class=" col-sm-3">
                        {!! Form::label('Provincia','Provincia',['class'=>'control-label']) !!}
                        {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provincia','class'=>'form-control','onchange'=>'province()']) !!}
                        <div class="text-danger" id="error_provincia"></div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('distrito','Distrito',['class'=>'control-label']) !!}
                        {!! Form::select ('distrito',['placeholder'=>'selecciona'],null,['id'=>'distrito','class'=>'form-control','onchange'=>'district()']) !!}
                        <div class="text-danger" id="error_distrito"></div>
                    </div>
                    <div class=" col-sm-3">      
                        {!! Form::label('Comite ','Comite Central',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_central',['placeholder'=>'selecciona'],null,['id'=>'comite_central','class'=>'form-control','onchange'=>'central_committe()']) !!}
                        <div class="text-danger" id="error_comite_central"></div>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-0 row form-group" >

                    <div class="col-sm-3">
                        {!! Form::label('local','Comite Local',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_local',['placeholder'=>'selecciona'],null,['id'=>'comite_local','class'=>'form-control']) !!}
                        <div class="text-danger" id="error_comite_local"></div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('ocupacion','Ocupacion',['class'=>'form-label']) !!}
                        {!! Form::text('ocupacion',null,['id'=>'ocupacion','class'=>'form-control','placeholder'=>'Ocupacion del Socio'])!!}
                        <div class="text-danger" id="error_ocupacion"></div>
                    </div>
                      
                                       
                    <div class=" col-sm-3">
                        {!! Form::label('produccion','Produccion',['class'=>'form-label']) !!}
                        {!! Form::text('produccion',null,['id'=>'produccion','class'=>'form-control','placeholder'=>'Referencia de la vivienda'])!!}
                        <div class="text-danger" id="error_produccion"></div>
                    </div>
                    <div class=" col-sm-2">
                        {!! Form::label('telefono','Telefono',['class'=>'control-label']) !!}                        
                        {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Telefono/celular','maxlength'=>'9'])!!}
                        <div class="text-danger" id="error_telefono"></div>
                    </div> 
                    </div> 
                
                    <div class=" col-sm-6">
                        {!! Form::label('direccion','Direccion',['class'=>'form-label']) !!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion de la vivienda'])!!}
                        <div class="text-danger" id="error_direccion"></div>
                    </div>
                <div class="col-md-6" style="padding-bottom: 10px">
                    {!! Form::label('condicion','Condicion: ',['class'=>'form-label']) !!}   <br>                     
                    <select class="form-control select2" multiple="multiple" name="condicion" id="condicion" data-placeholder="Seleccione" style="width: 100%;">
                            @foreach($condicions as $condicion)
                            <option value="{{$condicion->id}}">{{$condicion->condicion}}</option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="error-condicion"></div>                        
                    </div>                
                 {!! Form::close() !!}  
                 <div class="modal-footer">
                {!!link_to('#', $title='REGISTRAR', $attributes = ['id'=>'Regsocio', 'class'=>'btn btn-dropbox'])!!}                
                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
            </div>
            </div>                        
        </div>
    </div>
</div>