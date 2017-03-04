@extends('socios.mastersocio')
@section('contentheader_title')
    DERPARTAMENTOS
@stop
@section('main-content')
<div class="box-body">
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">DEPARTAMENTOS</h3>
            </div>
            {!! Form::open(['id'=>'formdepartamento']) !!}
            <div class="box-body">
                <div id="msj-infodepartamento" class="alert alert-success" role='alert' style="display: none">
                    <strong id='succesdepartamento'></strong>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
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
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTA DE DEPARTAMENTOS</h3>
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
                                        <a href="#"  OnClick='btneditar({{$departamento->id}});' data-toggle='modal' data-target='#myModal'><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                        <a href="#" onclick="Eliminar('{{$departamento->id}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
                                    </td>                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
</div>          
            

@endsection

