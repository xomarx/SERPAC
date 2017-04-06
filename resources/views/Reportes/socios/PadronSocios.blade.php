@extends('Reportes.masterInform')
@section('contentheader_title')
    REPORTE DE PADRON DE SOCIOS
@stop
@section('main-content')
<div class="box box-primary ">
    <div class="box-header">
        <a class="btn btn-dropbox">GRAFICOS <i class="glyphicon glyphicon-stats"></i></a>
        <a class="btn btn-dropbox">PADRON SOCIOS <i class="fa fa-file-pdf-o"></i></a>
    </div>
    <div class="box box-bod">
        <div class="col-md-12">
            {!! Form::select('anio',[],null,['id'=>'anio','placeholder'=>'selecciona']) !!}
        </div>
    </div>
</div>

@stop
