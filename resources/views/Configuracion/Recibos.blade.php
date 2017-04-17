@extends('Configuracion.masterconfiguracion')
@section('contentheader_title')
    REGISTRO DE RECIBOS O DOCUMENTOS
@stop
@section('main-content')
<div class="box-body">
    @permission(['crear documentos','editar documentos'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">

            </div>            
            {!! Form::open(['id'=>'formrecibo']) !!}
            <div class="box-body">            
                @include('mensajes.mensaje')                
                {!! Form::label('codigo','Codigo del Recibo:',['class' => 'control-label'])!!}                    
                {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'R-DF','maxlength'=>4])!!}
                <div class="text-danger" id="error_codigo"></div>
                {!! Form::label('recibo','Recibo:',['class' => 'control-label'])!!}                    
                {!! Form::text('recibo',null,['id'=>'recibo','class'=>'form-control','placeholder'=>'Nombre del Recibo'])!!}
                <div class="text-danger" id="error_recibo"></div>
                {!! Form::label('enlace','Enlace:',['class' => 'control-label'])!!}                    
                {!! Form::text('enlace',null,['id'=>'enlace','class'=>'form-control','placeholder'=>'Enlace a un Modulo'])!!}
                <div class="text-danger" id="error-enlace"></div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="reset" value="Nuevo" id="nuevorecibo" class="btn btn-primary btn-sm m-t-10">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegRecibo', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}               
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @endpermission
    @permission('ver documentos')
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTA DE RECIBOS</h3>
            </div>
            <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <table class="table" id="myTable" >
                    <thead>                                                            
                    <th>CODIGO</th> 
                    <th>RECIBO</th>
                    <th>ENLACE</th>
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($recibos as $recibo)                        
                        <tr>                                            
                            <td>{{$recibo->codigo}}</td>
                            <td>{{$recibo->tipo_documento}}</td>
                            <td>{{$recibo->enlace}}</td>
                            <td>  
                                @permission('editar documentos')
                                <a href="javascript:void(0);" onclick="EditRecibo('{{$recibo->codigo}}')" class="btn-xs btn-primary"><span data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-pencil"></span></a>
                                @endpermission
                                @permission('eliminar documentos')
                                <a href="javascript:void(0);" onclick="EliRecibo('{{$recibo->codigo}}','{{$recibo->tipo_documento}}')" class="btn-xs btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
                                @endpermission
                            </td>                   
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>        
        </div>
    </div>
    @endpermission
    <section id="conten-modal"></section>
</div>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $("#subdocumento").addClass('active');
        $("#menuconfiguracion").addClass('active');
    });
</script>


@stop