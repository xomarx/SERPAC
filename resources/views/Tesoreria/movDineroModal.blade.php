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
                    <div class="col-sm-1 radio-inline" >
                        <label onclick="tipoevent()">
                            <input type="radio" value="1" name="tipo"  id="tipoI"/>Ingreso
                        </label>
                        <label onclick="tipoevent()">
                            <input type="radio" value="0" name="tipo" id="tipoE" />Egreso
                        </label>
                        <div class="text-red" id="error-tipo"></div>
                    </div>
                    <div class="col-sm-offset-1 col-sm-4">
                        {!! Form::label('Comprobante','Comprobante: ',['class'=>'control-label'])!!}
                        {!! Form::select('comprobante',['TRANSFERENCIA'=>'Transferencia','RECIBO'=>'Recibo','VOUCHER'=>'Voucher','FACTURA'=>'Factura','BOLETA'=>'Boleta'
                        ],null,['id'=>'comprobante','class' =>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-red" id="error-comprobante"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('numero','N° Comprobante: ',['class'=>'control-label'])!!}
                        {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'001-000000'])!!}
                        <div class="text-red" id="error-numero"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('fecha','Fecha: ',['class'=>'control-label'])!!}
                        {!! Form::text('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'dd/mm/yyyy'])!!}
                        <div class="text-red" id="error-fecha"></div>
                    </div>
                    
                    <div class="col-md-3" id="divruc">
                        {!! Form::label('ruc','R.U.C.: ',['class'=>'control-label','id'=>'lruc'])!!}
                        {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'R.U.C'])!!}
                    <div class="text-red" id="error-ruc"></div>
                    </div>
                    <div class="col-md-9" >
                        {!! Form::label('razon','Razon Social: ',['class'=>'control-label','id'=>'lrazon'])!!}
                        {!! Form::text('razon',null,['id'=>'razon','class'=>'form-control','placeholder'=>'Razon Social'])!!}
                        <div class="text-red" id="error-razon"></div>
                    </div>
                    <div class="col-md-9" id="divdireccion">
                        {!! Form::label('direccion','Direccion: ',['class'=>'control-label'])!!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion'])!!}
                        <div class="text-red" id="error-direccion"></div>
                    </div>
                    <div class="col-md-3" id="divtelefono">
                        {!! Form::label('telefono','Telefono: ',['class'=>'control-label'])!!}
                        {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'N° telefono'])!!}
                        <div class="text-red" id="error-telefono"></div>
                    </div>
                    
                    <div class="col-md-9">
                        {!! Form::label('Concepto','Concepto: ',['class'=>'control-label'])!!}
                        {!! Form::text('concepto',null,['id'=>'concepto','class'=>'form-control','placeholder'=>'Concepto'])!!}
                        <div class="text-red" id="error-concepto"></div>
                    </div>
                    <div class="col-md-3" style="padding-bottom: 10PX">
                        {!! Form::label('monto','Monto: ',['class'=>'control-label'])!!}
                        {!! Form::number('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00','min'=>0])!!}
                        <div class="text-red" id="error-monto"></div>
                    </div>
                    <div class="col-md-12">                        
                        <button type="button" class="btn btn-default" style="float: right" data-dismiss="modal">Salir</button>
                        <a  id="RegmovDoc" class="btn btn-dropbox" style="float: right">Registrar</a>
                    </div>
                    <div class="modal-footer ">
            </div>
                {!!Form::close()!!}
            </div>                                                      
        </div>
    </div>
</div>