@extends('Acopio.masteracopio')
@section('contentheader_title')
    COMPRA DE GRANOS
@stop
@section('main-content')

<div class="box box-solid box-primary">
    <div class="box-header">
        <a id="nuevacompra" data-toggle='modal' data-target='#modalcompra' class="btn btn-dropbox btn-sm m-t-10" ><span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="COMPRAR GRANO"> COMPRAR</span></a>        
    </div>
    <div class="box-body">
        <table class="table table-responsive" id="myTable" >
                        <thead>
                        <th>FECHA</th>
                        <th>CONDICION</th> 
                        <th>KG</th>                            
                        <th>COSTO</th>
                        <th>TOTAL</th>
                        <th>SOCIOS/NO SOCIOS</th>                        
                        <th>ALMACEN</th>
                        <th>USUARIO</th>
                        <th>ACCIONES</th>
                        </thead>
                        <tbody>
                            @foreach ($compras as $compra )
                            {{--*/ @$nombre = str_replace(' ','&nbsp;', $compra->socios_codigo) /*--}}
                            {{--*/ @$total = str_replace(' ','&nbsp;', round( ($compra->kilos*$compra->precio),2)) /*--}}
                            <tr>
                                <td>{{$compra->fecha }}</td>
                                <td>{{$compra->condicion }}</td>
                                <td>{{$compra->kilos }}</td>
                                <td>{{$compra->precio }}</td>
                                <td>{{$total}}</td>
                                <td>
                                    @if ( $compra->socios_codigo == '')
                                        {{$compra->npaterno}} {{$compra->nmaterno}} {{$compra->nnombres}}
                                    @else
                                        {{$compra->paterno}} {{$compra->materno}} {{$compra->nombre}}
                                    @endif
                                </td>                                
                                <td>{{$compra->sucursal }}</td>
                                <td>{{$compra->name }}</td>  
                                <td>
                                    <a class="btn btn-sm btn-success"><span class="glyphicon glyphicon-print" ></span></a>
                                    <a onclick="AnulCompra('{{$compra->id}}','{{$nombre}}')" class="btn btn-sm btn-danger" ><span data-toggle="tooltip" data-placement="top" title="Anular" class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>                            
                            @endforeach
                        </tbody>
                    </table>
    </div>
</div>


<div class="modal fade" id="modalcompra" role="dialog">
    <div class="modal-dialog modal-lg modal-primary">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">COMPRA DE GRANO DE CACAO</h4></center>
        </div>{!! Form::open(['id'=>'formcompras']) !!}
        <div class="modal-body form-group-sm">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
            <input type="hidden" id="id">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label class="radio">
                        <input type="radio" name="estado" value="NOSOCIO" id="estadon" onclick="desabilita()">NO SOCIO
                    </label>   
                    <label class="radio">
                        <input type="radio" name="estado" value="SOCIO" id="estados" checked="true" onclick="habilita()" > SOCIO
                    </label>
                </div>
                <div class="col-md-2">
                    {!! Form::label('codigo','Codigo Almacen:',['class' => 'control-label'])!!}                    
                    {!! Form::text('acopio',null,['id'=>'acopio','class'=>'form-control','placeholder'=>'Codigo Almacen','autofocus'])!!}
                    <div class="text-danger" id="error_acopio"></div>
                </div>
                <div class="col-md-4">
                    {!! Form::label('codigo','Centro de Acopio:',['class' => 'control-label'])!!}
                    {!! Form::text('sucursal',null,['id'=>'sucursal','class'=>'form-control','placeholder'=>'Centro de Acopio','disabled'])!!}                    
                </div>
                <div class="col-md-2">
                    {!! Form::label('codrecibo','Codigo Recibo:',['class' => 'control-label'])!!}                    
                    {!! Form::text('codrecibo',null,['id'=>'codrecibo','class'=>'form-control','placeholder'=>' R-CC'])!!}
                    <div class="text-danger" id="error_codrecibo"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('numero','N° Recibo:',['class' => 'control-label'])!!}                    
                    {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'N° de Recibo','style'=>"text-align: center;"])!!}
                    <div class="text-danger" id="error_numero" ></div>
                </div>
            </div>
            <div class="col-md-12" id="nosocio" style="display: none">
                <div class="col-md-2 ">
                    {!! Form::label('paterno','Paterno:',['class' => 'control-label'])!!}                    
                    {!! Form::text('paterno',null,['id'=>'paterno','class'=>'form-control autocomplete-suggestion','placeholder'=>'Apellido Paterno'])!!}
                    <div class="text-danger" id="error_paterno"></div>
                </div>
                <div class="col-md-2 ">
                    {!! Form::label('materno','Materno:',['class' => 'control-label'])!!}                    
                    {!! Form::text('materno',null,['id'=>'materno','class'=>'form-control autocomplete-suggestion','placeholder'=>'Apellido Materno'])!!}
                    <div class="text-danger" id="error_materno"></div>
                </div>
                <div class="col-md-3 ">
                    {!! Form::label('nombre','Nombres:',['class' => 'control-label'])!!}                    
                    {!! Form::text('nombres',null,['id'=>'nombres','class'=>'form-control autocomplete-suggestion','placeholder'=>'Nombre completo'])!!}
                    <div class="text-danger" id="error_nombres"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('codigo','D.N.I.:',['class' => 'control-label'])!!}                    
                    {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° D.N.I.','maxlength'=>8])!!}
                    <div class="text-danger" id="error_dni"></div>
                </div>
                <div class="col-md-3 ">
                    {!! Form::label('comite','Comite Local:',['class' => 'control-label'])!!}                                        
                    {!! Form::select('comite',$comite,null,['id'=>'comite','placeholder'=>'selecciona']) !!}
                    <div class="text-danger" id="error_comite"></div>
                </div>
            </div>
            <div class="col-md-12" id="sisocio">
                <div class="col-md-6 ">
                    {!! Form::label('socio','Socio:',['class' => 'control-label'])!!}                    
                    {!! Form::text('socio',null,['id'=>'socio','class'=>'form-control autocomplete-suggestion','placeholder'=>'Apellido y Nombre del Socio'])!!}
                    <div class="text-danger" id="error_socio"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('codigo','Codigo Socio:',['class' => 'control-label'])!!}                    
                    {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'Codigo Socio'])!!}
                    <div class="text-danger" id="error_codigo"></div>
                </div>
                <div class="col-md-4 ">
                    {!! Form::label('comite','Comite Local:',['class' => 'control-label'])!!}                    
                    {!! Form::text('local',null,['id'=>'local','class'=>'form-control','placeholder'=>'Comite Local','disabled'])!!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-5">
                    {!! Form::label('condicio','Condicio:',['class' => 'control-label'])!!}                    
                    {!! Form::select('condicion',$condicions,null,['id'=>'condicion','class'=>'form-control','placeholder'=>'Seleccione una Condicion'])!!}
                    <div class="text-danger" id="error_condicion"></div>
                </div>
                <div class="col-md-2 ">
                    {!! Form::label('kg','Kilos:',['class' => 'control-label'])!!}                    
                    {!! Form::text('kilos',null,['id'=>'kilos','class'=>'form-control','placeholder'=>'0 Kg'])!!}
                    <div class="text-danger" id="error_kilos"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('precio','precio:',['class' => 'control-label'])!!}                    
                    {!! Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'S/. 0.00'])!!}
                    <div class="text-danger" id="error_precio"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('total','Total a Pagar:',['class' => 'control-label'])!!}                    
                    {!! Form::text('total',null,['id'=>'total','class'=>'form-control','placeholder'=>'S/. 0.00','disabled','style'=>"text-align: center"])!!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    {!! Form::label('observacion','Observaciones:',['class' => 'control-label'])!!}                    
                    {!! Form::textarea('observacion',null,['id'=>'observacion','class'=>'form-control','placeholder'=>'Descripcion','rows'=>'2'])!!}
                </div>
                <div class="col-md-2 ">
                    {!! Form::label('tipo','Tipo de CACAO:',['class' => 'control-label'])!!}
                    <label class="radio col-md-offset-1">
                        <input type="radio" name="tipo" value="GRADO I" id="tipo" checked="true"> GRADO I
                    </label>   
                    <label class="radio col-md-offset-1">
                        <input type="radio" name="tipo" value="GRADO II" id="tipo">GRADO II
                    </label>
                </div>
                <div class="col-md-2">
                    {!! Form::label('fecha','Fecha de Compra:',['class' => 'control-label'])!!}                    
                    {!! Form::text('fecha',date('m/d/Y'),['id'=>'fecha','class'=>'form-control','placeholder'=>'mes/dia/año'])!!}
                    <div class="text-danger" id="error_fecha"></div>
                </div>                             
            </div>
        </div> {!! Form::close() !!} 
        <div class="modal-footer">
            <div class="col-md-12">
             {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCompras', 'class'=>'btn btn-dropbox'])!!}
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('script')
<script>   
    
    $("#comite").select2({
    alloClear:true
});
   var habilita = function()
   {
       $("#sisocio").show();
       $("#nosocio").hide();
       $("#paterno").val('');$("#materno").val('');$("#nombres").val('');$("#dni").val('');
   };
   var desabilita = function()
   {
       $("#nosocio").show();
       $("#sisocio").hide();
       
       $("#socio").val('');               
       $("#codigo").val('');
       $("#comite").val('');
   }; 
    
    $("#dni").autocomplete({
        minLength:1,
         autoFocus:true,
         delay:1,
         source: "{{url('nosocios')}}",
         select: function(event,ui){
             $("#paterno").val(ui.item.id);
             $("#materno").val(ui.item.materno);
             $("#nombres").val(ui.item.nombres);
         }
    });
   
      $("#acopio").autocomplete({
         minLength:1,
         autoFocus:true,
         delay:1,
         source: "{{url('RRHH/Sucursalsearch')}}",
         select: function(event,ui){
             $("#acopio").val(ui.item.value);
             $("#sucursal").val(ui.item.sucursal);
         }
      });
      
      $("#codrecibo").autocomplete({
       minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('codrecibos')}}",
           select: function(event, ui){                                             
//               $("#numero").val(ui.item.value);
               numerorecibo(ui.item.value);
           }
   });
   
   var numerorecibo = function(idrecibo){
       var route = "{{url('codrecibos')}}/"+idrecibo;       
       $.getJSON(route,function(data){           
           $("#numero").val(data);
       })
   }
   
   $("#codigo").autocomplete({
       minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('socios/codigo')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.id);               
               $("#codigo").val(ui.item.value);
               $("#local").val(ui.item.local);
           }
   });
   
   
//   
   $(function(){              
        $("#socio").autocomplete({     
          minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('socios/search')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.value);               
               $("#codigo").val(ui.item.id);
               $("#local").val(ui.item.local);
               
           }
        });
   });
   
   $("#precio").keyup(function(){       
       if($("#kilos").val() != '')
       {                                
           var monto = $("#precio").val() * $("#kilos").val();   
           monto = parseFloat(monto).toFixed(2);
           $("#total").val('S/. '+  monto );
       }       
   });
   $("#kilos").keyup(function(){       
       if($("#precio").val() != '')
       {                                
           var monto = $("#precio").val() * $("#kilos").val();
           monto = parseFloat(monto).toFixed(2);
           $("#total").val('S/. '+  monto );
       }       
   });
      
$("#fecha").datepicker({
       autoclose: true,
        language: "es",        
   })
  
  
   
</script>

@stop