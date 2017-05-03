<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">MOVIMIENTO DE DINERO</h3>
            </div>
            <div class="modal-body form-horizontal">     
                {!! Form::open(['id'=>'formDinero']) !!}
                <input type="hidden" name="iddinero" id="iddinero" />
                    @include('mensajes.mensaje')
                    <div class="col-md-3">
                        {!! Form::label('ruc','Ruc: ',['class'=>'control-label'])!!}
                        {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'R.U.C'])!!}
                    <div class="text-red" id="error_rol"></div>
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('razon','Razon Social: ',['class'=>'control-label'])!!}
                    {!! Form::text('razon',null,['id'=>'razon','class'=>'form-control','placeholder'=>'N° de cuenta','maxlength'=>10])!!}
                    <div class="text-red" id="error_tag"></div>
                    </div>                                        
                    {!! Form::label('descripcion','Descripcion: ',['class'=>'control-label'])!!}
                    {!! Form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Descripcion del Cheque','rows'=>'3'])!!}
                    <div class="text-red" id="error_descripcion"></div>
                </form>                     
            </div>
            <div class="modal-footer">                              
                <a onclick="regrol(3)" id="Regmodal" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Rol de Usuarios">Registrar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>                    
        </div>
    </div>
</div>
