@extends('socios.mastersocio')
@section('contentheader_title')
    DISTRITOS
@stop
@section('main-content')
<div class="box-body">
    @permission(['editar distritos','crear distritos'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">DISTRITOS</h3>
            </div>
            {!! Form::open(['id'=>'formdistrito']) !!}
            <div class="box-body">
                @include('mensajes.mensaje')                
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
    @endpermission
    @permission('ver distritos')
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
                                @permission('editar distritos')
                                <a href="javascript:void(0);"  OnClick='EdDistrito({{$distrito->id}});' class="btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                                @endpermission
                                @permission('eliminar distritos')
                                <a href="javascript:void(0);" onclick="EliDistrito('{{$distrito->id}}','{{$name}}')" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>                                                            
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
 $("#departamento").change(function(event){     
     cargarprovincia(event.target.value,"provincia");     
 });
 
 $(document).ready(function(){
    $("#menusocios").addClass('active');
    $("#sububigeo").addClass('active');
    $("#subdistritos").addClass('active');
 });
</script>
@stop