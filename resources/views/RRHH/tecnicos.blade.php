@extends('RRHH.masterempleados')
@section('contentheader_title')
    EXTENSIONISTAS 
@stop
@section('main-content')

<div class="box box-primary box-solid">
    <div class="box-header">
        <a id="nuevasucursal" data-toggle='modal' data-target='#tecnicosmodal' class="btn btn-primary btn-sm m-t-10" >NUEVO  <span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal"></span></a>
    </div>
    <div class="box-body">
        <table class="table table-responsive" id="myTable" >
            <thead>
            <th>CODIGO</th>
            <th>DNI</th> 
            <th>EMPLEADO</th>                            
            <th>N° SECTORES</th>
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
                    <td align="center">{{$tecnico->numzonas}}</td>
                    <td>{{$tecnico->cargo}}</td>
                    <td>{{$tecnico->area}}</td>                                
                    <td>
                        <a href="javascropt:void(0);" data-toggle="tooltip" data-placement="top"  class="btn-sm btn-success" title="Ver"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a href="{{url('Tesoreria/Distribucion/ReciboAcopio') }}" data-toggle="tooltip" data-placement="top"  class="btn-sm btn-primary" title="Ver"><span class="glyphicon glyphicon-print"></span></a>
                        <a href="javascropt:void(0);"  class="btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div id="tecnicosmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-primary">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ASIGNACION DE ZONAS A LOS TECNICOS</h4>
      </div>
        {!! Form::open(['id'=>'formtecnicos']) !!}
        <div class="modal-body">
            <div id="msj-infotecnicos" class="alert alert-success" role='alert' style="display: none">
                    <strong id='succestecnicos'></strong>
            </div>
            <div class="form-group col-lg-12" >   
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                {!! Form::label('tecnico','EXTENSIONISTAS',['class'=>'control-label']) !!}
                {!! Form::select('tecnico',$tecnics,null,['id'=>'tecnico','placeholder'=>'Seleccione un Extensionista !']) !!}
                <div class="text-danger" id="error_tecnico"></div>
            </div>    
            {!! Form::label('tecnico','ZONAS LOCALES',['class'=>'control-label col-lg-12']) !!}
                         
                <div class="col-lg-6">
                    <input type="text" id="buscarinicial" class="form-control" placeholder="buscar Sector" name="buscarinicial"/>                
                    <button id="inicial" type="button" class="btn btn-default glyphicon glyphicon-arrow-right col-lg-12"><span class="glyphicon glyphicon-arrow-right"> </span></button>
                    {!! Form::select('zona_inicial',$locales,null,['id'=>'zona_inicial','class'=>'form-control','multiple']) !!}
                </div>

                <div class="col-sm-6 form-group has-feedback">
                    <input type="text" id="buscarfinal" class="form-control" placeholder="buscar Sector" name="buscarfinal"/>                
                    <button id="final" type="button" class="btn btn-default glyphicon glyphicon-arrow-left col-lg-12"><span class="glyphicon glyphicon-arrow-left"> </span></button>
                    {!! Form::select('zona_final',[],null,['id'=>'zona_final','class'=>'form-control','multiple']) !!}
                </div>
            
        </div>
      <div class="modal-footer">
          {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegTecnicos', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        {!! Form::close() !!}
    </div>

  </div>
</div>


@stop
@section('script')
<script>
    
 $(document).ready(function () {   
     var route = "{{url('RRHH/Tecnicos/Tecnico-Local') }}";     
     $.getJSON(route,function(data){
         $.each(data.lista, function( index, value ){  
                  $("#zona_inicial ").find('option[value="'+ value.comites_locales_id +'"]').remove();
              });
     });
        
    }); 
    
  $("#tecnico").select2({      
        allowClear: true,        
  });
  
  $("#tecnico").change(function(){      
      var route = '{{ url("RRHH/Tecnicos") }}/'+$("#tecnico").val();
      $.get(route,function(data){                  
          if(data.success == 'true'){
              $("#zona_final").empty();var datos;
              $.each(data.sectores, function( index, value ){                   
                  datos += "<option value='" + value.comites_locales_id+"'>"+ value.comite_local+"</option>";
                  
//                  $("#zona_final").append("<option value='" + value.id+"'>"+ value.comite_local+"</option>");
//                  $("#zona_inicial ").find('option[value="'+ value.comites_locales_id +'"]').clone().appendTo("#zona_final");
//                  $("#zona_inicial ").find('option[value="'+ value.comites_locales_id +'"]').hide();                  
              });
              $("#zona_final").html(datos);
          }
      });
  });
    
    $("#zona_inicial").dblclick(function(event){
        $("#zona_inicial option:selected").clone().appendTo("#zona_final");
        $("#zona_inicial option:selected").remove();
    });
    
    $("#zona_final").dblclick(function(event){
        $("#zona_final option:selected").clone().appendTo("#zona_inicial");
        $("#zona_final option:selected").remove();
    });
    
    $("#inicial").click(function(event){
        $("#zona_inicial option").clone().appendTo("#zona_final");
        $("#zona_inicial option").remove();
    });
    
    $("#final").click(function(event){
        $("#zona_final option").clone().appendTo("#zona_inicial");
        $("#zona_final option").remove();        
    });
    
    $("#buscarinicial").keyup(function(event){        
        var texto = $(this).val();        
        if(!texto)
        {$("#zona_inicial option").show();}
        else{
            $("#zona_inicial option").hide();
            $("#zona_inicial ").find('option:contains("'+ texto.toUpperCase() +'")').show();
        }
    });
    
    $("#buscarfinal").keyup(function(event){        
        var texto = $(this).val();        
        if(!texto)
        {$("#zona_final option").show();}
        else{
            $("#zona_final option").hide();
            $("#zona_final ").find('option:contains("'+ texto.toUpperCase() +'")').show();
        }
    });
    
    
</script>
@stop