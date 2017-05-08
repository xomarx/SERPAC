@extends('RRHH.masterempleados')
@section('contentheader_title')
    EMPRESAS
@stop
@section('main-content')
<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header">            
        </div>
        <div class="box-body">
            {!!Form::open(['id'=>'formempresa'])!!}
            <div class="col-md-12">
                {!!Form::label('empresa','Empresa: ',['class'=>'control-label'])!!}
                {!!Form::text('empresa',null,['class'=>'form-control','id'=>'empresa'])!!}
            </div>
            <div class="col-md-4">
                {!!Form::label('ruc','RUC: ',['class'=>'control-label'])!!}
                {!!Form::text('ruc',null,['class'=>'form-control','id'=>'ruc'])!!}
            </div>
            <div class="col-md-8">
                {!!Form::label('direccion','Direccion: ',['class'=>'control-label'])!!}
                {!!Form::text('direccion',null,['class'=>'form-control','id'=>'Direccion'])!!}
            </div>            
            {!!Form::close()!!}
        </div>
        <div class="box-footer">
            <a class="btn btn-dropbox">REGISTRAR</a>
        </div>
    </div>
</div>

<div class="col-md-7">
    <div class="box box-primary">
        <div class="box box-header">        
        </div>
        <div class="box-body">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="border-bottom-color: #0089db; ">EMPRESA</th>
                        <th style="border-bottom-color: #0089db; ">RUC</th>
                        <th style="border-bottom-color: #0089db; ">DIRECCION</th>            
                        <th style="border-bottom-color: #0089db; ">ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<section id="conten-modal"></section>

<!-- Modal -->
@endsection

@section('script')
<script>
 
 $(document).ready(function(e){    
    $("#subempresa").addClass('active');      
    $("#menuRRHH").addClass('active');
 });
 
</script>
@stop
