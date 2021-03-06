<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">CHEQUES</h3>
            </div>
            <div class="modal-body form-horizontal">     
                {!! Form::open(['id'=>'formCheque']) !!}
                <input type="hidden" name="idcheque" id="idcheque" />
                    @include('mensajes.mensaje')
                    <div class="col-md-8">
                        {!! Form::label('cheque','Cheque: ',['class'=>'control-label'])!!}
                    {!! Form::text('cheque',null,['id'=>'cheque','class'=>'form-control','placeholder'=>'Nombre del Cheque'])!!}
                    <div class="text-red" id="error-cheque"></div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('numero','Numero de Cuenta: ',['class'=>'control-label'])!!}
                    {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'N° de cuenta','maxlength'=>10])!!}
                    <div class="text-red" id="error-numero"></div>
                    </div>                                        
                    {!! Form::label('descripcion','Descripcion: ',['class'=>'control-label'])!!}
                    {!! Form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Descripcion del Cheque','rows'=>'3'])!!}
                    <div class="text-red" id="error-descripcion"></div>
                </form>                     
            </div>
            <div class="modal-footer">                              
                <a id="RegCheque" class="btn btn-dropbox">Registrar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>                    
        </div>
    </div>
</div>
