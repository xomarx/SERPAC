@extends('Acopio.masteracopio')
@section('contentheader_title')
    COMPRA DE GRANOS
@stop
@section('main-content')
<div class="box box-header ">                
                                                                         
                <a id="nuevasucursal" data-toggle='modal' data-target='#modalcompra' class="btn btn-primary btn-sm m-t-10" ><span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="COMPRAR GRANO"> COMPRAR</span></a>                    
                <div class="box-body">                                                             
                    <table class="table table-responsive" id="myTable" >
                        <thead>
                        <th>FECHA</th>
                        <th>CONDICION</th> 
                        <th>KG</th>                            
                        <th>COSTO</th>
                        <th>TOTAL</th>
                        <th>CODIGO SOCIO</th>
                        <th>CODIGO ALMACEN</th>
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
                                <td>{{$compra->socios_codigo }}</td>
                                <td>{{$compra->sucursales_sucursalId }}</td>                                
                                <td>
                                    <a class="btn btn-danger"><span class="glyphicon glyphicon-eye-open" ></span></a>
                                    <a href="#" onclick="AnulCompra('{{$compra->id}}','{{$nombre}}')" ><span data-toggle="tooltip" data-placement="top" title="Anular" class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>

                </div>        
</div>

<div class="modal fade" id="modalcompra" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title bg-blue"><center> COMPRA DE GRANO</center></h4>
        </div>
          <div class="modal-body col-md-offset-0">

              {!! Form::open(['id'=>'form']) !!}
              <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
              <input type="hidden" id="id">
              <div class="col-md-3 form-group">
                  <label class="radio-inline">
                      <input type="radio" name="estado" value="NO SOCIO" id="estado" onclick="desabilita()">NO SOCIO
                  </label>   
                  <label class="radio-inline">
                      <input type="radio" name="estado" value="SOCIO" id="estado" checked="true" onclick="habilita()" > SOCIO
                  </label>
              </div>
              <div class="col-lg-2 form-group">
                  {!! Form::label('codigo','Codigo Almacen:',['class' => 'control-label'])!!}                    
                  {!! Form::text('acopio',null,['id'=>'acopio','class'=>'form-control','placeholder'=>'Codigo Almacen','autofocus'])!!}
              </div>
              <div class="col-lg-5 form-group">
                  {!! Form::label('codigo','Centro de Acopio:',['class' => 'control-label'])!!}                    
                  {!! Form::text('sucursal',null,['id'=>'sucursal','class'=>'form-control','placeholder'=>'Centro de Acopio','disabled'])!!}
              </div>
              <div class="col-lg-2 form-group">
                  {!! Form::label('numero','N° Recibo:',['class' => 'control-label'])!!}                    
                  {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'N° de Recibo'])!!}
              </div>
              
              <div class="col-lg-6 form-group">
                  {!! Form::label('socio','Socio:',['class' => 'control-label'])!!}                    
                  {!! Form::text('socio',null,['id'=>'socio','class'=>'form-control autocomplete-suggestion','placeholder'=>'Apellido y Nombre del Socio'])!!}
              </div>
              <div class="col-lg-2 form-group">
                  {!! Form::label('codigo','Codigo Socio:',['class' => 'control-label'])!!}                    
                  {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'Codigo Socio'])!!}
              </div>
              <div class="col-lg-4 form-group">
                  {!! Form::label('comite','Comite Local:',['class' => 'control-label'])!!}                    
                  {!! Form::text('comite',null,['id'=>'comite','class'=>'form-control','placeholder'=>'Comite Local','disabled'])!!}
              </div>
              
              <div class="col-lg-5 form-group">
                  {!! Form::label('condicio','Condicio:',['class' => 'control-label'])!!}                    
                  {!! Form::select('condicion',$condicions,null,['id'=>'condicion','class'=>'form-control'])!!}
              </div>
              <div class="col-lg-2 form-group">
                  {!! Form::label('kg','Kilos:',['class' => 'control-label'])!!}                    
                  {!! Form::text('kilos',null,['id'=>'kilos','class'=>'form-control','placeholder'=>'0 Kg'])!!}
              </div>
              <div class="col-lg-2 form-group">
                  {!! Form::label('precio','precio:',['class' => 'control-label'])!!}                    
                  {!! Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'S/. 0.00'])!!}
              </div>
              <div class="col-lg-2 form-group">
                  {!! Form::label('total','Total a Pagar:',['class' => 'control-label'])!!}                    
                  {!! Form::text('total',null,['id'=>'total','class'=>'form-control','placeholder'=>'S/. 0.00','disabled','style'=>"text-align: center"])!!}
              </div>
              
              <div class="col-md-6">
                  {!! Form::label('observacion','Observaciones:',['class' => 'control-label'])!!}                    
                  {!! Form::textarea('observacion',null,['id'=>'observacion','class'=>'form-control','placeholder'=>'Descripcion','rows'=>'2'])!!}
              </div>
              <div class="col-md-2 form-group">
                  {!! Form::label('tipo','Tipo de CACAO:',['class' => 'control-label'])!!}
                  <label class="radio col-md-offset-1">
                      <input type="radio" name="tipo" value="GRADO I" id="tipo" checked="true"> GRADO I
                  </label>   
                  <label class="radio col-md-offset-1">
                     <input type="radio" name="tipo" value="GRADO II" id="tipo">GRADO II
                  </label>
              </div>
              <div class="col-lg-2 form-group">
                  {!! Form::label('fecha','Fecha de Compra:',['class' => 'control-label'])!!}                    
                  {!! Form::text('fecha',$fecha,['id'=>'fecha','class'=>'form-control','placeholder'=>'mes/dia/año'])!!}
              </div>                             
              {!! Form::close() !!} 
          </div>
        <div class="modal-footer">
            <div class="col-md-12">
             {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCompras', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('script')
<script>   
   var habilita = function()
   {
       $("#socio").prop('disabled',false);
       $("#codigo").prop('disabled',false);
   };
   var desabilita = function()
   {
       $("#socio").attr('disabled','disabled');
       $("#codigo").prop('disabled',true);
       $("#socio").val('');               
       $("#codigo").val('');
       $("#comite").val('');
   }   
   
   $(function(){
      $("#acopio").autocomplete({
         minLength:1,
         autoFocus:true,
         delay:10,
         source: "{{url('RRHH/Sucursalsearch')}}",
         select: function(event,ui){
             $("#acopio").val(ui.item.value);
             $("#sucursal").val(ui.item.sucursal);
         }
      });
   });
   
//   
   $(function(){              
        $("#socio").autocomplete({     
          minLength:2,           
           autoFocus:true,
           delay:10,
           source: "{{url('socios/search')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.value);               
               $("#codigo").val(ui.item.id);
               $("#comite").val(ui.item.local);
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
        language: "es"
   })
   
   
</script>

@stop