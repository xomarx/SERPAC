@extends('socios.mastersocio')
@section('contentheader_title')
    TRANSFERENCIAS DE SOCIOS
@stop
@section('main-content')

@permission('ver transferencias')
<div class="box box-solid box-primary" id="listatransferencia">
    <div class="box-header">
        <a id="nuevatrans" class="btn btn-dropbox " >NUEVA TRANSFERENCIA <span class="fa fa-rocket"data-toggle="tooltip" data-placement="top" title="Nueva Transferencia"> </span></a>
    </div>
    <div class="box-body" id="contenidos-box">                
        <table class="table table-responsive" id="myTable" >
            <thead>                                                            
            <th>CODIGO</th> 
            <th>DNI EX-SOCIO</th>
            <th>EX-SOCIO</th>
            <th>DNI TITULAR</th>
            <th>SOCIO TITULAR</th>
            <th>FECHA CAMBIO</th>
            <th>USUARIO</th>
            <th>ACCIONES</th>
            </thead>
            <tbody>
                @foreach($transferencias as $transferencia)                
                <tr>                                                                
                    <td>{{$transferencia->socios_codigo}}</td>
                    <td>{{$transferencia->dnia}}</td>
                    <td>{{$transferencia->paternoa}} {{$transferencia->maternoa}} {{$transferencia->nombrea}}</td>
                    <td>{{$transferencia->dni}}</td>
                    <td>{{$transferencia->paterno}} {{$transferencia->materno}} {{$transferencia->nombre}}</td>
                    <td>{{$transferencia->fecha}}</td>
                    <td>{{$transferencia->name}}</td>
                    <td>                        
                        <a  href="{{url('Socios/transferencias/ficha')}}/{{$transferencia->id}}" class="btn-xs btn-success" target="_blank" ><span class="glyphicon glyphicon-print"data-toggle="tooltip" data-placement="top" title="Imprimir"></span></a>                        
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endpermission



@endsection

@section('script')
<script>
var rellenardatossocio = function(codigosocio) {          
        $("#motivo").show(50);
        $("#tablasocio").show(50); 
        
        $("#nombresocio").empty();$("#nombrebeneficiario").empty();
        $("#apellidossocio").empty();$("#apellidosbeneficiario").empty();
        $("#dnisocio").empty();$("#comite").empty();
        $("#sector").empty();$("#dnibeneficiario").empty();
        $("#fechasocio").empty();$("#fechabeneficiario").empty();
        $("#parentesco").empty();$("#parcela").empty();
        $("#areatotal").empty();       
        $("#dni_nuevo_socio").prop('disabled',false);
        $.get("/Socios/transferencias/datos/{term}",        
        {codigo:codigosocio},
        function(data){
            
                $("#nombresocio").append(data.socio.nombre);
                $("#apellidossocio").append(data.socio.paterno + " " + data.socio.materno);
                $("#dnisocio").append(data.socio.dni);
                $("#comite").append(data.socio.comite_local);
                $("#sector").append(data.socio.comite_central);
                $("#fechasocio").append(data.socio.fec_nac);
                
             if(data.beneficiario != null){
             $("#nombrebeneficiario").append(data.beneficiario.nombre);             
             $("#apellidosbeneficiario").append(data.beneficiario.paterno + " " + data.beneficiario.materno);                          
             $("#dnibeneficiario").append(data.beneficiario.dni);             
             $("#fechabeneficiario").append(data.beneficiario.fec_nac);             
             $("#parentesco").append(data.beneficiario.tipo_pariente);
         }
             $.each(data.fundos,function( index, value ){                                
                $("#parcela").append(value.fundo + "<br>");
                $("#areatotal").append(value.hectareas + " Ha.<br>");
             });
             
        });
    };
    
 $("#cerrartransferencia").click(function(event){
     $("#listatransferencia").show();
        $("#registrotransferencia").hide();
 });
 
var  cargartransfer = function(id){    
        $("#listatransferencia").hide();
        $("#registrotransferencia").show();
};
   
    var autocompletes = function(){
        $("#dni_socio").autocomplete({     
           minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('Auxiliar/dniSocios')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.socio);  
               $("#codigo").val(ui.item.id);
               $("#dni_socio").val(ui.item.value);
               rellenardatossocio(ui.item.id);
           }
        });
        
        $("#codigo").autocomplete({     
           minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('Auxiliar/codigoSocios')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.socio);  
               $("#codigo").val(ui.item.value);
               $("#dni_socio").val(ui.item.id);               
               rellenardatossocio(ui.item.value);
           }
        });
        
        $("#socio").autocomplete({     
           minLength:2,           
           autoFocus:true,
           delay:1,
           source: "{{url('Auxiliar/datoSocios')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.value);  
               $("#codigo").val(ui.item.id);
               $("#dni_socio").val(ui.item.dni);                             
               rellenardatossocio(ui.item.id);
           }
        });
        
        $("#dni_nuevo_socio").autocomplete({     
           minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('Auxiliar/dniParientesSocios')}}",           
           select: function(event, ui){               
               $("#dni_nuevo_socio").val(ui.item.value);
               validarnuevosocio(ui.item.value);
           }
        });
        
        $("#dni_beneficiario").autocomplete({     
           minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('Auxiliar/dnipersonas')}}",
           select: function(event, ui){               
               $("#dni_beneficiario").val(ui.item.value);
               validarbeneficiario(ui.item.value);
           }
        });
    }
    
                    
   var validarnuevosocio = function(dninuevo) {
       
       $.get("/Socios/transferencias/nuevo/{term}",        
        {dni:dninuevo},
        function(data){
            $("#error-dni_nuevo_socio").empty();
             if($("#codigo").val() == data.codigo.socios_codigo)
             {
                $("#dni_beneficiario").prop('disabled',false);
                $("#tablanuevosocio").show(50);
                $("#nombrenuevo").append(data.persona.nombre);
                $("#apellidosnuevo").append(data.persona.paterno + " " + data.persona.materno);
                $("#dninuevo").append(data.persona.dni);
                $("#fechanuevo").append(data.persona.fec_nac);
                $("#sectornuevo").append(data.persona.comite_local);
            }
             else
            {
                 $("#tablanuevosocio").hide();
                $("#error-dni_nuevo_socio").html("El nuevo Socio no es Pariente del Socio "+$("#codigo").val()+". Tienes que Registrarlo como pariente");
            }             
        });
   };
      
   var validarbeneficiario = function(dnibeneficiario){
       var codigo=$("#codigo").val();
       $.get("/Socios/transferencias/persona/{term}",        
        {dni:dnibeneficiario,codigo:codigo},
        function(data){
            $("#error-dni_beneficiario").empty();                       
            if(data.codigo == null)
            {   if(data.persona.dni == $("#dni_socio").val())
                {
                    $("#tablabeneficiario").show(50);
                    $("#nombrebeneficiarionuevo").append(data.persona.nombre);
                    $("#apellidosbeneficiarionuevo").append(data.persona.paterno + " " + data.persona.materno);
                    $("#dnibeneficiarionuevo").append(data.persona.dni);
                    $("#fechabeneficiarionuevo").append(data.persona.fec_nac);                    
                }
                else
                {
                    $("#error-dni_beneficiario").append("No es Pariente del Socio: " + $("#codigo").val());                    
                    $("#tablabeneficiario").hide();                    
                    
                }
            }
            else
            {
                if(data.codigo.socios_codigo == $("#codigo").val())
                {
                    $("#tablabeneficiario").show(50);
                    $("#nombrebeneficiarionuevo").append(data.persona.nombre);
                    $("#apellidosbeneficiarionuevo").append(data.persona.paterno + " " + data.persona.materno);
                    $("#dnibeneficiarionuevo").append(data.persona.dni);
                    $("#fechabeneficiarionuevo").append(data.persona.fec_nac);
                    $("#parientebeneficiarionuevo").append(data.codigo.tipo_pariente);
                }
                else
                {
                    $("#error_dni_beneficiario").append("No es Pariente del Socio: " + $("#codigo").val());
                    $("#idlinkbeneficiario").show();
                    $("#tablabeneficiario").hide();                    
                    $("#dni_1").val($("#dni_beneficiario").val());
                }
                
            }            
             
        });
   };
  

  //******************************
var btneditar = function(id) 
    {
        $('#Registrar').hide();
        $('#actualizar').show();
        
        var route = "{{ url('socios/departamentos')}}/"+id+"/edit";

        $.get(route, function(data){
//            alert(id);
        $("#id").val(data.id);
        $("#departamento").val(data.departamento);        
        });
    }
        
$("#actualizar").click(function()
{

  var id = $("#id").val();
  
  var departamento = $("#departamento").val();
  var route = "{{url('socios/departamentos')}}/"+id+"";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'PUT',
    dataType: 'json',
    data: {departamento: departamento},
    success: function(data){
     
     if (data.success == 'true')
     {
        listmark();
        $("#myModal").modal('toggle');
        $("#message-update").fadeIn();
       }
    },
    error:function(data)
    {
        $("#error").html(data.responseJSON.name);
        $("#message-error").fadeIn();
        if (data.status == 422) {
           console.clear();
        }
    }  
  });
});
       
var Eliminar = function(id,name)
{ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "{{url('socios/departamentos')}}/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
//          listmark();
          $("#message-delete").fadeIn();
         // $('#message-delete').toggle(3000);
          $('#message-delete').show().delay(3000).fadeOut(1);
        }
      }
      });
        
  
    });
};

$(document).ready(function(){
    $("#subtransferencias").addClass("active");
    $("#menusocios").addClass('active');
});
  
</script>
@stop
