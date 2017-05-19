@extends('Tesoreria.mastertesoreria')
@section('contentheader_title')
    CAJA
@stop
@section('main-content')
@permission('ver caja')
<div class="box box-primary">
    <div id='calendar'></div>    
</div>
<section id="conten-modal"></section>
@endpermission



@stop

@section('script')
<script>
    $(document).ready(function(){
       $("#menutesoreria").addClass('active');
       $("#subcaja").addClass('active'); 
       var fecha = new Date();
       $('#calendar').fullCalendar({
           selectable: true, 
           events: "{{ url('Tesoreria/Caja/Lista-caja') }}",
           eventClick: function(calEvent, jsEvent, view) {                                                        
                            $.ajax({
                                url:"{{ url('Tesoreria/Caja/Datos-Caja') }}/"+calEvent.id,
                                type: 'GET',
                                dataType: 'json',
                                success: function(data){
                                    var datos = "<table WIDTH='100%' border='1' cellspacing='1' cellpadding='2'><tbody><tr><td style='color: #5882FA; font-size: 12'>USUARIO</td>"+                                    
                                        "<td style='color: #000; font-size: 10'>"+data.name+"</td></tr><tr><td style='color: #5882FA; font-size: 12'>FECHA</td>"+
                                        "<td style='color: #000; font-size: 10'>"+data.fecha+"</td></tr><tr><td style='color: #5882FA; font-size: 12'>MONTO</td>"+
                                        "<td style='color: #000; font-size: 10'> S/. "+data.monto+"</td></tr><tr><td style='color: #5882FA; font-size: 12'>OBSERVACION</td>"+
                                        "<td style='color: #000; font-size: 10'>"+data.observacion+"</td></tr></tbody></table>";                                
                                    $.alertable.alert(datos);
                                }
                            })                            
            },
           select: function(start, end, jsEvent){
               
                        starttime = $.fullCalendar.moment(start).format('Y-M-D');                         
                            if($.fullCalendar.moment(start).format('D') == fecha.getDate() && $.fullCalendar.moment(start).format('M') == (fecha.getMonth()+1))
                            {
                                var route = '/Tesoreria/Caja/Apertura-Cierre-Caja/'+starttime;        
                                $.get(route,function(data){            
                                    $("#conten-modal").html(data);
                                    $("#modal-form").modal();
                                });                                                              
                            }
                            else                                
                                $.alertable.alert("<spam style='color:#000'>No Puede Aperturar la Caja</spam><br><spam style='color:#ff0000'>La Fecha no es Actual  <i class='glyphicon glyphicon-info-sign'></i></spam>");                            
//                            
//                            $.alertable.alert(starttime);                                                        
                        }
       })
    });
</script>
@stop