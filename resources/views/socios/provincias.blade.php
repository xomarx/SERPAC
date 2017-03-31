@extends('socios.mastersocio')
@section('contentheader_title')
    PROVINCIAS
@stop
@section('main-content')
<div class="box-body">
    @permission(['crear provincias','editar provincias'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">PROVINCIAS</h3>
            </div>
            {!! Form::open(['id'=>'formprovincia']) !!}
            <div class="box-body">                
                @include('mensajes.mensaje')
                <input type="hidden" id="idprovincia">                
                {!! Form::label('departamento','Departamento:',['class' => 'control-label col-xs-1'])!!}                             
                {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','placeholder'=>'Seleccione un departamento']) !!}
                <div class="text-danger" id="error_departamento"></div>
                {!! Form::label('provincia','Provincia:',['class' => 'control-label col-xs-1'])!!}
                {!! Form::text('provincia',null,['id'=>'provincia','class'=>'form-control','placeholder'=>'Provincia'])!!}
                <div class="text-danger" id="error_provincia"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10" id="nuevaprovincia">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegProvincia', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            </div>
            {!! Form::close() !!} 
        </div>
    </div>
    @endpermission
    @permission('ver provincias')
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="myTable" >
                    <thead>                                                            
                    <th>PROVINCIAS</th>
                    <th>DEPARTAMENTOS</th>
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($provincias as $provincia)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $provincia->provincia) /*--}}
                        <tr>                                            

                            <td>{{$provincia->provincia}}</td>
                            <td>{{$provincia->departamento}}</td>
                            <td>    
                                @permission('editar provincias')
                                <a href="#"  OnClick='EdProvincia({{$provincia->id}});' data-toggle='modal' data-target='#myModal' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                @endpermission
                                @permission('eliminar provincias')
                                <a href="#" onclick="EliProvincia('{{$provincia->id}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
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
</div>

<section id="conten-modal"></section>
@stop
