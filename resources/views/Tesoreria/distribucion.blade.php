@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    DISTRIBUCION DE FONDOS PARA ACOPIO
@stop
@section('main-content')
@permission('ver distribucion')
<div class="box box-solid box-primary">
    <div class="box-header" >   
        @permission('crear distribucion')
        <a id="nuevadistribucion" data-toggle='modal' data-target='#modaldistribucion' class="btn btn-dropbox" >NUEVA DISTRIBUCION  <span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="top" title="Nueva Distribucion"></span></a>
        @endpermission
        <a id="nuevadistribucion" data-toggle='modal' data-target='#modaldistribucion' class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Exportar Excel" >EXCEL  <span class="fa fa-file-excel-o"></span></a>
        <a href="{{url('Tesoreria/Distribucion-Fondos/Fondos-Pdf')}}"  class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Exportar PDF" target="_blank">PDF  <span class="fa fa-file-pdf-o"></span></a>
        
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
        <div class="col-sm-2 form-group-sm" style="float: right">
            {!! Form::select('mes',['Seleccione el Mes'],null,['id'=>'mes','class'=>'form-control']) !!} 
        </div>   
        <div class=" form-group-sm" style="float: right">           
            {!! Form::select('anio',$anios,null,['id'=>'anio','class'=>'form-control col-md-1']) !!} 
        </div>
    </div>
    <div class="box-body" id="contenidos-box">
        @include('Tesoreria.listaDistribucion')
    </div>
</div>
<section id="conten-modal"></section>
@endpermission
@permission('crear distribucion')
<div class="modal fade" id="modaldistribucion" role="dialog">
    <div class="modal-dialog modal-primary">
        <!-- Modal content-->
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">NUEVA DISTRIBUCION</h4>
            </div>
            <div class="modal-body col-md-12 form-group-sm">
                @include('mensajes.mensaje')
                {!! Form::open(['id'=>'formfondosdistri']) !!}                
                <div class="col-md-12">
                    <div class="col-sm-9">
                        {!! Form::label('texnicos','Extensionistas: ',['class'=>'control-label ']) !!}                    
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('fecha','Fecha:',['class' => 'control-label'])!!}                    
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-sm-9">
                        {!! Form::select ('tecnico',$tecnicos,null,['id'=>'tecnico','required','placeholder'=>'selecciona un Extensionista']) !!} 
                        <div class="text-danger" id="error_tecnico"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::text('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'mes/dia/año'])!!}
                        <div class="text-danger" id="error_fecha"></div>
                    </div>
                </div>  
                
                <div class="col-md-12">
                    <div class="col-sm-9">
                        {!! Form::label('sucursal','Centro de Acopio:',['class' => 'control-label'])!!}                    
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('monto','Monto:',['class' => 'control-label'])!!}                  
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-sm-9">
                        {!! Form::select('sucursal',[],null,['id'=>'sucursal','placeholder'=>'selecciona un Centro de Acopio']) !!}
                        <div class="text-danger" id="error_sucursal"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::text('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00'])!!}
                        <div class="text-danger" id="error_monto"></div>
                    </div>
                </div>                                                                                                                                                 
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <a class="btn btn-dropbox" href="{{url('Tesoreria/Distribucion/Recibodistribucion')}}" target="_blank">Imprimir</a>                
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegDistribucion', 'class'=>'btn btn-dropbox'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>

    </div>
</div>
@endpermission
@stop

@section('script')
<script>
//  $("#tabledistribucion").tablesorter();
  
  $(document).ready(function (){
      $("#menutesoreria").addClass('active');
      $("#subdistribucion").addClass('active');
      activarForm(9);
  });
  $("#anio").change(function(event){      
      meses(event.target.value);
      activarForm(9);
  });
  $("#mes").change(function(event){
      activarForm(9);
  });
  $("#buscar").keyup(function(event){
      activarForm(9);
  });
  
  $(document).on('click','.pagination li a',function(e){
     e.preventDefault();
     var url = $(this).attr('href');     
     $.ajax({
        type:'get',
        url:url,
        success:function(data){
            $("#contenidos-box").empty().html(data);
        }
     });
  });
  
$("#fecha").datepicker({
        autoclose: true,
        language: "es"
    });   
    
$("#sucursal").select2({
    alloClear:true
});

$("#tecnico").select2({
    alloClear:true,    
});

$("#tecnico").change(function(event){
    var route = "{{url('Tesoreria/Distribucion-Fondos')}}/" + event.target.value;
    console.log(route);
    $.getJSON(route,function(data){
//        var cad="placeholder='seleccione un centro de acopio'";$("#sucursal").html(cad);
        $("#sucursal").empty();
        $("#sucursal").append("<option value=''>selecciona un Centro de Acopio</option>"); 
        $.each(data,function( index, value ){           
           $("#sucursal").append("<option value='"+index+"'>"+value+"</option>");           
        });        
    });
});


</script>
@stop