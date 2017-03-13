@extends('Acopio.masteracopio')
@section('contentheader_title')
    PAGOS 
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a  class="btn btn-sm btn-dropbox" data-toggle='modal' data-target='#modalegresos' >NUEVO  <span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="top" title="Nuevos Gastos"></span></a>        
    </div>
    <div class="box-body">
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>GASTOS</th>
                    <th>ALMACEN</th>
                    <th>MONTO</th>
                    <th>USUARIO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($egresos as $egreso)
                <tr>
                    <td>{{$egreso->fecha }}</td>
                    <td>{{$egreso->tipo_egreso }}</td>
                    <td>{{$egreso->sucursal }}</td>
                    <td>{{$egreso->name }}</td>
                    <td>
                        <a class="btn btn-sm btn-success" ><span class="glyphicon glyphicon-print"></span></a>
                        <a class="btn btn-sm btn-danger" onclick="EliGasto('{{$egreso->id}}','{{$egreso->tipo_egreso }}');" ><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal" role="dialog" id="modalegresos">
    <div class="modal-dialog modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">REGISTRO DE PAGOS</h3>
            </div>
            {!! Form::open(['id'=>'formegresos']) !!}
            <div class="modal-body form-group-sm">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="id" id="idegresos"/>                
                <div class="col-md-12">
                    <div class="col-md-3">
                        {!! Form::label('fecha','Fecha:',['class' => 'control-label'])!!}
                        <input type="text" name="fecha" id="fecha" class="form-control" value="{{date('m/d/Y') }}" placeholder="mm/dd/yyyy" />
                        <div class="text-danger" id="error-fecha"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('monto','Monto:',['class' => 'control-label'])!!}
                        <input type="number" class="form-control" placeholder="S/. 0.00" name="monto" id="monto" min="0"/>
                        <div class="text-danger" id="error-monto"></div>
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('pagos','Pagos:',['class' => 'control-label'])!!}
                        {!! Form::select('egresos',$tipo_egresos,null,['id'=>'egresos','class'=>'form-control','placeholder'=>'Selecciona un Egreso']) !!}
                        <div class="text-danger" id="error-egresos"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('almacen','Almacenes:',['class' => 'control-label'])!!}                    
                    {!! Form::select('almacen',$almacenes,null,['id'=>'almacen','placeholder'=>'Selecciona un almacen']) !!}
                    <div class="text-danger" id="error-almacen"></div>
                </div>
                <div class="col-md-6">
                        {!! Form::label('motivo','Motivos:',['class' => 'control-label'])!!}
                        {!! Form::textarea('motivo',null,['id'=>'motivo','class'=>'form-control','placeholder'=>'Motivo del pago','rows'=>3,'cols'=>38])!!}
                </div>                                
            </div>
            
            <div class="modal-footer">                
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegEgresos', 'class'=>'btn btn-dropbox btn-sm m-t-10'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop
@section('script')
<script>
    $("#fecha").datepicker({
        autoclose: true,
        language: "es"
    });
    
    $("#almacen").select2({alloClear:true});
        
</script>

@stop
