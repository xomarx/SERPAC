@extends('Reportes.masterInform')
@section('contentheader_title')
    GRAFICO DE DISTRIBUCION DE FONDOS PARA ACOPIO
@stop
@section('main-content')
@permission('ver distribucion fondos')
<div class="box box-primary ">    
    <div class="box-header">
        <div class="col-md-12">
            <div class="col-md-2">
               {!!Form::label('anio','Año: ',['class'=>'control-label'])!!}
                {!! Form::select('anio',$anios,null,['id'=>'anio','class'=>'form-control']) !!}            
            </div>
            <div class="col-md-2">
                {!!Form::label('mes','Mes: ',['class'=>'control-label'])!!}
            {!! Form::select('mes',[],null,['id'=>'mes','class'=>'form-control','placeholder'=>'Seleccione']) !!}
            </div> 
            <div class="col-md-4">
                {!! Form::label('texnicos','Extensionistas: ',['class'=>'control-label ']) !!}<br>
                {!! Form::select ('tecnico',$tecnicos,null,['id'=>'tecnico','class'=>'form-control','placeholder'=>'Seleccione un Extensionista']) !!}
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
       $("#subdistribucion").addClass('active');
       $("#menuinformes").addClass('active');       
    }); 
    $("#anio").change(function(event){        
        meses(event.target.value);
        grafico_distribucion($("#tecnico").val(),event.target.value,$("#mes").val());
    });
    
    $("#mes").change(function(event){
        grafico_distribucion($("#tecnico").val(),$("#anio").val(),event.target.value);
    });
    $("#tecnico").select2({
        alloClear:true,    
//        grafico_distribucion($("#tecnico").val(),$("#anio").val(),0);
    });
    $("#tecnico").change(function(event){
        grafico_distribucion(event.target.value,$("#anio").val(),0);
    });
</script>
@stop