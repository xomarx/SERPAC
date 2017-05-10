@extends('RRHH.masterempleados')
@section('contentheader_title')
    EMPRESAS
@stop
@section('main-content')
@permission(['crear empresas','editar empresas'])
<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header">            
        </div>
        <div class="box-body">
            {!!Form::open(['id'=>'formempresa'])!!}
            <input type="hidden" name="id" id="id" />
            @include('mensajes.mensaje')            
            <div class="col-md-12">
                {!!Form::label('empresa','Empresa: ',['class'=>'control-label'])!!}
                {!!Form::text('empresa',null,['class'=>'form-control','id'=>'empresa','placeholder'=>'Nombre de la Empresa'])!!}
                <div class="text-danger" id="error-empresa"></div>
            </div>
            <div class="col-md-4">
                {!!Form::label('ruc','RUC: ',['class'=>'control-label'])!!}
                {!!Form::text('ruc',null,['class'=>'form-control','id'=>'ruc','placeholder'=>'N° de RUC','maxlength'=>'11'])!!}
                <div class="text-danger" id="error-ruc"></div>
            </div>
            <div class="col-md-8">
                {!!Form::label('direccion','Direccion: ',['class'=>'control-label'])!!}
                {!!Form::text('direccion',null,['class'=>'form-control','id'=>'direccion','placeholder'=>'Direccion de la Empresa'])!!}
                <div class="text-danger" id="error-direccion"></div>
            </div>            
            {!!Form::close()!!}
        </div>
        <div class="box-footer">
            <a class="btn btn-dropbox" id="RegEmpresa">REGISTRAR</a>
        </div>
    </div>
</div>
@endpermission
@permission('ver empresas')
<div class="col-md-7">
    <div class="box box-primary">        
        <div class="box-body" id="contenidos-box">
            @include('RRHH.empresaList')
        </div>
    </div>
</div>
@endpermission

<section id="conten-modal"></section>

<!-- Modal -->
@endsection

@section('script')
<script>
 
 $(document).ready(function(e){    
    $("#subempresa").addClass('active');      
    $("#menuRRHH").addClass('active');
    activarForm(19);
 });
 
</script>
@stop
