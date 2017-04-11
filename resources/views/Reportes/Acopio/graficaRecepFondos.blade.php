@extends('Reportes.masterInform')
@section('contentheader_title')
    GRAFICO DE DISTRIBUCION DE FONDOS
@stop
@section('main-content')
@permission('ver kardex dinero')
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
       $("#infoacopio").addClass('active');
       $("#subdinero").addClass('active');
       $("#menuinformes").addClass('active');
       grafico_barra_k_Dinero($("#anio").val(),0);
    }); 
    $("#anio").change(function(event){        
        meses(event.target.value);
        grafico_barra_k_Dinero(event.target.value,$("#mes").val());
    });
    
    $("#mes").change(function(event){
        grafico_barra_k_Dinero($("#anio").val(),event.target.value);
    });
    
    
</script>

@stop