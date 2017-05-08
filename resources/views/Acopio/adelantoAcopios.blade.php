@extends('Acopio.masteracopio')
@section('contentheader_title')
    ADELANTOS DE ACOPIO
@stop
@section('main-content')
<div class="box box-primary box-solid">
    <div class="box-header">
        <a class="btn btn-dropbox" onclick="activarmodal(9)">NUEVO ADELANTO</a>
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body" id="contenidos-box">
        @include('Acopio.adelantoAcopiosList')
    </div>
</div>
<section id="conten-modal"></section>
@stop
@section('script')
<script>                
    $(document).ready(function(){
       $("#subadelaAcopio").addClass('active');
       $("#menuacopio").addClass('active');
    });
        
</script>

@stop