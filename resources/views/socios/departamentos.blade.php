@extends('socios.mastersocio')
@section('contentheader_title')
    DERPARTAMENTOS
@stop
@section('main-content')
<div class="box-body">
    @permission(['crear departamentos','editar departamentos'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">DEPARTAMENTOS</h3>
            </div>
            {!! Form::open(['id'=>'formdepartamento']) !!}
            <div class="box-body">
                @include('mensajes.mensaje')
                <input type="hidden" id="iddepartamento">
                {!! Form::label('departamento','Departamento:',['class' => 'control-label col-xs-1'])!!}                    
                {!! Form::text('departamento',null,['id'=>'departamento','class'=>'form-control','placeholder'=>'Departamento'])!!}   
                <div class="text-danger" id="error_departamento"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10" id="nuevodepartamento">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'regdepartamento', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            </div>
            {!! Form::close() !!} 
        </div>
    </div>
    @endpermission
    @permission('ver departamentos')
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="myTable" >
                            <thead>                                                            
                            <th>CODIGO</th> 
                            <th>DEPARTAMENTOS</th>                                                    
                            <th>ACCIONES</th>            
                            </thead>
                            <tbody>
                                @foreach($departamentos as $departamento)
                                {{--*/ @$name = str_replace(' ','&nbsp;', $departamento->departamento) /*--}}
                                <tr>                                            
                                    <td>{{$departamento->id}}</td>
                                    <td>{{$departamento->departamento}}</td>                                                        
                                    <td>
                                        @permission('editar departamentos')
                                        <a href="#"  OnClick='btneditar({{$departamento->id}});' data-toggle='modal' data-target='#myModal' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                        @endpermission
                                        @permission('eliminar departamentos')
                                        <a href="#" onclick="Eliminar('{{$departamento->id}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
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

