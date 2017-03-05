@extends('socios.mastersocio')
@section('contentheader_title')
    COMITES CENTRALES
@stop
@section('main-content')

<div class="box-body">
    <div class="col-md-4">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">COMITE CENTRAL</h3>
            </div>
            {!! Form::open(['id'=>'formcomite_central']) !!}
            <div class="box-body">
                <div id="msj-infocentral" class="alert alert-success" role='alert' style="display: none">
                    <strong id='succescentral'></strong>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="idcentral">  
                {!! Form::label('departamento','Departamento:',['class' => 'control-label'])!!}                             
                {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','placeholder'=>'selecciona']) !!}
                <div class="text-danger" id="error_departamento"></div>
                {!! Form::label('provincia','Provincia:',['class' => 'control-label'])!!}                             
                {!! Form::select ('provincia',[],null,['id'=>'provincia','class'=>'form-control','placeholder'=>'selecciona']) !!}
                <div class="text-danger" id="error_provincia"></div>
                {!! Form::label('distritos','Distrito:',['class' => 'control-label'])!!}  
                {!! Form::select ('distrito',[],null,['id'=>'distrito','class'=>'form-control','placeholder'=>'selecciona']) !!}
                <div class="text-danger" id="error_distrito"></div>
                {!! Form::label('comite_central','Comite Central:',['class' => 'control-label'])!!}
                {!! Form::text('comite_central',null,['id'=>'comite_central','class'=>'form-control','placeholder'=>'Provincia'])!!}
                <div class="text-danger" id="error_central"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCentral', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <h3 class="box-title">COMITE CENTRAL</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="myTable" >
                            <thead>                                                            
                            <th>CODIGO</th> 
                            <th>COMITES CENTRALES</th>
                            <th>DISTRITOS</th>
                            <th>PROVINCIAS</th>
                            <th>DEPARTAMENTOS</th>
                            <th>ACCIONES</th>            
                            </thead>
                            <tbody>
                                @foreach($comites_centrales as $comite_central)
                                {{--*/ @$name = str_replace(' ','&nbsp;', $comite_central->comite_central ) /*--}}
                                <tr>                                            
                                    <td>{{$comite_central->id}}</td>
                                    <td>{{$comite_central->comite_central}}</td>
                                    <td>{{$comite_central->distrito}}</td>
                                    <td>{{$comite_central->provincia}}</td>
                                    <td>{{$comite_central->departamento}}</td>
                                    <td>                                          
                                        <a href="#"  OnClick='Edcentral({{$comite_central->id}});'><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                        <a href="#" onclick="EliCentral('{{$comite_central->id}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
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

 $("#provincia").change(function(event){  
     cargardistrito(event.target.value,"distrito");     
 });

 $("#departamento").change(function(event){  
     cargarprovincia(event.target.value,"provincia")     
 });

    
</script>

@stop

