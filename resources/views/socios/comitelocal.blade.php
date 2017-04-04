@extends('socios.mastersocio')
@section('contentheader_title')
    COMITES LOCALES
@stop
@section('main-content')
<div class="box-body">
    @permission(['crear local','editar local'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">COMITE LOCAL</h3>
            </div>
            {!! Form::open(['id'=>'formlocal']) !!}
            <div class="box-body">
                @include('mensajes.mensaje')                
                <input type="hidden" id="idlocal">  
                {!! Form::label('departamento','Departamento:',['class' => 'control-label'])!!}                             
                {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','placeholder'=>'selecciona']) !!}
                <div class="text-danger" id="error_departamento"></div>
                {!! Form::label('provincia','Provincia:',['class' => 'control-label '])!!}                             
                {!! Form::select ('provincia',[],null,['id'=>'provincia','class'=>'form-control','placeholder'=>'selecciona']) !!}
                <div class="text-danger" id="error_provincia"></div>
                {!! Form::label('distritos','Distrito:',['class' => 'control-label '])!!}  
                {!! Form::select ('distrito',[],null,['id'=>'distrito','class'=>'form-control','placeholder'=>'selecciona']) !!}
                <div class="text-danger" id="error_distrito"></div>
                {!! Form::label('comite_central','Comite Central:',['class' => 'control-label'])!!}  
                {!! Form::select ('comite_central',[],null,['id'=>'comite_central','class'=>'form-control','placeholder'=>'selecciona']) !!}
                <div class="text-danger" id="error_central"></div>
                {!! Form::label('comite_local','Comite Local:',['class' => 'control-label'])!!}
                {!! Form::text('comite_local',null,['id'=>'comite_local','class'=>'form-control','placeholder'=>'Provincia'])!!} 
                <div class="text-danger" id="error_local"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegLocal', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            </div>
            {!! Form::close() !!} 
        </div>
    </div>
    @endpermission
    @permission('ver local')
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTA DE COMITES LOCALES</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="myTable" >
                    <thead>                                                                                        
                    <th>COMITE LOCAL</th>
                    <th>COMITE CENTRAL</th>
                    <th>DISTRITOS</th>
                    <th>PROVINCIAS</th>
                    <th>DEPARTAMENTOS</th>
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($comites_locales as $comite_local)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $comite_local->comite_local ) /*--}}
                        <tr>                                                                                
                            <td>{{$comite_local->comite_local}}</td>
                            <td>{{$comite_local->comite_central}}</td>
                            <td>{{$comite_local->distrito}}</td>
                            <td>{{$comite_local->provincia}}</td>
                            <td>{{$comite_local->departamento}}</td>
                            <td>    
                                @permission('editar local')
                                    <a href="#"  OnClick='Edlocal({{$comite_local->id}});' data-toggle='modal' data-target='#myModal' class="btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                                @endpermission
                                @permission('eliminar local')
                                    <a href="#" onclick="EliLocal('{{$comite_local->id}}','{{$name}}')" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" ><span class="glyphicon glyphicon-remove"></span></a>
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
@stop

@section('script')
<script>

 $("#distrito").change(function(event){     
     cargarcomite_central(event.target.value,"comite_central");
 });
 
 
 $("#provincia").change(function(event){     
     cargardistrito(event.target.value,"distrito");
 });
// 
// 
 $("#departamento").change(function(event){     
     cargarprovincia(event.target.value,"provincia");
 });
    
    $(document).ready(function(){   
        $("#menusocios").addClass('active');
        $("#sububigeo").addClass('active');
        $("#sublocal").addClass('active');        
});
</script>

@stop

