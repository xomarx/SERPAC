<div class="modal fade" id="pariente" role="dialog">
    <div class="modal-dialog">    
        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="titulo" class="modal-title text-danger"></h4>
            </div>
            <div class="modal-body">   
                <div id="msj-infopariente" class="alert alert-success" role='alert' style="display: none">
                    <strong id='succespariente'></strong>
                </div>
                {!! Form::open(['id'=>'formpariente']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="socios_codigo"><input type="hidden" id="idpariente">
                <div class="col-md-11 col-md-offset-0 row">
                    {!! Form::label('dni','DNI',['class'=>'form-label col-sm-1']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('dni',null,['id'=>'dni_1','class'=>'form-control','placeholder'=>'N° DNI','minlength'=>'8','maxlength'=>'8','required'])!!}
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
                    
                    {!! Form::label('pariente','Pariente: ',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-4">                        
                        {!! Form::select('tipo_oariente',['MADRE'=>'Madre','PADRE'=>'Padre','ESPOSO(A)'=>'Esposo(a)','CONVIVIENTE'=>'Conviviente','HIJO(A)'=>'Hijo(a)','SOBRINO(A)'=>'Sobrino(a)','PRIMO(A)'=>'Primo(a)','HERMANO(A)'=>'Hermano(a)','TIO(A)'=>'Tio(a)'
                        ],null,['id'=>'tipo_pariente','class' =>'form-control','placeholder'=>'Estado Civil']) !!}
                        <div class="text-danger" id="error_pariente"></div>
                    </div> 
                </div>
                <div class="col-md-11 col-md-offset-0 row">
                    {!! Form::label('paterno','Apellido Paterno',['class'=>'form-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('paterno',null,['id'=>'paterno_1','class'=>'form-control','placeholder'=>'Apellido paterno','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error_paternop"></div>
                    </div>
                    {!! Form::label('materno','Apellido Materno',['class'=>'form-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('materno',null,['id'=>'materno_1','class'=>'form-control','placeholder'=>'Apellido Materno','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error_maternop"></div>
                    </div>
                </div>
                <div class="col-md-11 col-md-offset-0 row">
                    {!! Form::label('nombre','Nombre',['class'=>'form-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('nombre',null,['id'=>'nombre_1','class'=>'form-control','placeholder'=>'Nombre Completo','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error_nombrep"></div>
                    </div>
                    {!! Form::label('fecnaci','Fecha Nac.: ',['class'=>'control-label col-xs-2']) !!}                       
                    <div class="col-sm-4">                                
                        {!! Form::text('fec_nac',null,['id'=>'fec_nac_1','class'=>'form-control datepicker','placeholder'=>'mm/dd/yyyy']) !!}
                        <div class="text-danger" id="error_fec_nac_1"></div>
                    </div> 
                </div>
                <div class="col-md-11 col-md-offset-0 row" >
                    {!! Form::label('ubigeosocio','Dpto: ',['class'=>'control-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('departamento',$departamentos,null,['id'=>'departamento_1','class'=>'form-control','required']) !!}
                    </div>
                    {!! Form::label('provincia','Prov.: ',['class'=>'control-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provincia_1','class'=>'form-control','required']) !!}
                    </div>
                    {!! Form::label('distrito','Dsto.: ',['class'=>'control-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::select ('distrito',['placeholder'=>'selecciona'],null,['id'=>'distrito_1','class'=>'form-control','required']) !!}
                    </div>
                    {!! Form::label('central','Com. Central: ',['class'=>'control-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::select ('comite_central',['placeholder'=>'selecciona'],null,['id'=>'comite_central_1','class'=>'form-control','required']) !!}

                    </div>                 
                </div>
                <div class="col-md-11 col-md-offset-0 row" >
                    {!! Form::label('local','Com. Local: ',['class'=>'control-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::select ('comite_local',['placeholder'=>'selecciona'],null,['id'=>'comites_locales_id','class'=>'form-control','required']) !!}
                        <div class="text-danger" id="error_comite_local_1"></div>
                    </div> 
                    {!! Form::label('gradosocio','Grado Instruccion: ',['class'=>'control-label col-xs-2']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('grado_inst',[''=>'Grado Socio','PRIMARIA INCOMPLETA'=>'Primaria Incompleta','PRIMARIA COMPLETA'=>'Primaria Completa','ILETRADO'=>'Iletrado','SECUNDARIA COMPLETA'=>'Secundaria Completa','SECUNDARIA INCOMPLETA'=>'Secundaria Incompleta'
                        ,'SUPERIOR TECNICO'=>'Superior Tecnico','SUPERIOR UNIVERSITARIO'=>'Superior Universitario'],null,['id'=>'grado_inst_1','class' =>'form-control','required']) !!}
                        <div class="text-danger" id="error_grado_inst_1"></div>
                    </div>  
                </div>
                <div class="col-md-11 col-md-offset-0 row">
                    {!! Form::label('telefono','Telefono:',['class'=>'form-label col-xs-2']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('telefono',null,['id'=>'telefono_1','class'=>'form-control','placeholder'=>'N° telefono','minlength'=>'9','maxlength'=>'9'])!!}
                    </div>
                    {!! Form::label('estadocivilsocio','Estado Civil: ',['class'=>'control-label col-xs-3']) !!}
                    <div class="col-sm-4">
                        {!! Form::select('estado_civil',['Soltero(a)'=>'Soltero(a)','Conviviente(a)'=>'Conviviente(a)','Casado(a)'=>'Casado(a)','Divorciado(a)'=>'Divorciado(a)','Viudo(a)'=>'Viudo(a)'
                        ],null,['id'=>'estado_civil_1','class' =>'form-control','placeholder'=>'Estado Civil']) !!}
                        <div class="text-danger" id="error_estado_civil_1"></div>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-0 row">
                    {!! Form::label('direccion','Direccion:',['class'=>'form-label col-xs-2']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('direccion',null,['id'=>'direccion_1','class'=>'form-control','placeholder'=>'Direccion','required'])!!}
                        <div class="text-danger" id="error_Direccion_1"></div>
                    </div>  
                    <div class="col-sm-2 form-group">
                        <label class="radio">
                            <input type="radio" name="beneficiario" value="1" id="beneficiariop">Principal
                        </label> 
                        <label class="radio">
                            <input type="radio" name="beneficiario" value="0" id="beneficiarios" checked="True">Secundario
                        </label>
                    </div>
                </div>
                {!! Form::close()!!}                 
                <div class="modal-footer">
                    {!!link_to('#', $title='Nuevo', $attributes = ['id'=>'nuepariente', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                    {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegPariente', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                </div>

            </div>        
        </div>

    </div>
</div>






<!--{!! Form::open(['route'=> 'socios.store','method'=>'POST','files'=>true]) !!}-->
