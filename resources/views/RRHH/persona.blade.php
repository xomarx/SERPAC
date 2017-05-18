<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">            
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">DATOS DE LA PERSONA</h4>
            </div>
            <div class="modal-body">                   
                {!! Form::open(['id'=>'fomrPersona']) !!}   
                @include('mensajes.mensaje')
                <input type="hidden" id="socios_codigo" name="socios_codigo">
                <input type="hidden" id="idpariente" name="idpariente">
                <div class="box-body bg-primary">
                    <div class="col-sm-3">
                        {!! Form::label('dni','DNI',['class'=>'form-label']) !!}
                        {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° DNI','minlength'=>'8','maxlength'=>'8','required'])!!}
                        <div class="text-danger" id="error-dni"></div>
                    </div>
                    <div class="col-sm-2 form-group">
                        <label class="radio">
                            <input type="radio" name="sexo" value="F" id="sexof" checked="true"> Femenino
                        </label> 
                        <label class="radio">                            
                            <input type="radio" name="sexo" value="M" id="sexom">Maculino
                        </label>
                        <div class="text-danger" id="error-sexo"></div>
                    </div>                    
                    <div class="col-md-6">
                        {!! Form::label('paterno','Apellido Paterno',['class'=>'form-label']) !!}
                        {!! Form::text('paterno',null,['id'=>'paterno','class'=>'form-control','placeholder'=>'Apellido paterno','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error-paterno"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                        {!! Form::label('materno','Apellido Materno',['class'=>'form-label']) !!}
                        {!! Form::text('materno',null,['id'=>'materno','class'=>'form-control','placeholder'=>'Apellido Materno','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error-materno"></div>
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('nombre','Nombre',['class'=>'form-label']) !!}
                        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Nombre Completo','maxlength'=>'60','required'])!!}
                        <div class="text-danger" id="error-nombre"></div>
                    </div>
                    </div>
                    
                    <div class="col-md-4"> 
                        {!! Form::label('fecnaci','Fecha Nacimiento: ',['class'=>'control-label']) !!}
                        {!! Form::date('fec_nacimiento',null,['id'=>'fec_nacimiento','class'=>'form-control datepicker']) !!}
                        <div class="text-danger" id="error-fec_nacimiento"></div>
                    </div> 
                    <div class="col-md-8">
                        {!! Form::label('direccion','Direccion:',['class'=>'form-label']) !!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion','required'])!!}
                        <div class="text-danger" id="error-direccion"></div>
                    </div>                    
                </div>                                                                                                                
                {!! Form::close()!!}  
                </div>                                          
        <div class="modal-footer">                    
                    {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegPersona', 'class'=>'btn btn-dropbox'])!!}
                    <button type="button" class="btn btn-default " data-dismiss="modal" id="personaSalir">Salir</button>
                </div> 
    </div>
</div>