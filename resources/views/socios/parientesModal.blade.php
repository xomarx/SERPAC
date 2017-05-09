<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">            
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="titulo" class="modal-title"></h4>
            </div>
            <div class="modal-body">                   
                {!! Form::open(['id'=>'formpariente']) !!}   
                @include('mensajes.mensaje')
                <input type="hidden" id="socios_codigo" name="socios_codigo">
                <input type="hidden" id="idpariente" name="idpariente">
                <div class="col-md-12 row ">                    
                    <div class="col-sm-3">
                        {!! Form::label('dni','DNI',['class'=>'form-label']) !!}
                        {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° DNI','minlength'=>'8','maxlength'=>'8','required'])!!}
                        <div class="text-danger" id="error_dnip"></div>
                    </div>                                    
                    <div class="col-sm-2 form-group">
                        <label class="radio">
                            <input type="radio" name="sexo" value="F" id="sexof" checked="true"> Femenino
                        </label> 
                        <label class="radio">                            
                            <input type="radio" name="sexo" value="M" id="sexom">Maculino
                        </label>
                    </div>                                        
                    <div class="col-sm-4">
                        {!! Form::label('pariente','Pariente: ',['class'=>'control-label']) !!}
                        {!! Form::select('tipo_pariente',['MADRE'=>'Madre','PADRE'=>'Padre','ESPOSO(A)'=>'Esposo(a)','CONVIVIENTE'=>'Conviviente','HIJO(A)'=>'Hijo(a)','SOBRINO(A)'=>'Sobrino(a)','PRIMO(A)'=>'Primo(a)','HERMANO(A)'=>'Hermano(a)','TIO(A)'=>'Tio(a)'
                        ],null,['id'=>'tipo_pariente','class' =>'form-control','placeholder'=>'Pariente']) !!}
                        <div class="text-danger" id="error_pariente"></div>
                    </div> 
                    <div class="col-md-3 form-group" >                        
                        <label class="radio" style="cursor: pointer">
                            <input type="radio" name="beneficiario" value="1" id="beneficiariop">Benef. Principal
                        </label> 
                        <label class="radio" style="cursor: pointer">
                            <input type="radio" name="beneficiario" value="0" id="beneficiarios" checked="True">Benef. Secunda
                        </label>
                    </div>
                </div>
                
                <div class="col-md-12 row ">                    
                    <div class="col-md-4">
                        {!! Form::label('paterno','Apellido Paterno',['class'=>'form-label']) !!}
                        {!! Form::text('paterno',null,['id'=>'paterno','class'=>'form-control','placeholder'=>'Apellido paterno','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error_paternop"></div>
                    </div>                    
                    <div class="col-md-4">
                        {!! Form::label('materno','Apellido Materno',['class'=>'form-label']) !!}
                        {!! Form::text('materno',null,['id'=>'materno','class'=>'form-control','placeholder'=>'Apellido Materno','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error_maternop"></div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('nombre','Nombre',['class'=>'form-label']) !!}
                        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Nombre Completo','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error_nombrep"></div>
                    </div>
                </div>
                <div class="col-md-12 row">                                                                                   
                    <div class="col-md-4"> 
                        {!! Form::label('fecnaci','Fecha Nacimiento: ',['class'=>'control-label']) !!}
                        {!! Form::date('fec_nac',null,['id'=>'fec_nac','class'=>'form-control datepicker']) !!}
                        <div class="text-danger" id="error_fec_nac_1"></div>
                    </div> 
                    <div class="col-md-4">
                        {!! Form::label('ubigeosocio','Departamento: ',['class'=>'control-label']) !!}
                        {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','onchange'=>'department()','placeholder'=>'Seleccione']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('provincia','Provincia: ',['class'=>'control-label']) !!}
                        <select name="provincia" id="provincia" class="form-control" onchange="province()" placeholder='Seleccione'>
                            <option value="">Seleccione</option>
                        </select>
                        
                    </div>
                </div>
                <div class="col-md-12 row" >                                                                                                    
                    <div class="col-md-4">
                        {!! Form::label('distrito','Dsto.: ',['class'=>'control-label']) !!}
                        {!! Form::select ('distrito',['placeholder'=>'Seleccione'],null,['id'=>'distrito','class'=>'form-control','onchange'=>'district()']) !!}                        
                    </div>                    
                    <div class="col-md-4">
                        {!! Form::label('central','Com. Central: ',['class'=>'control-label ']) !!}
                        {!! Form::select ('comite_central',['placeholder'=>'selecciona'],null,['id'=>'comite_central','class'=>'form-control','onchange'=>'central_committe()']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('local','Comite Local: ',['class'=>'control-label']) !!}                        
                        <select name="comite_local" id="comite_local" class="form-control" >
                            <option value="">Seleccione</option>
                        </select>
                        <div class="text-danger" id="error_comite_local_1"></div>
                    </div>
                </div>
                <div class="col-md-12 row" >                                                             
                    <div class="col-md-5">
                        {!! Form::label('gradosocio','Grado Instruccion: ',['class'=>'control-label']) !!}
                        {!! Form::select('grado_inst',[''=>'Grado Socio','PRIMARIA INCOMPLETA'=>'Primaria Incompleta','PRIMARIA COMPLETA'=>'Primaria Completa','ILETRADO'=>'Iletrado','SECUNDARIA COMPLETA'=>'Secundaria Completa','SECUNDARIA INCOMPLETA'=>'Secundaria Incompleta'
                        ,'SUPERIOR TECNICO'=>'Superior Tecnico','SUPERIOR UNIVERSITARIO'=>'Superior Universitario'],null,['id'=>'grado_inst','class' =>'form-control','required']) !!}
                        <div class="text-danger" id="error_grado_inst_1"></div>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('estadocivilsocio','Estado Civil: ',['class'=>'control-label']) !!}
                        {!! Form::select('estado_civil',['SOLTERO(A)'=>'Soltero(a)','CONVIVIENTE(A)'=>'Conviviente(a)','CASADO(A)'=>'Casado(a)','DIVORCIADO(A)'=>'Divorciado(a)','VIUDO(A)'=>'Viudo(a)'
                        ],null,['id'=>'estado_civil','class' =>'form-control','placeholder'=>'Estado Civil']) !!}
                        <div class="text-danger" id="error_estado_civil_1"></div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('telefono','Telefono:',['class'=>'form-label']) !!}
                        {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'N° telefono','minlength'=>'9','maxlength'=>'9'])!!}
                    </div>
                </div>                
                <div class="col-md-12 row">
                    
                    <div class="col-md-8">
                        {!! Form::label('direccion','Direccion:',['class'=>'form-label']) !!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion','required'])!!}
                        <div class="text-danger" id="error_Direccion_1"></div>
                    </div>  
                    
                </div>
                <div class="modal-footer">                    
                    {!!link_to('#', $title='Registrar', $attributes = ['id'=>'Regpariente', 'class'=>'btn btn-dropbox','onclick'=>'RegPariente()'])!!}
                    <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
                </div>  
                {!! Form::close()!!}  
                </div>
                                  
        </div>
    </div>
</div>
