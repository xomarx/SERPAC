@extends('Acopio.masteracopio')
@section('contentheader_title')
    PLANILLA SEMANAL
@stop
@section('main-content')

<div class="box box-primary box-solid">
    <div class="box-header">
        {!!link_to('#',$title='NUEVO', $attributes = ['id'=>'nuevaplanilla', 'class'=>'btn btn-dropbox'])!!} 
        {!!link_to('#',$title='REGISTRAR', $attributes = ['id'=>'RegPlanilla', 'class'=>'btn btn-dropbox','style'=>"display: none;"])!!}        
        <button  class="btn btn-dropbox dropdown-toggle" type="button" data-toggle="dropdown" style="display: none;" id="btnexportar">EXPORTAR
            <span class="caret"></span></button>
            <ul class="dropdown-menu btn btn-github">
                <li class="btn-dropbox"><a href="{{ url('/Acopio/Excel') }}">Exportar a Excel</a></li>
                <li class="btn-dropbox"><a href="{{ url('/Acopio/Pdf') }}">Exportar a PDF</a></li>        
            </ul>
    </div>
    <div class="box-body" id="bodyplanilla" >
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>N° PLANILLA</th>
                    <th>COD ALMACEN</th>
                    <th>ALMACEN</th>
                    <th>USUARIO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planillas as $planilla)
                <tr>
                    <td>{{$planilla->fecha}}</td>
                    <td>{{$planilla->numero}}</td>
                    <td>{{$planilla->sucursalId }}</td>
                    <td>{{$planilla->sucursal}}</td>
                    <td>{{$planilla->name}}</td>
                    <td>
                        <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Excel"><span class="fa fa-file-excel-o" ></span></a>
                        <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Pdf"><span class="fa fa-file-pdf-o" ></span></a>
                        <a class="btn btn-sm btn-danger" onclick="EliPlanilla('{{$planilla->id}}','{{$planilla->numero }}')" ><span data-toggle="tooltip" data-placement="top" title="Anular" class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="box box-body form-group" style="display: none;" id="boxplanilla">
    <button type="button" class="close" id="cerrarplanilla">&times;</button>
    {!! Form::open(['id'=>'formsemanal']) !!}
    <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
    <div class="col-md-3">
        <img src="{{ url('img/acopagro.png')}}" class="img-responsive" >
    </div>
    <div class="col-md-7">
        <h3><center>COOPERATIVA AGRARIA CACAOTERA ACOPAGRO Ltda</center></h3>
        <h4><center>PLANILLA DE ACOPIO Y BENEFICIO CENTRALIZADO DE CACAO</center></h4>
    </div>
    <div class="col-md-2 ">
        {!!Form::label('numero','N°',['class'=>'control-label'] )!!}
        {!! Form::text('planilla',null,['class'=>'forma-control','id'=>'planilla','placeholder'=>'N° de Planilla'])!!}
        <div class="text-danger" id="error-planilla"></div>
    </div>                
    
    <div class="col-md-5">
        {!!Form::label('almacen','Cod. Centro de Acopio' )!!}
        {!! Form::text('almacen',null,['class'=>'forma-control','id'=>'almacen','placeholder'=>'cod centro de acopio'])!!}
        <div class="text-danger" id="error-almacen"></div>
    </div>
    <div class="col-md-4">
        {!!Form::label('lote','N° de SubLote' )!!}
        {!! Form::text('lote',null,['class'=>'forma-control','id'=>'lote','placeholder'=>'N° Sub Lote'])!!}
        <div class="text-danger" id="error-lote"></div>
    </div>
    <div class="col-md-3" >
        {!!Form::label('fecha','Fecha' )!!}
        {!! Form::text('fecha',date('m/d/Y'),['class'=>'forma-control','id'=>'fecha','placeholder'=>'mes/dia/año'])!!}
        <div class="text-danger" id="error-fecha"></div>
    </div>
    <div class="col-md-12">
        @foreach ($condiciones as $condicion)
        <label class="radio-inline form-group" onclick="clickplanilla();">
                {!!  Form::radio('condicion',$condicion->id, null, ['class' => 'forma-control','id'=>'condicion','checked']) !!} {{$condicion->condicion }}</label>                
        @endforeach
    </div>
    <table border='1' class="table table-responsive table-hover" id="tablaplanilla" >
        <thead>
            <tr>
                <th>FECHA</th>
                <th>CODIGO SOCIO</th>
                <th>APELLIDOS Y NOMBRES</th>
                <th>GRADO I</th>
                <th>GRADO II</th>
                <th>KG.</th>
                <th>P.U. S/.</th>
                <th>TOTAL S/.</th>
                <th>FIRMA</th>
            </tr>            
        </thead>                
</table>
    <br>
    <div class="col-md-12">
        <div class="col-md-2">
            <hr style="background-color: black; height: 1px;  width: 100%;" />
            <center> {!!Form::label('firma','Firma del Acopiador' )!!}</center>
        </div>
        <div class="col-md-2" >
            <table style="border: black 1px solid; text-align: justify;  padding: 1px;">
                <td style="width: 70px; height: 70px;" >           
                </td>    
            </table>
        </div>

        <div class="col-sm-2" style="float: right;" >
            <table style="border: black 1px solid; text-align: justify;  padding: 1px;">
                <td style="width: 70px; height: 70px;" >           
                </td>    
            </table>
        </div>
        <div class="col-sm-3" style="float: right;">
            <hr style="background-color: black; height: 1px;  width: 100%;" />
            <center> {!!Form::label('firma','Firma Responsable Acopio' )!!}</center>
        </div>
    </div>

    <div class="col-sm-7">
        {!!Form::label('acopiador','Acopiador:',['class'=>'col-sm-2'] )!!}
        <b id="firmaacopiador"></b>        
    </div>

    <div class="col-sm-5"  >
        {!!Form::label('responsable','Responsable:',['class'=>'col-sm-4'] )!!}
        <b id="firmatecnico"></b>        
    </div>
    
    {!! Form::close() !!} 
</div>
@stop

@section('script')

<script>
      $("#nuevaplanilla").click(function(){
          $("#error-lote").html('');$("#error-planilla").html('');
                    $("#error-almacen").html('');$("#error-fecha").html('');
          actOdes();     
      });
      
      $("#cerrarplanilla").click(function(){
          actOdes();
      });
       
       var actOdes = function(){
         if($("#nuevaplanilla").text() == "NUEVO"){
            $("#boxplanilla").show();
            $("#bodyplanilla").hide();
            $("#nuevaplanilla").text("LISTA")
            $("#btnexportar").show();
            $("#RegPlanilla").show(); 
          }
          else{
            $("#boxplanilla").hide();
            $("#bodyplanilla").show();
            $("#nuevaplanilla").text("NUEVO")
            $("#btnexportar").hide();
            $("#RegPlanilla").hide(); 
          }  
       };
           
     $(function(){
      $("#almacen").autocomplete({
         minLength:1,
         autoFocus:true,
         delay:1,
         source: "{{url('RRHH/Sucursalsearch')}}",
         select: function(event,ui){ 
             $("#firmaacopiador").html(ui.item.acopiador);
             $("#firmatecnico").html(ui.item.tecnico);
            cargarplanilla(ui.item.value);              
         }
      });
   });
   
   $("#fecha").datepicker( {       
       autoclose: true,
        language: "es"        
    });
   
   var clickplanilla = function(){
       if(!$("#almacen").val()) $("#tablaplanilla tbody").remove();
       else cargarplanilla($("#almacen").val());
   }
   
   function cargarplanilla(sucursal)   {         
       var fields = $("#formsemanal").serialize();        
       var route = "{{url('Acopio/Planilla-Semanal')}}/"+sucursal;  
       var token = $("#token").val();
       $.ajax({
        url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'PUT',
                datatype: 'json',                
                data: fields,
                success: function (data)
                {
                    console.log(data);
                    $("#tablaplanilla tbody").remove();
                    var totalkilos=0;
                    var totalprecios=0;
                    var totalgeneral=0; var bodytable ="<tr>";
                    $.each( data , function( index , value){                        
                        bodytable += "<td>"+value.fecha +"</td>";
                        bodytable += "<td>"+value.socios_codigo +"</td>";
                        if(value.socios_codigo == '') bodytable += "<td>"+value.npaterno+" "+value.nmaterno+" "+value.nnombres+ "</td>";
                        else bodytable += "<td>"+value.paterno+" "+value.materno+" "+value.nombre+ "</td>";
                        if(value.tipocacao == 'GRADO I') bodytable += "<td>"+value.tipocacao +"</td><td></td>";
                        else bodytable += "<td></td><td>"+value.tipocacao +"</td>";
                        bodytable += "<td>"+value.kilos +"</td>";
                        bodytable += "<td>"+value.precio +"</td>";
                        bodytable += "<td>"+value.precio * value.kilos +"</td>";
                        bodytable += "<td><hr style='background-color: black; height: 1px;  width: 100%;' /></td>";
                        bodytable += "</tr>";
                        totalkilos +=parseFloat(value.kilos);
                        totalprecios +=parseFloat(value.precio);
                        totalgeneral +=parseFloat(value.precio * value.kilos);
                    });                                       
                    bodytable += "<tr><td colspan='5' align='center'><b>TOTAL</b></td><td>"+totalkilos+ "</td><td>"+totalprecios+ "</td><td>"+totalgeneral+ "</td></tr>";                    
                    $("#tablaplanilla").append(bodytable);                                                    
                }                
    });      
   };
   
   $("#RegPlanilla").click(function(){
        var fields = $("#formsemanal").serialize();        
       var route = "{{url('Acopio/Planilla-Semanal')}}";  
       var token = $("#token").val();
       $.ajax({
        url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                datatype: 'json',                
                data: fields,
                success: function (data)
                {
                    document.location.reload();
                },
                error: function(data){
                    $("#error-lote").html('');$("#error-planilla").html('');
                    $("#error-almacen").html('');$("#error-fecha").html('');
                    var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'lote')$("#error-lote").html(value);
                            else if(index == 'planilla')$("#error-planilla").html(value);
                            else if(index == 'almacen')$("#error-almacen").html(value);
                            else if(index == 'fecha')$("#error-fecha").html(value);
                      });  
                    
                }
            });
    });
      
   var EliPlanilla = function(id,name){       
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar la planilla N° ?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Acopio/Planilla-Semanal/"+id+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)
        {           
            document.location.reload();
        }
      }
      });          
    });
   };
</script>

@stop