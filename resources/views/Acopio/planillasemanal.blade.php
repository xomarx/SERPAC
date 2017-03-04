@extends('Acopio.masteracopio')
@section('contentheader_title')
    PLANILLA SEMANAL
@stop
@section('main-content')
@include('Acopio.formExcel')
@stop

@section('script')

<script>
    var habilita = function()
    {
        
    }
    var deshabilita=function()
    {
        $("#rfa").prop('disabled',true);
        $("#utz").prop('disabled',true);
        $("#rfa").prop('disabled',true);
        $("#rfa").prop('disabled',true);
        $("#rfa").prop('disabled',true);
    }
    
     $(function(){
      $("#acopio").autocomplete({
         minLength:1,
         autoFocus:true,
         delay:10,
         source: "{{url('RRHH/Sucursalsearch')}}",
         select: function(event,ui)
         {             
             if($("#fecha").val() !='' )
             {
                 cargarplanilla(ui.item.value,$("#fecha").val(),2);
             }             
         }
      });
   });
   
   function cargarplanilla(sucursal,fecha,condicion)
   {
        fecha = fecha.replace('/','-');
        fecha = fecha.replace('/','-');        
       var route = "/Acopio/planillasemanal/"+ sucursal+"/"+fecha+"/"+condicion;       
        $.get(route, function(data){
            
            var totalkilos=0;
            var totalprecios=0;
            var totalgeneral=0;
            for(i=0;i<data.length;i++)
            {                
//                $("#fechat").(data[i].fecha);
                var temp1;var temp;
                if(data[i].tipocacao == 'GRADO II')
                {
                    temp1=''
                    temp=data[i].tipocacao;
                }
                else
                {
                    temp1=data[i].tipocacao;
                    temp='';
                }                
                var total = parseFloat(data[i].precio * data[i].kilos).toFixed(2);
                
                totalkilos += parseFloat(data[i].kilos);                
                totalprecios += parseFloat(data[i].precio);
                totalgeneral += parseFloat(total);
                $("#tablaplanilla").append("<tr>\n\
                                            <td>"+data[i].fecha+"</td>\
                                            <td>"+data[i].socios_codigo+"</td>\
                                            <td>"+data[i].paterno+" "+data[i].paterno+" " +data[i].nombre+"</td>\
                                            <td>"+temp1+"</td>\
                                            <td>"+temp+"</td>\
                                            <td>"+data[i].kilos+"</td>\
                                            <td>"+data[i].precio+"</td>\
                                            <td>"+total+"</td>\
                                            <td><hr style='background-color: black; height: 1px;  width: 100%;' /></td>\
                                        </tr>");                                
            }
            $("#tablaplanilla").append("<tr>\n\
                                            <td></td>\
                                            <td></td>\
                                            <td></td><td></td>\
                                            <td>TOTAL GENERAL</td>\
                                            <td>"+totalkilos+"</td>\
                                            <td>"+totalprecios+"</td>\
                                            <td>"+totalgeneral+"</td>\
                                            <td></td>\
                                        </tr>"); 
        });
   };
   
   $("#fecha").datepicker( {       
       autoclose: true,
        language: "es"
                
    });
</script>

@stop