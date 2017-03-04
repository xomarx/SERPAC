@extends('socios.mastersocio')
@section('contentheader_title')
    COMITES LOCALES
@stop
@section('main-content')
<div class="box-body">
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                
            </div>
            {!! Form::open(['id'=>'form']) !!}
            <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="idlocal">  
                {!! Form::label('departamento','Departamento:',['class' => 'control-label col-xs-1'])!!}                             
                {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control']) !!}

                {!! Form::label('provincia','Provincia:',['class' => 'control-label col-xs-1'])!!}                             
                {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provincia','class'=>'form-control']) !!}

                {!! Form::label('distritos','Distrito:',['class' => 'control-label col-xs-1'])!!}  
                {!! Form::select ('distrito',['placeholder'=>'selecciona'],null,['id'=>'distrito','class'=>'form-control']) !!}

                {!! Form::label('comite_central','Comite Central:',['class' => 'control-label col-xs-3'])!!}  
                {!! Form::select ('comite_central',['placeholder'=>'selecciona'],null,['id'=>'comite_central','class'=>'form-control']) !!}

                {!! Form::label('comite_local','Comite Local:',['class' => 'control-label col-xs-3'])!!}
                {!! Form::text('comite_local',null,['id'=>'comite_local_1','class'=>'form-control','placeholder'=>'Provincia'])!!} 

            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegLocal', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            </div>
            {!! Form::close() !!} 
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                
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
                                        <a href="#"  OnClick='Edlocal({{$comite_local->id}});' data-toggle='modal' data-target='#myModal'><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                        <a href="#" onclick="EliLocal('{{$comite_local->id}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
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
// ***********  TABLAS   ****************
     $(document).ready(function () {        
        $('#myTable').DataTable();
    });
 
 // ************** SELECT UBIGEO  
 
// 
 $("#distrito").change(function(event){     
     var route = "{{url('comites_centrales')}}/"+event.target.value + "";   
     
    $.get(route,function(response){           
        $("#comite_central").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#comite_central").append("<option value='" + response[i].id+"'>"+response[i].comite_central+"</option>");
        }
    }); 
 });
 
 
 $("#provincia").change(function(event){     
     var route = "{{ url('distritos')}}/"+event.target.value + "";         
    $.get(route,function(response){          
        $("#distrito").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#distrito").append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
        }
    }); 
 });
// 
// 
 $("#departamento").change(function(event){     
     var route = "{{ url('provincias')}}/"+event.target.value + "";       
    $.get(route,function(response){        
        $("#provincia").empty();
        for (var i = 0; i < response.length; i++) {            
            $("#provincia").append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
        }
    }); 
 });
    
</script>

@stop

