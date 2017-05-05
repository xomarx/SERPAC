

<div class="col-md-6"  >
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">COMPROBANTE DE PAGO</h3>
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box box-body">
                
                    <div class="col-sm-1 radio-inline" >
                        <label onclick="tipoevent()">
                            <input type="radio" value="1" name="tipo" id="tipoI" />Ingreso
                        </label >
                        <label onclick="tipoevent()"> 
                            <input type="radio" value="0" name="tipo" id='tipoE' />Egreso
                        </label>
                    </div>
                <div class="col-sm-offset-1 col-sm-5">
                        {!! Form::label('Comprobante','Comprobante: ',['class'=>'control-label'])!!}
                        {!! Form::select('comprobante',['TICKET'=>'Ticket','RECIBO'=>'Recibo','VOUCHER'=>'Voucher','FACTURA'=>'Factura','BOLETA'=>'Boleta'
                        ],null,['id'=>'comprobante','class' =>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-red" id="error-comprobante"></div>
                    </div>
                <div class="col-md-4">
                        {!! Form::label('numero','N° Comprobante: ',['class'=>'control-label'])!!}
                        {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'001-000000'])!!}
                        <div class="text-red" id="error-numero"></div>
                    </div>
                <div class="col-md-5">
                        {!! Form::label('fecha','Fecha: ',['class'=>'control-label'])!!}
                        {!! Form::date('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'dd/mm/yyyy'])!!}
                        <div class="text-red" id="error-fecha"></div>
                    </div>
                
                <div class="col-md-4" id="divruc">
                        {!! Form::label('ruc','Ruc: ',['class'=>'control-label'])!!}
                        {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'R.U.C'])!!}
                    <div class="text-red" id="error-ruc"></div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::label('razon','Razon Social: ',['class'=>'control-label'])!!}
                        {!! Form::text('razon',null,['id'=>'razon','class'=>'form-control','placeholder'=>'Razon Social'])!!}
                        <div class="text-red" id="error-razon"></div>
                    </div>
                <div class="col-md-12" id="divdireccion">
                        {!! Form::label('direccion','Direccion: ',['class'=>'control-label'])!!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion'])!!}
                        <div class="text-red" id="error-razon"></div>
                    </div>
                
                <div class="col-md-12" style="padding-bottom: 10px">
                        {!! Form::label('Concepto','Concepto: ',['class'=>'control-label'])!!}
                        {!! Form::text('concepto',null,['id'=>'concepto','class'=>'form-control','placeholder'=>'Concepto'])!!}
                        <div class="text-red" id="error-razon"></div>
                </div>
                
                <table border='1' width='100%' id="tablacomprobante">
                    <thead>
                        <tr>            
                            <th>FECHA</th>
                            <th>RESPONSABLE</th>
                            <th>DETALLE</th>                            
                            <th>TOTAL</th>
                            <th>DEL</th>
                        </tr>
                    </thead>
                    <tbody>                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align='center'>TOTAL</td>                            
                            <td id="totalcomprobante" align='center'>0.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="box-footer">
                <a class="btn btn-dropbox">REGISTRAR</a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

<div class="col-md-6">
    <!-- DIRECT CHAT PRIMARY -->
    <div class="box box-primary direct-chat direct-chat-primary">
        <div class="box-header with-border">
            <h3 class="box-title">EXPORTACIONES</h3>
            <div class="box-tools pull-right">                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                    <i class="fa fa-comments"></i></button>                
            </div>
        </div>        
        <div class="box-body" style="display: block;">            
            <div class="direct-chat-messages">
                <table width='100%' border='1' class="table-hover table-responsive" id="tablaxportacion">
                    <thead>
                        <tr >
                            <th >FECHA</th>
                            <th>RESPONSABLE</th>
                            <th>DETALLES</th>
                            <th>MONTO</th>                            
                            <th>DOC</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--*/ @$total = 0 /*--}}
                        @foreach($dineros as $dinero)
                        @if($dinero->tipoGasto == 1)
                        {{--*/ @$total = $total + $dinero->monto /*--}}
                        <tr>
                            <td>{{$dinero->fecha}}</td>
                            <td>{{$dinero->empleado}}</td>
                            <td>{{$dinero->detalle}}</td>
                            <td>{{number_format($dinero->monto,2)}}</td>
                            @if($dinero->estado == 0)
                            <td><a class="btn-xs btn "  id="btnEI" onclick="GenComp(this,{{$dinero->id}},{{$dinero->estado}},'tablaxportacion',{{$dinero->monto}})" ><i class="glyphicon glyphicon-export"></i></a></td>
                            @else
                            <td><a  class="btn-xs btn "  id="btnEI" onclick="GenComp(this,{{$dinero->id}},{{$dinero->estado}},'tablaxportacion',{{$dinero->monto}})"><i class="glyphicon glyphicon-import"></i></a></td>
                            @endif
                        </tr>
                        @endif
                        @endforeach                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align='center'>TOTAL</td>                            
                            <td id="totalE">{{number_format($total,2)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="direct-chat-contacts">
                {!! Form::open(['id'=>'formDineroE']) !!}
                @include('mensajes.mensaje')
                <input type="hidden" name="gasto" id="gasto" value="1" />
                <div class="col-md-5">
                        {!! Form::label('fecha','Fecha: ',['class'=>'control-label'])!!}
                        {!! Form::date('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'dd/mm/YYYY'])!!}
                        <div class="text-red" id="error-fecha"></div>
                </div>
                <div class="col-md-4">
                        {!! Form::label('monto','Monto: ',['class'=>'control-label'])!!}
                        {!! Form::number('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00','min'=>0])!!}
                        <div class="text-red" id="error-monto"></div>
                </div>
                <div class="col-md-3">
                        {!! Form::label('dni','D.N.I.: ',['class'=>'control-label'])!!}
                        {!! Form::text('dni',null,['id'=>'dniE','class'=>'form-control','placeholder'=>'N° DNI'])!!}
                        <div class="text-red" id="error-dni"></div>
                </div>                
                <div class="col-sm-offset-1 col-sm-3 radio-inline" >
                    {!! Form::label('tipo','Movimiento: ',['class'=>'control-label'])!!}
                        <label>
                            <input type="radio" value="1" name="tipo" />Ingreso
                        </label><br>
                        <label>
                            <input type="radio" value="0" name="tipo" />Egreso
                        </label>
                        <div class="text-red" id="error-tipo"></div>
                    </div>
                
                <div class="col-md-8">
                        {!! Form::label('responsable','Responsable: ',['class'=>'control-label'])!!}
                        {!! Form::text('nombres',null,['id'=>'nombresE','class'=>'form-control','placeholder'=>'Apellidos y Nombres'])!!}
                        <div class="text-red" id="error-nombres"></div>
                </div>
                <div class="col-md-8">
                        {!! Form::label('detalle','Detalle: ',['class'=>'control-label'])!!}
                        {!! Form::text('detalle',null,['id'=>'detalle','class'=>'form-control','placeholder'=>'Detalle'])!!}
                        <div class="text-red" id="error-detalle"></div>
                </div>
                <div class="col-sm-12">
                    <a class="btn btn-dropbox" id="RegMovDineroE">REGISTRAR</a>
                </div>
                {!!Form::close()!!}                
            </div>            
        </div>        
    </div>    
</div>

<div class="col-md-6">
    <!-- DIRECT CHAT PRIMARY -->
    <div class="box box-success direct-chat direct-chat-primary">
        <div class="box-header with-border">
            <h3 class="box-title">GASTOS SIN SUSTENTO</h3>

            <div class="box-tools pull-right">                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                    <i class="fa fa-comments"></i></button>                
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
                <table width='100%' border='1' class="table-hover table-responsive">
                    <thead>
                        <tr >
                            <th >FECHA</th>
                            <th>RESPONSABLE</th>
                            <th>DETALLES</th>
                            <th>MONTO</th>                            
                            <th>DOC</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--*/ @$total = 0 /*--}}
                        @foreach($dineros as $dinero)
                        @if($dinero->tipoGasto == 2)
                        {{--*/ @$total = $total + $dinero->monto /*--}}
                        <tr>
                            <td>{{$dinero->fecha}}</td>
                            <td>{{$dinero->empleado}}</td>
                            <td>{{$dinero->detalle}}</td>
                            <td>{{number_format($dinero->monto,2)}}</td>
                            @if($dinero->estado == 0)
                            <td><a class="btn-xs btn " data-toggle="tooltip" title="EGRESOS" ><i class="glyphicon glyphicon-export"></i></a></td>
                            @else
                            <td><a class="btn-xs btn " data-toggle="tooltip" title="INGRESOS"><i class="glyphicon glyphicon-import"></i></a></td>
                            @endif
                        </tr>
                        @endif
                        @endforeach                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align='center'>TOTAL</td>                            
                            <td>{{number_format($total,2)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!--/.direct-chat-messages-->

            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
                {!! Form::open(['id'=>'formDineroS']) !!}                
                <input type="hidden" name="gasto" id="gasto" value="2" />
                <div class="col-md-5">
                        {!! Form::label('fecha','Fecha: ',['class'=>'control-label'])!!}
                        {!! Form::date('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'dd/mm/YYYY'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-4">
                        {!! Form::label('monto','Monto: ',['class'=>'control-label'])!!}
                        {!! Form::number('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00','min'=>0])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-3">
                        {!! Form::label('dni','D.N.I.: ',['class'=>'control-label'])!!}
                        {!! Form::text('dni',null,['id'=>'dniS','class'=>'form-control','placeholder'=>'N° DNI'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>                
                <div class="col-sm-offset-1 col-sm-3 radio-inline" >
                    {!! Form::label('tipo','Movimiento: ',['class'=>'control-label'])!!}
                        <label>
                            <input type="radio" value="1" name="tipo" />Ingreso
                        </label><br>
                        <label>
                            <input type="radio" value="0" name="tipo" />Egreso
                        </label>
                    </div>
                
                <div class="col-md-8">
                        {!! Form::label('responsable','Responsable: ',['class'=>'control-label'])!!}
                        {!! Form::text('nombres',null,['id'=>'nombresS','class'=>'form-control','placeholder'=>'Apellidos y Nombres'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-8">
                        {!! Form::label('detalle','Detalle: ',['class'=>'control-label'])!!}
                        {!! Form::text('detalle',null,['id'=>'detalle','class'=>'form-control','placeholder'=>'Detalle'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-sm-12">
                    <a class="btn btn-dropbox" id="RegMovDineroS">REGISTRAR</a>
                </div>
                {!!Form::close()!!}
            </div>
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.box-body -->
        
        <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->
</div>

<div class="col-md-6">
    <!-- DIRECT CHAT PRIMARY -->
    <div class="box box-info direct-chat direct-chat-primary">
        <div class="box-header with-border">
            <h3 class="box-title">GASTOS GERENCIA</h3>

            <div class="box-tools pull-right">                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                    <i class="fa fa-comments"></i></button>
                
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
                <table width='100%' border='1' class="table-hover table-responsive">
                    <thead>
                        <tr >
                            <th >FECHA</th>
                            <th>RESPONSABLE</th>
                            <th>DETALLES</th>
                            <th>MONTO</th>                            
                            <th>DOC</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--*/ @$total = 0 /*--}}
                        @foreach($dineros as $dinero)
                        @if($dinero->tipoGasto == 3)
                        {{--*/ @$total = $total + $dinero->monto /*--}}
                        <tr>
                            <td>{{$dinero->fecha}}</td>
                            <td>{{$dinero->empleado}}</td>
                            <td>{{$dinero->detalle}}</td>
                            <td>{{number_format($dinero->monto,2)}}</td>
                            @if($dinero->estado == 0)
                            <td><a class="btn-xs btn " data-toggle="tooltip" title="EGRESOS" ><i class="glyphicon glyphicon-export"></i></a></td>
                            @else
                            <td><a class="btn-xs btn " data-toggle="tooltip" title="INGRESOS"><i class="glyphicon glyphicon-import"></i></a></td>
                            @endif
                        </tr>
                        @endif
                        @endforeach                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align='center'>TOTAL</td>                            
                            <td>{{number_format($total,2)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!--/.direct-chat-messages-->

            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
                {!! Form::open(['id'=>'formDineroG']) !!}
                <input type="hidden" name="gasto" id="gasto" value="3" />
                <div class="col-md-5">
                        {!! Form::label('fecha','Fecha: ',['class'=>'control-label'])!!}
                        {!! Form::date('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'dd/mm/YYYY'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-4">
                        {!! Form::label('monto','Monto: ',['class'=>'control-label'])!!}
                        {!! Form::number('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00','min'=>0])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-3">
                        {!! Form::label('dni','D.N.I.: ',['class'=>'control-label'])!!}
                        {!! Form::text('dni',null,['id'=>'dniG','class'=>'form-control','placeholder'=>'N° DNI'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>                
                <div class="col-sm-offset-1 col-sm-3 radio-inline" >
                    {!! Form::label('tipo','Movimiento: ',['class'=>'control-label'])!!}
                        <label>
                            <input type="radio" value="1" name="tipo" />Ingreso
                        </label><br>
                        <label>
                            <input type="radio" value="0" name="tipo" />Egreso
                        </label>
                    </div>
                
                <div class="col-md-8">
                        {!! Form::label('responsable','Responsable: ',['class'=>'control-label'])!!}
                        {!! Form::text('nombres',null,['id'=>'nombresG','class'=>'form-control','placeholder'=>'Apellidos y Nombres'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-8">
                        {!! Form::label('detalle','Detalle: ',['class'=>'control-label'])!!}
                        {!! Form::text('detalle',null,['id'=>'detalle','class'=>'form-control','placeholder'=>'Detalle'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-sm-12">
                    <a class="btn btn-dropbox" id="RegMovDineroG">REGISTRAR</a>
                </div>
                {!!Form::close()!!}
            </div>
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.box-body -->
        
        <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->
</div>

<div class="col-md-6">
    <!-- DIRECT CHAT PRIMARY -->
    <div class="box box-warning direct-chat direct-chat-primary">
        <div class="box-header with-border">
            <h3 class="box-title">FACTURAS PENDIENTES</h3>

            <div class="box-tools pull-right">                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                    <i class="fa fa-comments"></i></button>                
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
                <table width='100%' border='1' class="table-hover table-responsive">
                    <thead>
                        <tr >
                            <th >FECHA</th>
                            <th>RESPONSABLE</th>
                            <th>DETALLES</th>
                            <th>MONTO</th>                            
                            <th>DOC</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--*/ @$total = 0 /*--}}
                        @foreach($dineros as $dinero)
                        @if($dinero->tipoGasto == 4)
                        {{--*/ @$total = $total + $dinero->monto /*--}}
                        <tr>
                            <td>{{$dinero->fecha}}</td>
                            <td>{{$dinero->empleado}}</td>
                            <td>{{$dinero->detalle}}</td>
                            <td>{{number_format($dinero->monto,2)}}</td>
                            @if($dinero->estado == 0)
                            <td><a class="btn-xs btn " data-toggle="tooltip" title="EGRESOS" ><i class="glyphicon glyphicon-export"></i></a></td>
                            @else
                            <td><a class="btn-xs btn " data-toggle="tooltip" title="INGRESOS"><i class="glyphicon glyphicon-import"></i></a></td>
                            @endif
                        </tr>
                        @endif
                        @endforeach                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align='center'>TOTAL</td>                            
                            <td>{{number_format($total,2)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="direct-chat-contacts">
                {!! Form::open(['id'=>'formDineroF']) !!}
                <input type="hidden" name="gasto" id="gasto" value="4" />
                <div class="col-md-5">
                        {!! Form::label('fecha','Fecha: ',['class'=>'control-label'])!!}
                        {!! Form::date('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'dd/mm/YYYY'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-4">
                        {!! Form::label('monto','Monto: ',['class'=>'control-label'])!!}
                        {!! Form::number('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00','min'=>0])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-3">
                        {!! Form::label('dni','D.N.I.: ',['class'=>'control-label'])!!}
                        {!! Form::text('dni',null,['id'=>'dniF','class'=>'form-control','placeholder'=>'N° DNI'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>                
                <div class="col-sm-offset-1 col-sm-3 radio-inline" >
                    {!! Form::label('tipo','Movimiento: ',['class'=>'control-label'])!!}
                        <label>
                            <input type="radio" value="1" name="tipo" />Ingreso
                        </label><br>
                        <label>
                            <input type="radio" value="0" name="tipo" />Egreso
                        </label>
                    </div>
                
                <div class="col-md-8">
                        {!! Form::label('responsable','Responsable: ',['class'=>'control-label'])!!}
                        {!! Form::text('nombres',null,['id'=>'nombresF','class'=>'form-control','placeholder'=>'Apellidos y Nombres'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-md-8">
                        {!! Form::label('detalle','Detalle: ',['class'=>'control-label'])!!}
                        {!! Form::text('detalle',null,['id'=>'detalle','class'=>'form-control','placeholder'=>'Detalle'])!!}
                        <div class="text-red" id="error-numero"></div>
                </div>
                <div class="col-sm-12">
                    <a class="btn btn-dropbox" id="RegMovDineroF">REGISTRAR</a>
                </div>
                {!!Form::close()!!}
            </div>           
        </div>
    </div>
</div>