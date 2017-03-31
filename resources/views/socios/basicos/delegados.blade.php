@extends('socios.mastersocio')
@section('contentheader_title')
    CARGOS DELEGADOS
@stop
@section('main-content')
<div class="box-body">
    @permission(['crear delegados','editar delegados'])
    <div class="col-md-4" id="contenidos-box">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">DELEGADOS</h3>
            </div>
            {!! Form::open(['id'=>'formdelegados']) !!}
            <div class="box-body">
                @include('mensajes.mensaje')                
                <input type="hidden" id="iddelegado">
                {!! Form::label('delegados','CARGO DELEGAGO:',['class' => 'control-label'])!!}                    
                {!! Form::text('cargo_delegado',null,['id'=>'cargo_delegado','class'=>'form-control','placeholder'=>'Nombre del Cargo'])!!}  
                <div class="text-danger" id="error_delegado"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10" id="nuevodelegado">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegDelegado', 'class'=>'btn btn-primary btn-sm'])!!}
            </div>
            {!! Form::close() !!} 
        </div>
    </div>
    @endpermission
    @permission('ver delegados')
    <div class="col-md-8" >
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTA DE DELEGADOS</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="myTable" >
                    <thead>                                                            
                    <th>CODIGO</th> 
                    <th>CARGOS DELEGADOS</th>                                                    
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($delegados as $delegado)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $delegado->cargo_delegado ) /*--}}
                        <tr>                                            
                            <td>{{$delegado->id}}</td>
                            <td>{{$delegado->cargo_delegado}}</td>                                                        
                            <td>          
                                @permission('editar delegados')
                                <a href="#"  OnClick='EdDelegado({{$delegado->id}});' data-toggle='modal' data-target='#myModal' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                @endpermission
                                @permission('eliminar delegados')
                                <a href="#" onclick="EliDelegado('{{$delegado->id}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
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

@endsection

