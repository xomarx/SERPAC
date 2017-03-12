@extends('Acopio.masteracopio')
@section('contentheader_title')
    PERSONAS JURIDICAS
@stop
@section('main-content')

<div class="box box-solid box-primary ">
    <div class="box-header" >
        <a id="nuevoperjuridica" data-toggle='modal' data-target='#nuevoregistro' class="btn btn-dropbox " >Nuevo <span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Persona Juridica"></span></a>    
    </div>
    <div class="box-body">        
    <table id="myTable" class="table table-hover">
        <thead>
        <th>RUC</th>
        <th>RAZON SOCIAL</th>
        <th>DIRECCION</th>
        <th>TELEFONO</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
            @foreach ($persona_juridicas as $persona_juridica )
            {{--*/ @$name = str_replace(' ','&nbsp;', $persona_juridica->razon_social) /*--}}
            <tr>
                <td>{{$persona_juridica->ruc }}</td>
                <td>{{$persona_juridica->razon_social }}</td>
                <td>{{$persona_juridica->direccion }}</td>
                <td>{{ $persona_juridica->telefono }}</td>
                <td>
                    <a href="javascript:void(0);" onclick="EditJuridico('{{$persona_juridica->id}}')" data-toggle='modal' data-target='#nuevoregistro' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Editar" ></span></a>                                    
                    <a href="#" onclick="AnulJuridico('{{$persona_juridica->id}}','{{$name}}')" class="btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>            
            @endforeach
        </tbody>
    </table>
        </div> 
</div>


<div class="modal fade" id="nuevoregistro" role="dialog">
    <div class="modal-dialog modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">NUEVO REGISTRO</h3>
            </div>
            {!! Form::open(['id'=>'formjuridico']) !!}
            <div class="modal-body  form-group-sm">        
                <div class="alert alert-success" style="display: none;" id="alert-juridico">
                    <strong id="info-juridica"></strong>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <imput type='hidden' name='id' id='idjuridica'>
                <div class="col-md-6">
                    {!! Form::label('ruc','RUC:',['class' => 'control-label'])!!}
                    {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'N° de RUC','maxlength'=>11])!!} 
                    <div class="text-danger" id="error_ruc"></div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('telefono','Telefono:',['class' => 'control-label'])!!}
                    {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'N° de Telefono','maxlength'=>9])!!} 
                    <div class="text-danger" id="error_telefono"></div>
                </div>     
                <div class="col-md-12">
                    {!! Form::label('razon','Razon Social:',['class' => 'control-label'])!!}
                    {!! Form::text('razon',null,['id'=>'razon','class'=>'form-control','placeholder'=>'Razon Social'])!!} 
                    <div class="text-danger" id="error_razon"></div>
                </div>                         
                    {!! Form::label('direccion','Direccion:',['class' => 'control-label'])!!}
                    {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion'])!!}   
                    <div class="text-danger" id="error_direccion"></div>
            </div>
            <div class="modal-footer">                
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegPersonaJuridica', 'class'=>'btn btn-dropbox'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop
