@extends('Acopio.masteracopio')
@section('contentheader_title')
    TIPOS DE EGRESOS
@stop
@section('main-content')

<div class="container scene">
    <div class="row">
        <div class="col-md-11 col-md-offset-0">
            <div class="panel panel-default panel-primary">
                <div class="panel-heading">                                                            
                    <a id="nuevasucursal" data-toggle='modal' data-target='#modaltipoegreso' class="btn btn-primary btn-sm m-t-10" ><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="top" title="Nueva Sucursal">  NUEVO</span></a>
                </div>
                <table id="myTable" class="table table-hover">
                    <thead>
                    <th>CODIGO</th>
                    <th>TIPO EGRESO</th>
                    <th>DESCRIPCION</th>
                    <th>ACCIONES</th>
                    </thead>
                    <tbody>
                        @foreach ($tipoegresos as $tipoegreso)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $tipoegreso->tipo_egreso) /*--}}
                        <tr>
                            <td>{{$tipoegreso->id }}</td>
                            <td>{{ $tipoegreso->tipo_egreso}}</td>      
                            <td>{{$tipoegreso->descripcion }}</td>
                            <td>    
                                <a href="#" onclick="EdiTipoEgreso({{$tipoegreso->id }})" data-toggle='modal' data-target='#modaltipoegreso'><span data-toggle="tooltip" data-placement="top" title="Editar"  class="glyphicon glyphicon-pencil"></span></a>                                    
                                <a href="#" onclick="ElitipoEgreso('{{$tipoegreso->id}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
                            </td>
                        </tr>                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaltipoegreso" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">TIPOS DE EGRESOS</h4>
            </div>
            <div class="modal-body col-md-12 form-group">
                {!! Form::open(['id'=>'form']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <imput type='hidden' name='id' id='id'>

                <div class="col-xs-12 form-group">
                    {!! Form::label('tipo','Tipo de Egreso:',['class'=>'control-label']) !!}
                    {!! Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Tipo de Egreso'])!!}
                </div>
                <div class="col-md-12 form-group">
                    {!! Form::label('descripcion','Descripcion:',['class' => 'form-label'])!!} 
                    {!! Form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Descripcion del tipo de egreso','rows'=>'3'])!!}
                </div> 
                                                                                                                                
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">                
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegtipoEgreso', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@stop