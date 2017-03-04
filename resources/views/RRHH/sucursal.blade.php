@extends('RRHH.masterempleados')
@section('contentheader_title')
    CENTROS DE ACOPIOS
@stop
@section('main-content')

<div class="container spark-screen ">
    <div class="row">
        <div class="col-md-11 col-md-offset-0">
            <div class="panel panel-default panel-primary">                
                <div class="panel-heading">                                                            
                    <a id="nuevasucursal" data-toggle='modal' data-target='#modalsucursal' class="btn btn-primary btn-sm m-t-10" >NUEVO  <span class="glyphicon glyphicon-file"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal"></span></a>
                </div>
                <div class="panel-body">                                                             
                        <table class="table table-responsive" id="myTable" >
                            <thead>
                                <th>AREA</th>
                                 <th>CODIGO</th> 
                                <th>CENTRO DE ACOPIO</th>                            
                                <th>TELEFONO</th>
                                <th>COMITE LOCAL</th>
                                <th>COMITE CENTRAL</th>
                                <th>DISTRITO</th>
                                <th>PROVINCIA</th>                            
                                <th>ACCIONES</th>            
                            </thead>
                            <tbody>
                                @foreach($sucursales as $sucursal)
                                {{--*/ @$name = str_replace(' ','&nbsp;', $sucursal->sucursal) /*--}}
                                <tr>                                                                                
                                    <td>{{$sucursal->area}}</td>
                                    <td>{{$sucursal->sucursalId}}</td>
                                    <td>{{$sucursal->sucursal}}</td>
                                    <td>{{$sucursal->telefono}}</td>
                                    <td>{{$sucursal->comite_local}}</td>
                                    <td>{{$sucursal->comite_central}}</td>
                                    <td>{{$sucursal->distrito}}</td>
                                    <td>{{$sucursal->provincia}}</td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Ver" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a  onclick="Editsucur('{{$sucursal->sucursalId}}')" data-toggle='modal' data-target='#modalsucursal' ><span data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="#" onclick="EliSucursal('{{$sucursal->sucursalId}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
                                        <a href="#"  OnClick='btneditar({{$sucursal->sucursalId}});' data-toggle='modal' data-target='#myModal'><span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Acopiador"></span></a>                                        
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


<div class="modal fade" id="modalsucursal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">NUEVA SUCURSAL</h4>
        </div>
          <div class="modal-body col-md-12 form-group-sm">
              {!! Form::open(['id'=>'form']) !!}
              <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
              <div class="col-md-5 form-group-sm" >
                  {!! Form::label('area','Area:',['class' => 'control-label'])!!}      
                {!! Form::select('area',$areas,null,['id'=>'area','class'=>'form-control']) !!}  
              </div>
              <div class="col-md-3 form-group-sm">
                  {!! Form::label('telefono','Telefono:',['class' => 'control-label col-xs-1'])!!} 
                {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Telefono'])!!}
              </div>
              <div class="col-md-3 form-group-sm">
                  {!! Form::label('fax','Fax:',['class' => 'control-label col-xs-1'])!!} 
                {!! Form::text('fax',null,['id'=>'fax','class'=>'form-control','placeholder'=>'N° Fax'])!!}
              </div>
              
              <div class="col-md-3 form-group-sm">
                  {!! Form::label('codigo','Codigo:',['class' => 'control-label'])!!} 
                {!! Form::text('codigoId',null,['id'=>'codigoId','class'=>'form-control','placeholder'=>'Nombre del Centro de Acopio'])!!}
              </div>
              <div class="col-md-5 form-group-sm">
                  {!! Form::label('centro','Sucursal:',['class' => 'control-label col-xs-1'])!!} 
                {!! Form::text('sucursal',null,['id'=>'sucursal','class'=>'form-control','placeholder'=>'Nombre del Centro de Acopio'])!!}
              </div>              
              <div class="col-xs-4 form-group-sm">
                    {!! Form::label('departamento','Departamento:',['class' => 'control-label '])!!} 
                    {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','required']) !!}
                </div>
              
              <div class="col-xs-4 form-group-sm">
                  {!! Form::label('provincia','Provincia:',['class' => 'control-label'])!!} 
                  {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provincia','class'=>'form-control','required']) !!}
              </div>              
                   <div class="col-xs-4 form-group-sm">
                  {!! Form::label('distrito','Dsto.: ',['class'=>'control-label']) !!}
                  {!! Form::select ('distrito',['placeholder'=>'selecciona'],null,['id'=>'distrito','class'=>'form-control','required']) !!}
              </div>
              <div class="col-xs-4 form-group-sm">  
                  {!! Form::label('central','Com. Central: ',['class'=>'control-label']) !!}
                  {!! Form::select ('comite_central',['placeholder'=>'selecciona'],null,['id'=>'comite_central','class'=>'form-control','required']) !!}
              </div>  
              
              <div class="col-xs-4 form-group-sm">
                  {!! Form::label('local','Com. Local: ',['class'=>'control-label ']) !!}
                  {!! Form::select ('comite_local',['placeholder'=>'selecciona'],null,['id'=>'comite_local','class'=>'form-control','required']) !!}
              </div>     
              <div class="col-md-8 form-group-sm">
                  {!! Form::label('direccion','Direccion:',['class' => 'control-label'])!!} 
                {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion '])!!}
              </div>
              {!! Form::close() !!}
          </div>
            <div class="modal-footer">
            {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegSucursal', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
@stop

@section('script')
<script>
 
 $("#nuevasucursal").click(function(event){     
     $("#RegSucursal").text('Registrar');     
 });
   
  $("#comite_central").change(function(event){          
     var route = "{{url('comite_locales')}}/"+event.target.value + "";        
    $.get(route,function(response){        
        $("#comite_local").empty();
        $("#comite_local").append("<option value='"+"'>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#comite_local").append("<option value='" + response[i].id+"'>"+response[i].comite_local+"</option>");
        }
    }); 
 });
// 
 $("#distrito").change(function(event){     
     var route = "/comites_centrales/"+event.target.value + "";   
     
    $.get(route,function(response){           
        $("#comite_central").empty();
        $("#comite_central").append("<option value='"+"'>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#comite_central").append("<option value='" + response[i].id+"'>"+response[i].comite_central+"</option>");
        }
    }); 
 });
 
 
 $("#provincia").change(function(event){     
     var route = "/distritos/"+event.target.value + "";         
    $.get(route,function(response){          
        $("#distrito").empty();
        $("#distrito").append("<option value='"+"'>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#distrito").append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
        }
    }); 
 });
// 
// 
 $("#departamento").change(function(event){     
     var route = "/provincias/"+event.target.value + "";       
    $.get(route,function(response){        
        $("#provincia").empty();
        $("#provincia").append("<option value='"+"'>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#provincia").append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
        }
    }); 
 });

// ***********  TABLAS   ****************
     $(document).ready(function () {        
        $('#myTable').DataTable();
    });
  
</script>




@stop