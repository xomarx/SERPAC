
@extends('socios.mastersocio')

@section('contentheader_title')
    Parientes y Beneficiario
@stop
@section('main-content')
@permission('ver parientes')
<div class="box box-primary box-solid">    
    <div class="box-header">
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>    
    
    <div class="box-body" id="contenidos-box">        
        @include('socios.parientesList')
    </div>
</div>
@endpermission
@permission('editar parientes')
<section id="conten-modal"></section>
@endpermission

@stop

@section('script')
<script>
    $(document).ready(function(){
       $("#subparientes").addClass('active');
       $("#menusocios").addClass('active');
       activarForm(16);
    });
    $("#buscar").keyup(function(){
        activarForm(16);
    });
</script>    

@stop
