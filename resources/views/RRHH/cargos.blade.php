@extends('RRHH.masterempleados')
@section('contentheader_title')
    CARGOS DE EMPLEADOS
@stop
@section('main-content')

<div class="box box-solid box-primary">
    <div class="box-header">
        <a href="#" class="btn-sm btn-dropbox" data-toggle='modal' data-target='#myModal' id="nuevocargo">NUEVO <span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nuevo Cargo"></span></a>
    </div>
    <div class="box-body">
        <table class="table table-responsive" id="myTable" >
            <thead>                                                            
            <th>CODIGO</th> 
            <th>CARGO</th>                                                    
            <th>ACCIONES</th>            
            </thead>
            <tbody>
                @foreach($cargos as $cargo)
                {{--*/ @$name = str_replace(' ','&nbsp;', $cargo->cargo) /*--}}
                <tr>                                            
                    <td>{{$cargo->id}}</td>
                    <td>{{$cargo->cargo}}</td>                                                        
                    <td>                                          
                        <a href="#"  OnClick='EdiCargo({{$cargo->id}});' data-toggle='modal' data-target='#myModal' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                        <a href="#" onclick="EliCArgo('{{$cargo->id}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm modal-primary">
        <div class="modal-content ">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">REGISTRAR DATO</h4>
            </div>
            {!! Form::open(['id'=>'form']) !!}
            <div class="modal-body">
                {!! Form::label('cargo','Cargo:',['class' => 'control-label col-xs-1'])!!}                    
                {!! Form::text('cargo',null,['id'=>'cargo','class'=>'form-control','placeholder'=>'Nombre del Cargo'])!!}                                                                            
            </div>
            {!! Form::close() !!} 
            <div class="modal-footer">                
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCargo', 'class'=>'btn btn-primary btn-sm m-t-10'])!!} 
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
