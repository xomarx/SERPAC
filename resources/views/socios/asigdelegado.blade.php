@extends('socios.mastersocio')
@section('contentheader_title')
    ASIGNACION DE DELEGADOS
@stop
@section('main-content')

<div class="box box-primary box-solid" >
    <div class="box-header">
        <a class="btn btn-dropbox" data-toggle='modal'  data-target='#modal-form'>ASIGNAR DELEGADO</a>
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body" id="contenidos-box">
        @include('socios.asigDelegadoList')
    </div>
</div>

<section id="conten-modal">
    <div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">ASIGNACION DE DELAGADOS</h3>
            </div>
            <div class="modal-body form-horizontal">     
                {!! Form::open(['id'=>'formDinero']) !!}
                <input type="hidden" name="iddinero" id="iddinero" />
                    @include('mensajes.mensaje')
                                        
                    <div class="col-md-3">
                        {!! Form::label('dni','DNI: ',['class'=>'control-label'])!!}
                        {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'001-000000'])!!}
                        <div class="text-red" id="error-numero"></div>
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('datos','Apellidos y Nombres: ',['class'=>'control-label'])!!}
                        {!! Form::text('datos',null,['id'=>'datos','class'=>'form-control','placeholder'=>'dd/mm/yyyy'])!!}
                        <div class="text-red" id="error-fecha"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('estado','Estado: ',['class'=>'control-label'])!!}
                        {!! Form::text('estado',null,['id'=>'estado','class'=>'form-control','placeholder'=>'001-000000'])!!}
                        <div class="text-red" id="error-numero"></div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('inicio','Fecha Inicio: ',['class'=>'control-label'])!!}
                        {!! Form::date('inicio',null,['id'=>'inicio','class'=>'form-control','placeholder'=>'001-000000'])!!}
                        <div class="text-red" id="error-numero"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('final','Periodo (Mes): ',['class'=>'control-label'])!!}
                        {!! Form::number('final',null,['id'=>'final','class'=>'form-control','placeholder'=>'001-000000'])!!}
                        <div class="text-red" id="error-numero"></div>
                    </div>
                    <div class="col-md-5" style="padding-bottom: 10px">
                        {!! Form::label('cargo','Cargo: ',['class'=>'control-label'])!!}
                        {!! Form::text('cargo',null,['id'=>'cargo','class'=>'form-control','placeholder'=>'001-000000'])!!}
                        <div class="text-red" id="error-numero"></div>
                    </div>
                    
                    <div class="col-md-12">                        
                        <button type="button" class="btn btn-default" style="float: right" data-dismiss="modal">Salir</button>
                        <a  id="RegmovDoc" class="btn btn-dropbox" style="float: right">Registrar</a>
                    </div>
                    <div class="modal-footer ">
            </div>
                {!!Form::close()!!}
            </div>                                                      
        </div>
    </div>
</div>
</section>

@endsection

@section('script')
<script>
    
$(document).ready(function(){
    $("#subasigdelegados").addClass('active');
    $("#menusocios").addClass('active');
})
  
</script>
@stop

