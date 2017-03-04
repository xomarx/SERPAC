@extends('socios.mastersocio')
@section('contentheader_title')
    COMITES CENTRALES
@stop
@section('main-content')

<div class="container spark-screen">
    <div class="row">
        <div class="col-md-11 col-md-offset-0">
            <div class="panel panel-default">
                {!! Form::open(['id'=>'form']) !!}
                <div class="panel-heading">                                        
                    <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10">
                </div>
                <div class="panel-body"> 
                    <div class="col-md-4">  
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        <input type="hidden" id="id">  
                        {!! Form::label('departamento','Departamento:',['class' => 'control-label col-xs-1'])!!}                             
                        {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control']) !!}
                        
                        {!! Form::label('provincia','Provincia:',['class' => 'control-label col-xs-1'])!!}                             
                        {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provincia','class'=>'form-control']) !!}
                        {!! Form::label('distritos','Distrito:',['class' => 'control-label col-xs-1'])!!}  
                        {!! Form::select ('distrito',['placeholder'=>'selecciona'],null,['id'=>'distrito','class'=>'form-control']) !!}
                        
                        {!! Form::label('comite_central','Comite Central:',['class' => 'control-label col-xs-3'])!!}
                        {!! Form::text('comite_central',null,['id'=>'comite_central_1','class'=>'form-control','placeholder'=>'Provincia'])!!} 

                        {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCentral', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                        {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'ActCentral', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                    </div>
                    {!! Form::close() !!} 
                    <div class="col-md-8">
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
    </div>
</div>

@stop

@section('script')
<script>
// ***********  TABLAS   ****************
     $(document).ready(function () {        
        $('#myTable').DataTable();
    });
    
// **************  change  selct     


 $("#provincia").change(function(event){     
     var route = "/distritos/"+event.target.value + "";         
    $.get(route,function(response){          
        $("#distrito").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#distrito").append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
        }
    }); 
 });
// 

 $("#departamento").change(function(event){     
     var route = "/provincias/"+event.target.value + "";       
    $.get(route,function(response){        
        $("#provincia").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#provincia").append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
        }
    }); 
 });

    
</script>

@stop

