@extends('socios.mastersocio')
@section('contentheader_title')
    CULTIVOS
@stop
@section('main-content')
<div class="box-body">
    @permission(['crear floras','editar floras'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">CULTIVOS</h3>
            </div>
            {!! Form::open(['id'=>'formflora']) !!}
            <div class="box-body">
                @include('mensajes.mensaje')
                <input type="hidden" id="idflora">  
                {!! Form::label('flora','Cultivo:',['class' => 'control-label col-xs-1'])!!}                    
                {!! Form::text('flora',null,['id'=>'flora','class'=>'form-control','placeholder'=>'Nombre de la Planta'])!!}
                <div class="text-danger" id="error_flora"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10" id="nuevaflora">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegFlora', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            </div>
            {!! Form::close() !!} 
        </div>
    </div>
    @endpermission
    @permission('ver floras')
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">CULTIVOS</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="myTable" >
                    <thead>                                                            
                    <th>CODIGO</th> 
                    <th>CULTIVOS</th>                                                    
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($floras as $flora)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $flora->flora) /*--}}
                        <tr>                                            
                            <td>{{$flora->id}}</td>
                            <td>{{$flora->flora}}</td>                                                        
                            <td>       
                                @permission('editar floras')
                                <a href="javascript:void(0);"  OnClick='EdFlora({{$flora->id}});' data-toggle='modal' data-target='#myModal' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                @endpermission
                                @permission('eliminar floras')
                                <a href="javascript:void(0);" onclick="EliFlora('{{$flora->id}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
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
@endsection
