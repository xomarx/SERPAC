@extends('Acopio.masteracopio')
@section('contentheader_title')
    RECEPCION DE FONDOS PARA ACOPIO
@stop
@section('main-content')
@permission('ver fondos')
<div class="box box-solid box-primary">
    <div class="box-header"> 
        <a href="{{ url('/Acopio/ExcelRecepcion') }}" id="excelMoney" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Exportar Excel" target="_blank">EXCEL  <span class="fa fa-file-excel-o"></span></a>
        <a href="{{ url('/Acopio/PdfRecepcion') }}" id="pdfMoney"  class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Exportar PDF" target="_blank">PDF  <span class="fa fa-file-pdf-o"></span></a>
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
        @include('Acopio.listaRecepcionFondos')
    </div>
</div>
<section id="conten-modal"></section>
@endpermission

@permission('crear fondos')

<div id="modal-form" class="modal fade" role="dialog">
  <div class="modal-dialog modal-primary modal-sm">
    <!-- Modal content-->
    <div class="modal-content" id="error-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RECEPCION DE FONDOS</h4>
      </div>
      <div class="modal-body">
          {!! Form::open(['id'=>'formrecepcionfondos']) !!}          
          <input type="hidden" id="id">
          <input type="hidden" id="valortemp">
          @include('mensajes.mensaje')
              {!! Form::label('monto','Monto:',['class' => 'control-label'])!!}                    
              {!! Form::text('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'Monto de Distribucion'])!!}
         
          
              {!! Form::label('motivo','Motivo de No Conformidd:',['class' => 'control-label'])!!}                    
              {!! Form::textarea('motivo',null,['id'=>'motivo','class'=>'form-control','placeholder'=>'Descripcion de la Recepcion de fondos','rows'=>'3'])!!}
                                                                                        
          {!! Form::close() !!}      
          
      </div>
      <div class="modal-footer">          
          {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegRecepcion', 'class'=>'btn btn-dropbox '])!!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
    </div>

  </div>
</div>
@endpermission
@stop

@section('script')
<script>
    $(document).ready(function(){
       $("#menuacopio").addClass('active');
       $("#subfondos").addClass('active');
       activarForm(8);
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
    
    $("#anio").change(function(event){          
      meses(event.target.value);
      activarForm(8);
  });
  $("#mes").change(function(event){
      activarForm(8);
  });
  $("#buscar").keyup(function(event){
      activarForm(8);
  });
    
        
</script>

@stop
