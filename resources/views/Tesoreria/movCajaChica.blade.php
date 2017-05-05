@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    MOVIMIENTOS DE CAJA CHICA
@stop
@section('main-content')
<div class="box box-primary box-solid">
    <div class="box-header">        
         @permission('crear movimientos')    
            <a class="btn btn-dropbox" onclick="activarmodal(5);" data-toggle='tooltip' title="Nuevo Movimiento Bacanario">NUEVA CAJA CHICA&nbsp;<i class="fa fa-retweet"></i></a>
        @endpermission
    <div class="col-sm-3 form-group-sm" style="float: right">            
        {!! Form::text('buscarc',null,['id'=>'buscarc','class'=>'form-control','placeholder'=>'Buscar..'])!!}
    </div>
    <div class="col-sm-2 form-group-sm" style="float: right">
        {!! Form::select('mesc',['Seleccione el Mes'],null,['id'=>'mesc','class'=>'form-control']) !!} 
    </div>   
    <div class=" form-group-sm" style="float: right">           
        {!! Form::select('anioc',$anios,null,['id'=>'anioc','class'=>'form-control col-md-1']) !!} 
    </div> 
    </div>
    <div class="box-body">
       @include('Tesoreria.CajaChicaList')
    </div>
</div>
@stop

@section('script')
<script>
    $(document).ready(function(){
       $("#menutesoreria").addClass('active');
       $("#subcajachica").addClass('active');
    });
  
</script>
@stop
