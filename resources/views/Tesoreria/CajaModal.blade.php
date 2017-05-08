<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary modal-sm">
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" align="center" id="titulocaja">{{$apertura}}</h3>
            </div>
            <div class="modal-body form-horizontal">     
                {!! Form::open(['id'=>'formcaja']) !!}
                <input type="hidden" name="idcaja" id="idcaja" />
                <input type="hidden" name="starttime" id="starttime" />
                    @include('mensajes.mensaje')
                    <div class="col-md-12">
                        {!! Form::label('monto','monto: ',['class'=>'control-label'])!!}
                    {!! Form::number('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00','min'=>'0.00','style'=>"text-align: center"])!!}
                    <div class="text-red" id="error-monto"></div>
                    </div> 
                    <div class="col-sm-12">
                        {!! Form::label('observacion','Observacion: ',['class'=>'control-label'])!!}
                    {!! Form::textarea('observacion',null,['id'=>'observacion','class'=>'form-control','placeholder'=>'Observacion de Caja','rows'=>'3'])!!}
                    <div class="text-red" id="error_descripcion"></div>
                    </div>
                    {!!Form::close()!!}            
                     <div class="modal-footer">                              
                <a id="RegCaja" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Rol de Usuarios">Registrar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div> 
            </div>
                              
        </div>
    </div>
</div>