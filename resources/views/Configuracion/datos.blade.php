@extends('Configuracion.masterconfiguracion')
@section('contentheader_title')
    IMPORTAR DATOS DE EXCEL
@stop
@section('main-content')
<div class="box box-primary" id="box-datos">
    <div class="box-header">
        CARGAR ARCHIVO DE DATOS (EXCEL)
    </div>
    <div class="box-body">  
        @include('mensajes.mensaje')
        {!!Form::open(['id'=>'formdatos'])!!}
            {!!Form::label('datos','Cargar solo archivos Excel (.xls,.xlsx)',['class'=>'control-label'])!!}
            {!! Form::file('excel', ['class' => 'form-control','accept'=>'.csv,.xls,.xlsx,.csv']) !!}
            <div class="text-danger" id="error-datos"></div>
        {!!Form::close()!!}
    </div>
    <div class="box-footer">
        <a class="btn btn-dropbox" id="btndatos">CARGAR DATOS</a>
    </div>
    <div id="cargar"></div>
</div>

@stop
@section('script')
<script>
    $(document).ready(function(){
        $("#subdatos").addClass('active');
        $("#menuconfiguracion").addClass('active');
    });
</script>


@stop
