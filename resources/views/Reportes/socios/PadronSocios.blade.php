@extends('Reportes.masterInform')
@section('contentheader_title')
    REPORTE DE PADRON DE SOCIOS
@stop
@section('main-content')
<div class="box box-primary ">
    <div class="box-header">
        <a class="btn btn-dropbox">GRAFICOS <i class="glyphicon glyphicon-stats"></i></a>
        <a href="{{url('ReporpadronSocios')}}" class="btn btn-dropbox" target="_blank">PADRON SOCIOS <i class="fa fa-file-pdf-o"></i></a>
    </div>
    <div class="box box-body box-primary">
        <div class="col-md-12">
            <div class="col-md-2">
               {!!Form::label('anio','Año: ',['class'=>'control-label'])!!}
            {!! Form::select('anio',$anios,null,['id'=>'anio','class'=>'form-control']) !!} 
           
            </div>
            <div class="col-md-2">
                {!!Form::label('mes','Mes: ',['class'=>'control-label'])!!}
            {!! Form::select('mes',$meses,null,['id'=>'mes','class'=>'form-control']) !!}
            </div>
                       
        </div>                               
    </div>
    <div class="box box-success">                            
        <div  id="div-graficas" >            
        </div>        
            </div>
</div>

@stop
@section('script')
<script>
    $(document).ready(function(){cargar_barras(0,0)});
    $("#anio").change(function(){
        console.log($("#anio").val());
        console.log($("#mes").val());
        cargar_barras($("#anio").val(),$("#mes").val())
    });
    $("#mes").change(function(){
        console.log($("#anio").val());
        console.log($("#mes").val());
        cargar_barras($("#anio").val(),$("#mes").val())
    });
</script>

@stop