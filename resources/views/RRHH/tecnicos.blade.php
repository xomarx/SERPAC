@extends('RRHH.masterempleados')
@section('contentheader_title')
    EXTENSIONISTAS 
@stop
@section('main-content')

<div class="container spark-screen ">
    <div class="row">
        <div class="col-md-11 col-md-offset-0">
            <div class="panel panel-default panel-primary">                
                <div class="panel-heading">                                                            
                    <a id="nuevasucursal" data-toggle='modal' data-target='#tecnicosmodal' class="btn btn-primary btn-sm m-t-10" >NUEVO  <span class="glyphicon glyphicon-file"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal"></span></a>
                </div>
                <div class="panel-body">                                                             
                        <table class="table table-responsive" id="myTable" >
                            <thead>
                                <th>CODIGO</th>
                                 <th>DNI</th> 
                                <th>EMPLEADO</th>                            
                                <th>N° ZONAS</th>
                                <th>CARGO</th>
                                <th>AREA</th>                                                          
                                <th>ACCIONES</th>            
                            </thead>
                            <tbody>
                                @foreach($tecnicos as $tecnico)
                                {{--*/ @$name = str_replace(' ','&nbsp;', $tecnico->empleados_empleadoId) /*--}}
                                <tr>                                                                                
                                    <td>{{$tecnico->empleados_empleadoId}}</td>
                                    <td>{{$tecnico->personas_dni}}</td>
                                    <td>{{$tecnico->paterno}} {{$tecnico->materno}} {{$tecnico->nombre}}</td>
                                    <td></td>
                                    <td>{{$tecnico->cargo}}</td>
                                    <td>{{$tecnico->area}}</td>                                
                                    <td>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Ver"><span class="glyphicon glyphicon-eye-open"></span></a>                                        
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

<div id="tecnicosmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ASIGNACION DE ZONAS A LOS TECNICOS</h4>
      </div>
        <div class="modal-body">
            {!! Form::open(['id'=>'form']) !!}
            <div class="form-group-sm col-md-11" >   
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                {!! Form::label('tecnico','EXTENSIONISTAS',['class'=>'control-label']) !!}
                {!! Form::select('tecnico',$tecnics,null,['id'=>'tecnico','placeholder'=>'Seleccione un Extensionista !']) !!}
            </div>          
            {!! Form::label('tecnico','ZONAS LOCALES',['class'=>'control-label']) !!}
            {!! Form::select('tecnico',$locales,null,['id'=>'zonalocales','class'=>'form-control','multiple'=>'multiple']) !!}
            {!! Form::close() !!}
        </div>
      <div class="modal-footer">
          {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegTecnicos', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


@stop
@section('script')
<script>
    // ***********  TABLAS   ****************
    
var selLanguage = document.getElementById("zonalocales");
$(document).ready(function () {        
        $('#myTable').DataTable();
    });
  $("#tecnico").select2({      
        allowClear: true
  });
  
  var demo1 = $("#zonalocales").bootstrapDualListbox();        
</script>
@stop