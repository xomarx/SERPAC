@extends('Tesoreria.mastertesoreria')
@section('contentheader_title')
    CHEQUES
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        @permission('crear cheques')
        <a onclick="activarmodal(3)" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevos Cheques">NUEVO CHEQUE &nbsp;<span class="glyphicon glyphicon-plus"></span></a>
        @endpermission
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body" id="contenidos-box">
        @permission('ver cheques')        
        @include('Tesoreria.chequesList')
        @endpermission
</div>
</div>

<section id="conten-modal"></section>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $("#subbasico").addClass('active');
        $("#subcheque").addClass('active');
        $("#menutesoreria").addClass('active');
        activarForm(12);
    })
    
    $("#buscar").keyup(function(event){
        activarForm(12);
    });
</script>
@stop