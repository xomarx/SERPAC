@extends('Acopio.masteracopio')
@section('contentheader_title')
    TARA O SACOS
@stop
@section('main-content')
<div class="col-md-6">
<div class="box box-primary box-solid">
    <div class="box-header">        
    </div>
    <div class="box-body">
        
            {!! Form::open(['id'=>'formcaja']) !!}
                <input type="hidden" name="idcaja" id="idcaja" />
                <input type="hidden" name="starttime" id="starttime" />
                    @include('mensajes.mensaje')
                    <div class="col-md-6">
                        {!! Form::label('nombre','Nombre: ',['class'=>'control-label'])!!}
                    {!! Form::text('saco',null,['id'=>'saco','class'=>'form-control','placeholder'=>'Nombre del saco'])!!}
                    <div class="text-red" id="error-monto"></div>
                    </div> 
                    <div class="col-md-6">
                        {!! Form::label('peso','Peso: ',['class'=>'control-label'])!!}
                    {!! Form::number('peso',null,['id'=>'peso','class'=>'form-control','placeholder'=>'Peso','min'=>'0.00','style'=>"text-align: center"])!!}
                    <div class="text-red" id="error-monto"></div>
                    </div> 
                    <div class="col-sm-12">
                        {!! Form::label('descripcion','Descripcion: ',['class'=>'control-label'])!!}
                    {!! Form::textarea('observacion',null,['id'=>'observacion','class'=>'form-control','placeholder'=>'Descripcion del saco','rows'=>'3'])!!}
                    <div class="text-red" id="error_descripcion"></div>
                    </div>
                    {!!Form::close()!!} 
        </div>
    <div class="box-footer">
        <a class="btn btn-dropbox">REGISTRAR</a>
    </div>
         </div>
    
</div>
<div class="col-md-6">
<div class="box box-primary box-solid ">
    <div class="box-header">        
    </div>
    <div class="box-body">
        
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="border-bottom-color: #0089db; ">SACO</th>
                        <th style="border-bottom-color: #0089db; ">DESCRIPCION</th>
                        <th style="border-bottom-color: #0089db; ">PESO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </div>
 </div>
    
</div>
   
@stop
@section('script')
<script>
    $(document).ready(function(){
        $("#menuacopio").addClass('active');
        $("#subregbasico").addClass('active');
        $("#subtara").addClass('active');
    });
    
</script>
@stop