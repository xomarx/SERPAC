@extends('Acopio.masteracopio')
@section('contentheader_title')
    RECEPCION DE FONDOS DE ACOPIO
@stop
@section('main-content')
@permission('ver fondos')
<div class="box box-solid box-primary">
    <div class="box-header"> 
        <div class="col-sm-3">
            <button  class="btn btn-dropbox dropdown-toggle" type="button" data-toggle="dropdown" id="btnexportar">EXPORTAR
            <span class="caret"></span></button>
            <ul class="dropdown-menu btn btn-github">
                <li class="btn-dropbox"><a href="{{ url('/Acopio/ExcelRecepcion') }}">Exportar a Excel</a></li>
                <li class="btn-dropbox" ><a href="{{ url('/Acopio/PdfRecepcion') }}">Exportar a PDF</a></li>        
            </ul>
        </div>         
         <div class="col-sm-2" style="float: right">
            {!! Form::select('mes',$meses,null,['id'=>'mes','class'=>'form-control']) !!} 
        </div>   
        <div class="col-sm-2" style="float: right">           
            {!! Form::select('anio',$anios,null,['id'=>'anio','class'=>'form-control','placeholder'=>'Seleccione el Año']) !!} 
        </div>
                                              
    </div>
    <div class="box-body" id="contenidos-box">        
        @include('Acopio.listaRecepcionFondos')
    </div>
</div>
<section id="conten-modal"></section>
@endpermission

@permission('crear fondos')

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" id="error-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RECEPCION DE FONDOS</h4>
      </div>
      <div class="modal-body">
          {!! Form::open(['id'=>'form']) !!}
          
          <input type="hidden" id="id">
          <div class="col-md-3 form-group-sm">
              {!! Form::label('monto','Monto:',['class' => 'control-label'])!!}                    
              {!! Form::text('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'Departamento'])!!}
          </div>
          <div class="col-md-9">
              {!! Form::label('motivo','Motivo de No Conformidd:',['class' => 'control-label'])!!}                    
              {!! Form::textarea('motivo',null,['id'=>'motivo','class'=>'form-control','placeholder'=>'Descripcion','rows'=>'3'])!!}
          </div>                                                                                
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
    });
    
    $("#anio").change(function (){
        activarForm(8);
    });
    $("#mes").change(function (){
        activarForm(8);
        
    });
</script>

@stop
