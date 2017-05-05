@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    MOVIMIENTOS BANCARIOS
@stop
@section('main-content')
<div class="box box-primary box-solid">
    <div class="box-header">
        <a class="btn btn-dropbox" data-toggle='tooltip' title="Nuevo Movimiento Bacanario">NUEVO MOVIMIENTO&nbsp;<i class="fa fa-retweet"></i></a>
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body">
        @include('Tesoreria.movBancarioList')
    </div>
</div>
@stop

@section('script')
<script>
    $(document).ready(function(){
       $("#menutesoreria").addClass('active');
       $("#subbanco").addClass('active');
    });
  
</script>
@stop
