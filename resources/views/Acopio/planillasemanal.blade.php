@extends('Acopio.masteracopio')
@section('contentheader_title')
    PLANILLA SEMANAL
@stop
@section('main-content')
@permission('ver semanal')
<div class="box box-primary box-solid">
    <div class="box-header">
        @permission(['crear semanal','ver semanal'])
        {!!link_to('#',$title='NUEVO', $attributes = ['id'=>'nuevaplanilla', 'class'=>'btn btn-dropbox'])!!} 
        @endpermission
        @permission('crear semanal')
        {!!link_to('#',$title='REGISTRAR', $attributes = ['id'=>'RegPlanilla', 'class'=>'btn btn-dropbox','style'=>"display: none;"])!!}
        @endpermission
        <button  class="btn btn-dropbox dropdown-toggle" type="button" data-toggle="dropdown" style="display: none;" id="btnexportar">EXPORTAR
            <span class="caret"></span></button>
            <ul class="dropdown-menu btn btn-github">
                <li class="btn-dropbox"><a href="{{ url('/Acopio/Excel') }}">Exportar a Excel</a></li>
                <li class="btn-dropbox"><a href="{{ url('/Acopio/Pdf') }}">Exportar a PDF</a></li>        
            </ul>
    </div>
    <div class="box-body" id="contenidos-box">
        @include('Acopio.listaPlanillasemanal')
    </div>
</div>
@endpermission

@stop

@section('script')

<script>
    
                                    
   var clickplanilla = function(){
       $("#tablaplanilla tbody").remove();       
       cargarplanilla($("#almacencod").val());
   }
   
   function cargarplanilla(sucursal)   {         
       var fields = $("#formsemanal").serialize();        
       var route = "{{url('Acopio/Planilla-Semanal')}}/"+sucursal;  
       var token = $("input[name=_token]").val();
       
       $.ajax({
        url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'PUT',
                datatype: 'json',                
                data: fields,
                success: function (data)
                {         
                    
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
                    bodytable += "<tr><td colspan='5' align='center' style='border-top: #000000 solid'><b>TOTAL</b></td><td style='border-top: #000000 solid' >"+totalkilos+ "</td><td style='border-top: #000000 solid'>"+totalprecios+ "</td><td style='border-top: #000000 solid'>"+totalgeneral+ "</td></tr>";                    
                    $("#tablaplanilla").append(bodytable);                                                    
                }                
    });      
   };
            
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
            activarForm(11);
      },
      error:function(data){
          if(data.status == 403) activarmodal(0);
      }   
      });          
    });
   };
   
   $(document).ready(function(){
      $("#menuacopio").addClass('active');
      $("#subplanillas").addClass('active');
      $("#subsemanal").addClass('active');
      activarForm(11);
   });
</script>

@stop