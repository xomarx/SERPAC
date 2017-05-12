
<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary ">
        <!-- Modal content-->
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titulo-empleado" align='center'>AMONESTACION</h4>
            </div>            
            <div class="modal-body">
                {!! Form::open(['id'=>'formempleado']) !!}
                @include('mensajes.mensaje')    
                <div class="box-body box-info bg-primary" >
                    
                    <div class="col-md-3">
                        {!! Form::label('codigo','DNI: ',['class'=>'control-label']) !!}                     
                        {!! Form::text('dnid',null,['id'=>'dnid','class'=>'form-control','placeholder'=>'N° DNI','maxlength'=>'8','onKeypress'=>'return soloNumeros(event)'])!!}
                        <div class="text-danger" id="error_codigo"></div>
                    </div>                                 
                    <div class="col-sm-6">
                        {!! Form::label('datos','Apellidos y Nombres',['class'=>'control-label']) !!}
                        {!! Form::text('datosd',null,['id'=>'datosd','class'=>'form-control','placeholder'=>'Apellidos y Nombres'])!!}
                        <div class="text-danger" id="error_dni"></div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('documento','Documento',['class'=>'control-label']) !!}
                        {!! Form::text('documento',null,['id'=>'documento','class'=>'form-control','placeholder'=>'Documento'])!!}
                        <div class="text-danger" id="error_dni"></div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::label('numero','N° de Doc.',['class'=>'control-label']) !!}
                        {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'N° Doc','maxlength'=>'8'])!!}
                        <div class="text-danger" id="error_ruc"></div>
                    </div>
                    <div class="col-sm-4">                                
                        {!! Form::label('fecha','Fecha Emision',['class'=>'control-label']) !!}
                        {!! Form::date('fecha',null,['id'=>'fecha','class'=>'form-control datepicker','placeholder'=>'mm/dd/yyyy']) !!}    
                        <div class="text-danger" id="error_fec_nac"></div>
                    </div>
                    <div class="col-sm-5">
                        {!! Form::label('observacion','Observacion',['class'=>'control-label']) !!}
                        {!! Form::textarea('observacion',null,['id'=>'observacion','class'=>'form-control','placeholder'=>'Observacion de la Amonestacion','rows'=>'2'])!!}
                        <div class="text-danger" id="error_ruc"></div>
                    </div>
                </div>
                <div class="box-body">
                    
                </div>
                    
                <div class="box-body box-info bg-primary" >
                    <div class="col-md-3">
                        {!! Form::label('codigo','DNI: ',['class'=>'control-label']) !!}                        
                        {!! Form::text('dnid',null,['id'=>'dnid','class'=>'form-control','placeholder'=>'N° DNI','maxlength'=>'8','onKeypress'=>'return soloNumeros(event)'])!!}
                        <div class="text-danger" id="error_codigo"></div>
                    </div>                                 
                    <div class="col-sm-8">
                        {!! Form::label('datos','Apellidos y Nombres',['class'=>'control-label']) !!}
                        {!! Form::text('datosd',null,['id'=>'datosd','class'=>'form-control','placeholder'=>'Apellidos y Nombres'])!!}
                        <div class="text-danger" id="error_dni"></div>
                    </div>
                </div>
                    
                
                    
                {!! Form::close() !!} 
                
            </div>
            <div class="modal-footer"> 
                    <a class="btn btn-dropbox">Grabar</a>
            </div>
            
        </div>

    </div>
</div>

