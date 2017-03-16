@extends('Acopio.masteracopio')
@section('contentheader_title')
    CIERRE MENSUAL
@stop
@section('main-content')
<div class="box box-primary box-solid">
    <div class="box-header">                       
        <button  class="btn btn-dropbox dropdown-toggle" type="button" data-toggle="dropdown" id="btnexportar">EXPORTAR
            <span class="caret"></span></button>
            <ul class="dropdown-menu btn btn-github">
                <li class="btn-dropbox"><a href="{{ url('/Acopio/Excel') }}">Exportar a Excel</a></li>
                <li class="btn-dropbox"><a href="{{ url('/Acopio/Pdf') }}">Exportar a PDF</a></li>        
            </ul>
    </div>
    <div class="box-body">
        <h3 align='center'>COMPRAS DE ACOPIO DE GRANOS Y SALDOS DE DINERO</h3>
        <div class="col-md-12">
            <div class="col-md-2">
                <img src="{{ url('img/acopagro logo.png')}}" class="img-responsive" />
            </div>
            <div class="col-md-7 form-horizontal">
                <br>
                {!!Form::label('almacen','Almacen: ',['class'=>'control-label col-sm-2'] )!!}
                {!! Form::text('almacen',null,['id'=>'almacen','class'=>'col-md-10','placeholder'=>'Centros de Acopio'])!!}
            </div>
            <div class="col-md-7 form-horizontal">
                {!!Form::label('sector','Sector: ',['class'=>'control-label col-sm-2'] )!!}
                {!! Form::text('sector',null,['id'=>'sector','class'=>'col-md-10','placeholder'=>'Apellido y Nombre del Socio'])!!}
            </div>
            <div class="col-md-7 form-horizontal">
                {!!Form::label('mes','Mes: ',['class'=>'control-label col-sm-2'] )!!}
                {!! Form::text('socio',null,['id'=>'socio','class'=>'col-md-10','placeholder'=>'Apellido y Nombre del Socio'])!!}
            </div>
            <div class="col-md-7 form-horizontal">
                {!!Form::label('acopiador','Acopiador',['class'=>'control-label col-sm-2'] )!!}
                {!! Form::text('acopiador',null,['id'=>'acopiador','class'=>'col-md-10','placeholder'=>'Apellido y Nombre del Socio'])!!}
            </div>
        </div>
        <table class="table table-responsive table-hover " id="MyTable">
            <thead>
                <tr>
                    <th>DETALLES</th>
                    <th>KILOS ACOPIADOS</th>
                    <th>IMPORTES S/. <th>
                    <th>INCENTIVO S/. </th>
                    <th>FLETE S/. </th>
                    <th>ESTIBAJE S/. </th>
                    <th>ALQUILER S/. </th>
                    <th>OTROS S/. </th>
                    <th>TOTAL S/. </th>
                    <th>SALDO ANTERIOR</th>
                    <th>DINERO RECIBIDO</th>
                    <th>DINERO ACUMULADO</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>CACAO SOCIOS</th>
                </tr>
                @foreach ($condiciones as $condicion )
                <tr>
                    <td>{{$condicion->condicion }}</td>
                </tr>
                
                @endforeach
                <tr>
                    <th>CACAO NO SOCIOS</th>
                </tr>
                <tr>
                    <td>CONVENCIONAL</td>
                </tr>
                <tr>
                    <th>TOTAL ACOPIO</th>
                </tr>
            </tbody>            
        </table>
    </div>
</div>

@stop
@section('script')
<script>
$("#almacen").autocomplete({
    minLength:1,
         autoFocus:true,
         delay:1,
         source: "{{url('RRHH/Sucursales')}}",
         select: function(event,ui){ 
             
              $("#sector").val(ui.item.sector);
              $("#acopiador").val(ui.item.acopiador);
         }
});
</script>
@stop