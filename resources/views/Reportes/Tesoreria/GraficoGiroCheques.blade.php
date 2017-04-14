@extends('Reportes.masterInform')
@section('contentheader_title')
    GRAFICO DE GIRO DE CHEQUES
@stop
@section('main-content')
@permission('ver movimiento cheques')
<div class="box box-primary ">    
    <div class="box-header">
        <div class="col-md-12">
            <div class="col-md-2">
               {!!Form::label('anio','Año: ',['class'=>'control-label'])!!}
            {!! Form::select('anio',$anios,null,['id'=>'anio','class'=>'form-control']) !!} 
           
            </div>
            <div class="col-md-2">
                {!!Form::label('mes','Mes: ',['class'=>'control-label'])!!}
            {!! Form::select('mes',[],null,['id'=>'mes','class'=>'form-control']) !!}
            </div>
                       
        </div>                               
    </div>
    <div class="box box-success">                            
        <div  id="div-graficas" >            
        </div>        
    </div>
</div>
@endpermission
@stop

@section('script')
<script>
    $(document).ready(function(){
       $("#infotesoreria").addClass('active');
       $("#subgiros").addClass('active');
       $("#menuinformes").addClass('active');
       grafico_barra_delivery_money($("#anio").val(),0);
    }); 
    $("#anio").change(function(event){        
        meses(event.target.value);
        grafico_barra_delivery_money(event.target.value,$("#mes").val());
    });
    
    $("#mes").change(function(event){
        grafico_barra_delivery_money($("#anio").val(),event.target.value);
    });
    
    
</script>

@stop