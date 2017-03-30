@extends('socios.mastersocio')
@section('contentheader_title')
    DISTRITOS
@stop
@section('main-content')
<div class="box-body">
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">DISTRITOS</h3>
            </div>
            {!! Form::open(['id'=>'formdistrito']) !!}
            <div class="box-body">
                <div id="msj-infodistrito" class="alert alert-success" role='alert' style="display: none">
                    <strong id='succesdistrito'></strong>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="iddistrito">
                {!! Form::label('departamento','Departamento:',['class' => 'control-label'])!!}                             
                {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','placeholder'=>'Seleccione un departamento']) !!}
                <div class="text-danger" id="error_departamento"></div>
                {!! Form::label('provincia','Provincia:',['class' => 'control-label'])!!}                             
                {!! Form::select ('provincia',[],null,['id'=>'provincia','class'=>'form-control','placeholder'=>'Seleccione']) !!}
                <div class="text-danger" id="error_provincia"></div>
                {!! Form::label('distrito','Distrito:',['class' => 'control-label'])!!}
                {!! Form::text('distrito',null,['id'=>'distrito','class'=>'form-control','placeholder'=>'Provincia'])!!} 
                <div class="text-danger" id="error_distrito"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10" id="nuevodistrito">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegDistrito', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTA DE DISTRITOS</h3>
            </div>        
            <div class="box-body">
                <table class="table table-hover" id="myTable" >
                    <thead>                                                                                       
                    <th>DISTRITOS</th>
                    <th>PROVINCIAS</th>
                    <th>DEPARTAMENTOS</th>
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($distritos as $distrito)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $distrito->distrito ) /*--}}
                        <tr>                                                                                
                            <td>{{$distrito->distrito}}</td>
                            <td>{{$distrito->provincia}}</td>
                            <td>{{$distrito->departamento}}</td>
                            <td>                                          
                                <a href="javascript:void(0);"  OnClick='EdDistrito({{$distrito->id}});' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                <a href="javascript:void(0);" onclick="EliDistrito('{{$distrito->id}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
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

@section('script')
<script>  
 $("#departamento").change(function(event){     
     cargarprovincia(event.target.value,"provincia");     
 });  
</script>
@stop