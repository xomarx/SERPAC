@extends('RRHH.masterempleados')
@section('contentheader_title')
    AREAS
@stop
@section('main-content')

<div class="box box-solid box-primary">
    <div class="box-header">
        <a id="nuevaarea" href="#"  data-toggle='modal' data-target='#myModal' class="btn-sm btn-dropbox">NUEVO <span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="top" title="Editar"></span></a>
    </div>
    <div class="box-body">
        <table class="table table-responsive" id="myTable" >
            <thead>                                                            
            <th>CODIGO</th> 
            <th>AREAS</th>                                                    
            <th>ACCIONES</th>            
            </thead>
            <tbody>
                @foreach($areas as $area)
                {{--*/ @$name = str_replace(' ','&nbsp;', $area->area) /*--}}
                <tr>                                            
                    <td>{{$area->id}}</td>
                    <td>{{$area->area}}</td>                                                        
                    <td>                                          
                        <a href="#"  OnClick='EdiArea({{$area->id}});' data-toggle='modal' data-target='#myModal' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                        <a href="#" onclick="EliArea('{{$area->id}}','{{$name}}')"  class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">REGISTRAR AREA</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['id'=>'formArea']) !!}   
                <input type="hidden" name="idarea" id="idarea" />
                {!! Form::label('area','Area:',['class' => 'control-label col-xs-1'])!!}                    
                {!! Form::text('area',null,['id'=>'area_1','class'=>'form-control','placeholder'=>'Nombre del Area'])!!}                                        
                {!! Form::close() !!} 
            </div>
            <div class="modal-footer">                
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegArea', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>


@endsection
