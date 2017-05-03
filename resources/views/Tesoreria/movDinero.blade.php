@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    GASTOS DE TESORERIA
@stop
@section('main-content')
<div class="box box-primary box-solid">
    <div class="box-header">
        <a class="btn btn-dropbox">Con Documento</a>
        <a class="btn btn-dropbox">Sin Documento</a>
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body">
        @include('Tesoreria.movDineroList')
    </div>
</div>
<section id="conten-modal"></section>
@stop

@section('script')
<script>
    
</script>
@stop