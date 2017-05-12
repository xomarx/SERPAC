@extends('RRHH.masterempleados')
@section('contentheader_title')
    ALMACENES DE ACOPIO
@stop
@section('main-content')
@permission('ver almacen')
<div class="box-body">
    <div class="box box-solid box-primary">
        <div class="box-header" >
            @permission('crear almacen')
            <a id="nuevasucursal" data-toggle='modal' data-target='#modalsucursal' class="btn btn-dropbox btn-sm m-t-10" style="float: left;">NUEVO ALMACEN <span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal"></span></a>               
            @endpermission
        </div>
        <div class="box-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table table-responsive" id="myTable" >
                <thead>
                <th>AREA</th>
                <th>CODIGO</th> 
                <th>CENTRO DE ACOPIO</th>
                <th>ACOPIADOR</th>
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
                        <td>{{$sucursal->acopiador}}</td>
                        <td>{{$sucursal->telefono}}</td>
                        <td>{{$sucursal->comite_local}}</td>
                        <td>{{$sucursal->comite_central}}</td>
                        <td>{{$sucursal->distrito}}</td>
                        <td>{{$sucursal->provincia}}</td>
                        <td>
                            @permission('editar almacen')
                            <a onclick="Editsucur('{{$sucursal->sucursalId}}')" data-toggle='modal' data-target='#modalsucursal' class="btn-primary btn-xs"><span data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-pencil"></span></a>                                                        
                            @endpermission
                            @permission('eliminar almacen')
                            <a onclick="EliSucursal('{{$sucursal->sucursalId}}','{{$name}}')" class="btn-danger btn-xs"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
                            @endpermission
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<section id="conten-modal"></section>
@endpermission
@permission(['crear almacen','editar almacen'])
<div class="modal fade" id="modalsucursal" role="dialog">
    <div class="modal-dialog modal-primary">    
      <!-- Modal content-->
      <div class="modal-content" id="error-modal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">NUEVA SUCURSAL</h4>
        </div>
          <div class="modal-body col-md-12 form-group-sm">
              @include('mensajes.mensaje')
              {!! Form::open(['id'=>'formsucursal']) !!}
              
              <div class="col-md-12">
              <div class="col-md-6 " >
                  {!! Form::label('area','Area:',['class' => 'control-label'])!!}      
                  {!! Form::select('area',$areas,null,['id'=>'area','class'=>'form-control','placeholder'=>'Seleccione']) !!} 
                  <div class="text-danger" id="error_area"></div>
              </div>
              <div class="col-md-3 ">
                  {!! Form::label('telefono','Telefono:',['class' => 'control-label'])!!} 
                {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Telefono','maxlength'=>'9'])!!}
                <div class="text-danger" id="error_telefono"></div>
              </div>
              <div class="col-md-3 ">
                  {!! Form::label('fax','Fax:',['class' => 'control-label '])!!} 
                {!! Form::text('fax',null,['id'=>'fax','class'=>'form-control','placeholder'=>'N° Fax','maxlength'=>'9'])!!}
                <div class="text-danger" id="error_fax"></div>
              </div>
              </div>
              <div class="col-md-12">
              <div class="col-md-3 ">
                  {!! Form::label('codigo','Codigo:',['class' => 'control-label'])!!} 
                {!! Form::text('codigoId',null,['id'=>'codigoId','class'=>'form-control','placeholder'=>'Codigo de Almacen','maxlength'=>'9'])!!}
                <div class="text-danger" id="error_codigoId"></div>
              </div>
              <div class="col-md-5">
                  {!! Form::label('sucursal','Sucursal:',['class' => 'control-label'])!!} 
                {!! Form::text('sucursal',null,['id'=>'sucursal','class'=>'form-control','placeholder'=>'Nombre del Centro de Acopio'])!!}
                <div class="text-danger" id="error_sucursal"></div>
              </div>              
              <div class="col-sm-4">
                    {!! Form::label('departamento','Departamento:',['class' => 'control-label '])!!} 
                    {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','required','placeholder'=>'Seleccione']) !!}
                    <div class="text-danger" id="error_departamento"></div>
                </div>
              </div>
              <div class="col-md-12">
              <div class="col-sm-4">
                  {!! Form::label('provincia','Provincia:',['class' => 'control-label'])!!} 
                  {!! Form::select ('provincia',[],null,['id'=>'provincia','class'=>'form-control','required','placeholder'=>'Seleccione']) !!}
                  <div class="text-danger" id="error_provincia"></div>
              </div>              
                   <div class="col-sm-4">
                  {!! Form::label('distrito','Distrito: ',['class'=>'control-label']) !!}
                  {!! Form::select ('distrito',[],null,['id'=>'distrito','class'=>'form-control','required','placeholder'=>'Seleccione']) !!}
                  <div class="text-danger" id="error_distrito"></div>
              </div>
              <div class="col-sm-4">  
                  {!! Form::label('central','Comite Central: ',['class'=>'control-label']) !!}
                  {!! Form::select ('comite_central',[],null,['id'=>'comite_central','class'=>'form-control','required','placeholder'=>'Seleccione']) !!}
                  <div class="text-danger" id="error_central"></div>
              </div>  
              </div>
              <div class="col-md-12">
              <div class="col-sm-4">
                  {!! Form::label('local','Comite Local: ',['class'=>'control-label ']) !!}
                  {!! Form::select ('comite_local',[],null,['id'=>'comite_local','class'=>'form-control','required','placeholder'=>'Seleccione']) !!}
                  <div class="text-danger" id="error_local"></div>
              </div>     
              <div class="col-md-8">
                  {!! Form::label('direccion','Direccion:',['class' => 'control-label'])!!} 
                {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion '])!!}
                <div class="text-danger" id="error_direccion"></div>
              </div>
              </div>
              
              <div class="col-md-12">
                  <div class="col-sm-12">
                      {!! Form::label('acopiador','Acopiador:',['class' => 'control-label'])!!} 
                  </div>                  
                  <div class="col-sm-12">                      
                  {!! Form::select('acopiador',$empleados,null,['id'=>'acopiador','placeholder'=>'Seleccione un Acopiador !','style'=>'width:100%']) !!}
                  <div class="text-danger" id="error_acopiador"></div>
                  </div>                  
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
@endpermission
@stop

@section('script')
<script>
   
   $(document).ready(function (){
      $("#subalmacen").addClass('active');
    $("#menuRRHH").addClass('active');
   });

   
  $("#acopiador").select2({      
        allowClear: true,        
  });
   
  $("#comite_central").change(function(event){          
     cargarComitelocal(event.target.value,"comite_local");
 });
// 
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

</script>




@stop