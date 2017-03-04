@extends('socios.mastersocio')
@section('contentheader_title')
    TRANSFERENCIAS DE SOCIOS
@stop
@section('main-content')
<div class="box box-solid box-primary" id="listatransferencia">
    <div class="box-header">
       <center> <h3 class="box-title">LISTA DE TRANSFERENCIAS DE SOCIOS</h3></center>
    </div>
    <div class="box-body">
        <a id="nuevatrans" onclick="cargartransfer(1)" class="btn btn-primary btn-sm m-t-10" ><span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Transferencia"> TRANSFERENCIA</span></a>
        <line>
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
                        <a href="{{url('socios/transferencias/ficha')}}/{{$transferencia->id}}" ><span class="glyphicon glyphicon-print"data-toggle="tooltip" data-placement="top" title="Imprimir"></span></a>                        
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="box box-solid box-primary" id="registrotransferencia" style="display: none">    
    @include('socios.formtransferencia')
</div>

@include('socios.formParientes')

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
        $.get("/socios/transferencias/datos/{term}",        
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
    
$(function(){              
        $("#socio").autocomplete({     
           minLength:2,           
           autoFocus:true,
           delay:1,
           source: "{{url('socios/search')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.value);  
               $("#codigo").val(ui.item.id);
               $("#dni_socio").val(ui.item.dni);                             
               rellenardatossocio(ui.item.id);
           }
        });
   });
   
   $(function(){              
        $("#codigo").autocomplete({     
           minLength:1,           
           autoFocus:true,
           delay:0,
           source: "{{url('socios/codigo')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.id);  
               $("#codigo").val(ui.item.value);
               $("#dni_socio").val(ui.item.dni);               
               rellenardatossocio(ui.item.value);
           }
        });
   });
   
   $(function(){              
        $("#dni_socio").autocomplete({     
           minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('socios/dni')}}",
           select: function(event, ui){
               $("#socio").val(ui.item.socio);  
               $("#codigo").val(ui.item.id);
               $("#dni_socio").val(ui.item.value);
               rellenardatossocio(ui.item.id);
           }
        });
   });
   
   var validarnuevosocio = function(dninuevo) {              
       $.get("/socios/transferencias/nuevo/{term}",        
        {dni:dninuevo},
        function(data){
            $("#error_nuevo_socio").empty();
            $("#idlinkpariente").empty();
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
                $("#error_nuevo_socio").append("El nuevo Socio no es Pariente del Socio "+$("#codigo").val()+". Tienes que Registrarlo como pariente");
                $("#divnuevosocio").append("<a href='#' data-toggle='modal' data-target='#pariente' id='idlinkpariente'><span data-toggle='tooltip' data-placement='top' title='Registrar Pariente'>Registrar Pariente</span></a>");
                $("#dni_1").val($("#dni_nuevo_socio").val());
             }             
        });
   };
   
   $(function(){    
       $("#tabla")
        $("#dni_nuevo_socio").autocomplete({     
           minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('socios/dnipersona')}}",           
           select: function(event, ui){               
               $("#dni_nuevo_socio").val(ui.item.value);
               validarnuevosocio(ui.item.value);
           }
        });
   });
   
   var validarbeneficiario = function(dnibeneficiario){
       var codigo=$("#codigo").val();
       $.get("/socios/transferencias/persona/{term}",        
        {dni:dnibeneficiario,codigo:codigo},
        function(data){
            $("#error_dni_beneficiario").empty();
            $("#idlinkbeneficiario").hide();
            console.log(data);
            console.log(data.codigo);
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
                    $("#error_dni_beneficiario").append("No es Pariente del Socio: " + $("#codigo").val());
                    $("#idlinkbeneficiario").show();
                    $("#tablabeneficiario").hide();
                    console.log($("#dni_beneficiario").val());
                    $("#dni_1").val($("#dni_beneficiario").val());
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
                    console.log($("#dni_beneficiario").val());
                    $("#dni_1").val($("#dni_beneficiario").val());
                }
                
            }            
             
        });
   };
   
   $(function(){              
        $("#dni_beneficiario").autocomplete({     
           minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('socios/dnibeneficiario')}}",
           select: function(event, ui){               
               $("#dni_beneficiario").val(ui.item.value);
               validarbeneficiario(ui.item.value);
           }
        });
   });

 $("#comite_central_1").change(function(event){          
     var route = "{{url('comite_locales')}}/"+event.target.value + "";  
     
    $.get(route,function(response){         
        $("#comites_locales_id").empty();
        $("#comites_locales_id").append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#comites_locales_id").append("<option value='" + response[i].id+"'>"+response[i].comite_local+"</option>");
        }
    }); 
 });
// 
 $("#distrito_1").change(function(event){     
     var route = "/comites_centrales/"+event.target.value + "";   
     
    $.get(route,function(response){           
        $("#comite_central_1").empty();
        $("#comite_central_1").append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#comite_central_1").append("<option value='" + response[i].id+"'>"+response[i].comite_central+"</option>");
        }
    }); 
 });
  
 $("#provincia_1").change(function(event){     
     var route = "/distritos/"+event.target.value + "";         
    $.get(route,function(response){          
        $("#distrito_1").empty();
        $("#distrito_1").append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#distrito_1").append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
        }
    }); 
 });

 $("#departamento_1").change(function(event){     
     var route = "/provincias/"+event.target.value + "";       
    $.get(route,function(response){        
        $("#provincia_1").empty();
        $("#provincia_1").append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#provincia_1").append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
        }
    }); 
 });

//************************  REGISTRAR 
$("#transSocio").click(function(event)
    {       
            var fields = $("#formtransferencia").serialize();
//            var token = $("input[departamento=_token]").val();
            var token = $("#token").val();                       
            var route = "{{url('socios/transferencias')}}"; 
            console.log(fields);
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'post',
            datatype: 'json',            
            data: fields,
            success:function(data)
            {
                if(data.success == 'true')
                {
                    document.location.reload();            
                }
            },
            error:function(data)
            {                
//                $("#error").html(data.responseJSON.name);
//                $("#message-error").fadeIn();
//                if (data.status == 422) {
//                   console.clear();
//                }
            }  
          })      
    });  

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

  
</script>
@stop
