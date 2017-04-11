<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary modal-sm">
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" >CAJA CHICA </h3>
            </div>
            <div class="modal-body form-horizontal">     
                {!!Form::open(['id'=>'formcaja'])!!}
                    @include('mensajes.mensaje')
                    <input type="hidden" id="idcaja" name="idcaja" />
                    {!! Form::label('caja','Numero de Caja: ',['class'=>'control-label'])!!}
                    {!! Form::text('caja','Caja Chica '.$num,['id'=>'caja','class'=>'form-control','placeholder'=>'Caja Chica 0'])!!}
                    <div class="text-red" id="error-caja"></div>
                    {!! Form::label('cheque','Cheque: ',['class'=>'control-label'])!!}
                    {!! Form::select('lischeque',$cheques,null,['id'=>'lischeque','class'=>'form-control','placeholder'=>'selecciona el Cheque','onchange'=>'changecheque()']) !!}
                    <div class="text-red" id="error_lischeque"></div>
                    {!! Form::label('numero','Numero de Cheque: ',['class'=>'control-label'])!!}
                    {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'N° de Cheque'])!!}
                    <div class="text-red" id="error_numero"></div>
                    {!! Form::label('monto','Monto: ',['class'=>'control-label'])!!}
                    {!! Form::text('importe',null,['id'=>'importe','class'=>'form-control','placeholder'=>'S/. 0.00'])!!}
                    <div class="text-red" id="error_importe"></div>
                {!!Form::close()!!}                   
            </div>
            <div class="modal-footer">                              
                <a onclick="regCajaChica()"  class="btn btn-dropbox" id="remcaja">Registrar &nbsp;<span class="glyphicon glyphicon-floppy-save">  </span></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>                    
        </div>
    </div>
</div>
