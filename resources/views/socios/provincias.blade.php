@extends('socios.mastersocio')
@section('contentheader_title')
    PROVINCIAS
@stop
@section('main-content')
<div class="box-body">
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">PROVINCIAS</h3>
            </div>
            {!! Form::open(['id'=>'formprovincia']) !!}
            <div class="box-body">                
                <div id="msj-infoprovincia" class="alert alert-success" role='alert' style="display: none">
                    <strong id='succesprovincia'></strong>
                </div>
                <input  id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
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
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTA DE PROVINCIAS</h3>
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
                                <a href="#"  OnClick='EdProvincia({{$provincia->id}});' data-toggle='modal' data-target='#myModal'><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                <a href="#" onclick="EliProvincia('{{$provincia->id}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
                            </td>                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@stop
