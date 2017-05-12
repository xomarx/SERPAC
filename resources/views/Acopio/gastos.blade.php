@extends('Acopio.masteracopio')
@section('contentheader_title')
    GASTOS DE ALMACEN 
@stop
@section('main-content')
@permission('ver pagos')
<div class="box box-solid box-primary">
    <div class="box-header">
        @permission('crear pagos')
        <a  class="btn btn-dropbox" data-toggle='modal' data-target='#modalegresos' >NUEVO GASTO  <span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="top" title="Nuevos Gastos"></span></a>
        @endpermission
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body" id="contenidos-box">
        @include('Acopio.gastosList')
    </div>
</div>
<section id="conten-modal"></section>
@endpermission

@permission('crear pagos')
<div class="modal" role="dialog" id="modalegresos">
    <div class="modal-dialog modal-primary">
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <h3 class="modal-title">GASTOS DE ALMACEN</h3>
            </div>
            <div class="modal-body form-group">   
                {!! Form::open(['id'=>'formegresos']) !!}
                @include('mensajes.mensaje')
                <div class="box-body bg-primary" >

                    <input type="hidden" name="id" id="idegresos"/> 
                    <div class="col-md-8">
                        {!! Form::label('almacen','Almacenes:',['class' => 'control-label'])!!} <br>                   
                        {!! Form::select('almacen',$almacenes,null,['id'=>'almacen','placeholder'=>'Seleccione el Almacen','style'=>'width:100%']) !!}
                        <div class="text-danger" id="error-almacen"></div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('fecha','Fecha:',['class' => 'control-label'])!!}
                        <input type="date" name="fecha" id="fecha" class="form-control" />
                        <div class="text-danger" id="error-fecha"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('comprobante','Comprobante:',['class' => 'control-label'])!!}
                        {!! Form::select('comprobante',['RECIBO'=>'Recibo','FACTURA'=>'Factura','BOLETA'=>'Boleta'
                        ],null,['id'=>'comprobante','class' =>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error-comprobante"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('numero','N° Comprobante:',['class' => 'control-label'])!!}
                        <input type="text" class="form-control" placeholder="N° 000-0000" name="numero" id="numero" />
                        <div class="text-danger" id="error-numero"></div>
                    </div> 
                    <div class="col-md-3" id="divruc">
                        {!! Form::label('ruc','R.U.C.: ',['class'=>'control-label','id'=>'lruc'])!!}
                        {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'R.U.C','maxlength'=>11])!!}
                        <div class="text-red" id="error-ruc"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('monto','Monto:',['class' => 'control-label'])!!}
                        <input type="number" class="form-control" placeholder="S/. 0.00" name="monto" id="monto" min="0"/>
                        <div class="text-danger" id="error-monto"></div>
                    </div>
                    <div class="col-md-12" >
                        {!! Form::label('razon','Razon Social: ',['class'=>'control-label','id'=>'lrazon'])!!}
                        {!! Form::text('razon',null,['id'=>'razon','class'=>'form-control','placeholder'=>'Razon Social'])!!}
                        <div class="text-red" id="error-razon"></div>
                    </div>
                    <div class="col-md-12" id="divdireccion">
                        {!! Form::label('direccion','Direccion: ',['class'=>'control-label'])!!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion'])!!}
                        <div class="text-red" id="error-direccion"></div>
                    </div>
                    <div class="col-md-12" >
                        {!! Form::label('concepto','Concepto: ',['class'=>'control-label'])!!}
                        {!! Form::text('concepto',null,['id'=>'concepto','class'=>'form-control','placeholder'=>'Concepto de Gasto'])!!}
                        <div class="text-red" id="error-direccion"></div>
                    </div>                                                                  

                </div>

                {!! Form::close() !!}
            </div>
            <div class="modal-footer">   
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegEgresos', 'class'=>'btn btn-dropbox'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>         
    </div>
</div>
@endpermission
@stop
@section('script')
<script>
        
    $("#almacen").select2({alloClear:true});
    
    $(document).ready(function(){
       $("#subpagos").addClass('active');
       $("#menuacopio").addClass('active');
    });
        
</script>

@stop
