/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//  ***************   LISTA DE UBIGEO 


// $("#comite_central").change(function(event){     
//     var route = "/comites_locales/"+event.target.value + "";   
//     alert(route);
//    $.get(route,function(response){           
//        $("#comite_local").empty();
//        for (var i = 0; i < response.length; i++) {            
//            $("#comite_local").append("<option value='" + response[i].id+"'>"+response[i].comite_local+"</option>");
//        }
//    }); 
// });
// 
// $("#distrito").change(function(event){     
//     var route = "/comites_centrales/"+event.target.value + "";   
//     
//    $.get(route,function(response){           
//        $("#comite_central").empty();
//        for (var i = 0; i < response.length; i++) {            
//            $("#comite_central").append("<option value='" + response[i].id+"'>"+response[i].comite_central+"</option>");
//        }
//    }); 
// });
 
 
// $("#provincia").change(function(event){     
//     var route = "/distritos/"+event.target.value + "";         
//    $.get(route,function(response){          
//        $("#distrito").empty();
//        for (var i = 0; i < response.length; i++) {            
//            $("#distrito").append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
//        }
//    }); 
// });
// 
// 
// $("#departamento").change(function(event){     
//     var route = "/provincias/"+event.target.value + "";       
//    $.get(route,function(response){        
//        $("#provincia").empty();
//        for (var i = 0; i < response.length; i++) {            
//            $("#provincia").append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
//        }
//    }); 
// });
// 

// complemento

$(document).ready(function () {        
        if($('#idestado').is(':visible'))
        {            
            document.location.href= '/login';
        }            
    }); 


var cargarprovincia = function(iddepa,idselec)
{
    var route = '/provincias/'+iddepa;       
    $.get(route,function(response){        
        $("#"+idselec).empty();
        $("#"+idselec).append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#"+idselec).append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
        }
    });
};

var cargardistrito = function (iddist,idsele)
 {
      var route = "/distritos/"+iddist + "";         
    $.get(route,function(response){          
        $("#"+idsele).empty();
        $("#"+idsele).append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#"+idsele).append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
        }
    }); 
 };

 
  var cargarcomite_central = function (idcomitecentral,idselec)
 {
     var route = "/comites_centrales/"+ idcomitecentral; 
     $.get(route,function(response){           
        $("#"+idselec).empty();
        $("#"+idselec).append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#"+idselec).append("<option value='" + response[i].id+"'>"+response[i].comite_central+"</option>");
        }
    }); 
 };
 
 var cargarComitelocal = function (idcomitelocal,idselec)
 {
     var route = "/comite_locales/"+idcomitelocal;        
    $.get(route,function(response){        
        $("#"+idselec).empty();
        $("#"+idselec).append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#"+idselec).append("<option value='" + response[i].id+"'>"+response[i].comite_local+"</option>");
        }
    }); 
 }





// CRUD TIPO EGRESO


var EdiTipoEgreso = function(id){
    
        $("#RegtipoEgreso").text("Actualizar");
        var route = "/Tesoreria/Tipos-egresos/"+id+"/edit";
        
        $("#id").val(id);
        $.get(route, function(data){
            $("#tipo").val(data.tipo_egreso);
            $("#descripcion").val(data.descripcion);
        });
};

var ElitipoEgreso = function(id,name)
{
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Tesoreria/Tipos-egresos/"+id+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {           
            document.location.reload();
        }
      }
      });          
    });
}

$("#RegtipoEgreso").click(function(){
    var tipo = $("#tipo").val();
    var descripcion = $("#descripcion").val();
    var route = "/Tesoreria/Tipos-egresos";
    var id = $("#id").val();
    var token = $("#token").val();
    var type = 'post';
    if($("#RegtipoEgreso").text() == 'Actualizar')
    {
        
        route = '/Tesoreria/Tipos-egresos/'+id;
        type='put';        
    }    
    
       $.ajax({
           url:route,
           headers:{'X-CSRF-TOKEN':token},
           type: type,
           data:{
           tipo_egreso:tipo,
           descripcion:descripcion
           },
           success:function(data){
               if (data.success = 'true')
                    {
                        $("#modaltipoegreso").fadeOut(800);
                        document.location.reload();
                    }
           }
       });
});

//  ************  CRUD COMPRAS  ********************************************************************************

   $("#RegCompras").click(function(){
       var fecha = $("#fecha").val();
       var kilos = $("#kilos").val();
       var precio = $("#precio").val();
       var observacion = $("#observacion").val();
       var tipocacao = $("#tipo").val();
       var sucursal = $("#acopio").val();
       var codigo = $("#codigo").val();
       var enumeracion = $("#numero").val();
       
       if($("#codigo").val() == '')
       {
           codigo="NO SOCIO";
       }       
       var condicion = $("#condicion").val();
       var route = "/Acopio/Compra-Grano";
       var token = $("#token").val();       
       $.ajax({
           url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                datatype: 'json',                
                data: {                    
                    kilos: kilos,
                    fecha: fecha,
                    precio:precio,
                    observacion:observacion,
                    tipocacao: tipocacao,
                    sucursal:sucursal,
                    codigo:codigo,
                    condicion:condicion,
                    enumeracion : enumeracion
                },
                success: function (data)
                {
                    if (data.success = 'true')
                    {
                        $("#modalcompra").fadeOut(500);
                        document.location.reload();
                    }
                },     
       });
       
   });

var AnulCompra = function(id,name)
{             
    // ALERT JQUERY     
   $.alertable.prompt('<h3>Motivo de la Anulacion ? </h3>'+"<span style='color:#ff0000'>"+name+"</span>").then(function(data){       
            var motivo = data.value;
            var route = "/Acopio/Compra-Grano/"+id+"";            
            var token = $("#token").val();            
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: {
                motivo:motivo
            },
            success: function (data) {

                if (data.success = 'true')
                {
                   document.location.reload();
                }
            },
            
        });
   },function(){
       console.log('Prompt canceled'); 
   });    
};

//  recepcion de fondo

var RecepConform = function(id)
    {        
        //  cargar datos
        var route = "/Acopio/Fondos-Acopio/"+id+"/edit";             
            $.get(route, function(data){                
                $("#monto").val(data.monto)                
            });
            
        if($("#estado").val() == '')
        {
            $.alertable.alert("Seleccione si esta Conforme ó No Conforme");
        }
        else if ($("#estado").val() == 'CONFORME')
        {
            $.alertable.confirm("Esta Conforme la Recepcion de Fondoc de Acopio").then(function(){                
              RegistroRec(id);
            });
        }
        else if($("#estado").val() == 'NO CONFORME')
        {         
            $("#id").val(id);
            $("#myModal").modal();
        }        
    }
    
    $("#RegRecepcion").click(function(){        
        RegistroRec($("#id").val());
    });
    
    function RegistroRec (id)
    {
// actualiza
        var monto = $("#monto").val();
        var estado = $("#estado").val();
        var motivo = $("#motivo").val();     
        var route = '/Acopio/Fondos-Acopio/'+id;        
        var token = $("#token").val();                    
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: {
                monto:monto,
                estado:estado,
                motivo:motivo
            },
            success: function (data) {
                if (data.success = 'true')
                {
                   document.location.href = '/Acopio/Fondos-Acopio';
                }
            },
            
        });
    }

// ****************     DISTRIBUCION DE ACOPIO ********************************************************************************
var AnulDistribucion = function(id,name)
{             
    // ALERT JQUERY     
   $.alertable.prompt('<h3>Motivo de la Anulacion ? </h3>'+"<span style='color:#ff0000'>"+name+"</span>").then(function(data){
       console.log('Prompt submitted', data.value);
            var motivo = data.value;
            var route = "/Tesoreria/Distribucion-Fondos/"+id+"";            
            var token = $("#token").val();            
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: {
                motivo:motivo
            },
            success: function (data) {

                if (data.success = 'true')
                {
                   document.location.href = '/Tesoreria/Distribucion-Fondos';
                }
            },
            
        });
   },function(){
       console.log('Prompt canceled'); 
   });    
};
    
$("#RegDistribucion").click(function(){
    
      var tecnico = $("#tecnico").val();
      var sucursal = $("#sucursal").val();
      var monto = $("#monto").val();
      var fecha = $("#fecha").val();
      var estado = 'ENTREGADO';      
   var route = "/Tesoreria/Distribucion-Fondos";
      var token = $("#token").val();       
      $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                datatype: 'json',
                
                data: {                    
                    monto: monto,
                    fecha: fecha,
                    tecnicos_empleados_empleadoId:tecnico,
                    sucursales_sucursalId:sucursal,
                    estado: estado
                },
                success: function (data)
                {
                    if (data.success = 'true')
                    {
                        $("#RegDistribucion").text('Imprimir');
                    }
                },               
            });
});

// **********************  CRUD SUCURSAL
  $(document).ready(function () {        
        $('#myTable').DataTable();
    }); 

// **************************  CRUD EMPLEADO  ********************************************************************************

  $("#nuevoempleado").click(function(event){     
     $("#RegEmpleado").text('Registrar');     
 });
 
$("#RegEmpleado").click(function(event)
    {               
        var empleadiid = $("#codigo").val();
    var dni = $("#dni").val();
    var esdocivil = $("#esdocivil").val();
    var estado = $("#estado").val();
    var email = $("#email").val();
    var profesion = $("#profesion").val();
    var ruc = $("#ruc").val();
    var cargo = $("#cargo").val();
    var area = $("#area").val();
    var paterno = $("#paterno").val();
    var materno = $("#materno").val();
    var nombre = $("#nombre").val();
    var fec_nac = $("#fec_nac").val();
    var sexo = $("#sexo").val();
    var direccion = $("#direccion").val();
    var referencia = $("#referencia").val();
    var telefono = $("#telefono").val();
    var comites_locales_id = $("#comite_local").val();
        if( $("#RegEmpleado").text() == 'Registrar' )
        {                                    
            var token = $("#token").val();
            var route = "/RRHH/empleados";            
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                datatype: 'json',
                
                data: {                    
                    empleadoId:empleadiid,
                    dni : dni,
                    estadocivil: esdocivil,
                    estado: estado,
                    email: email,
                    profesion: profesion,
                    ruc : ruc,
                    cargos_id:cargo,
                    areas_id: area,
                    paterno: paterno,
                    sexo:sexo,
                    materno: materno,
                    nombre: nombre,
                    fec_nac: fec_nac,
                    distancia: direccion,
                    referencia: referencia,
                    telefono: telefono,                                
                    comites_locales_id: comites_locales_id
                },
                success: function (data)
                {
                    if (data.success = 'true')
                    {
                        document.location.href = '/RRHH/empleados';
                    }
                },                
            });
        }
        else if($("#RegEmpleado").text() == 'Actualizar')
        {
            var route = "/RRHH/empleados/"+empleadiid+"";
            console.log('Actualizando');
            var token = $("#token").val();            
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: {
                empleadoId:empleadiid,
                    dni : dni,
                    estadocivil: esdocivil,
                    estado: estado,
                    email: email,
                    profesion: profesion,
                    ruc : ruc,
                    cargos_id:cargo,
                    areas_id: area,
                    paterno: paterno,
                    sexo:sexo,
                    materno: materno,
                    nombre: nombre,
                    fec_nac: fec_nac,
                    distancia: direccion,
                    referencia: referencia,
                    telefono: telefono,                                
                    comites_locales_id: comites_locales_id
            },
            success: function (data) {

                if (data.success = 'true')
                {
                   document.location.href = '/RRHH/empleados';
                }
            },
            
        });
        }
                                                  
    });

var EdiEmpleado = function(id) 
    {
       $("#RegEmpleado").text("Actualizar");       
        var route = "/RRHH/empleados/"+id+"/edit";          
        $.get(route, function(data){
            console.log(data.empleadoId);
            $("#codigo").val(data.empleadoId);
            $("#dni").val(data.personas_dni);
            $("#esdocivil").val(data.estadocivil);
            $("#estado").val(data.estado);
            $("#email").val(data.email);
            $("#profesion").val(data.profesion);
            $("#ruc").val(data.ruc);
                        
            $("#cargo").empty();
            $("#cargo").append("<option value='" + data.cargos_id+"'>"+data.cargo+"</option>");
            $("#area").empty();
            $("#area").append("<option value='" + data.areas_id+"'>"+data.area+"</option>");            
            
            $("#paterno").val(data.paterno);
            $("#materno").val(data.materno);
            $("#nombre").val(data.nombre);
            $("#fec_nac").val(data.fec_nac);
            $("#sexo").val(data.sexo);
            $("#direccion").val(data.direccion);
            $("#referencia").val(data.referencia);
            $("#telefono").val(data.telefono);
            $("#departamento").val(data.departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.provincias_id+"'>"+data.provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data.distritos_id+"'>"+data.distrito+"</option>");
        $("#comite_central").empty();
        $("#comite_central").append("<option value='" + data.comites_centrales_id+"'>"+data.comite_centra+"</option>");
            $("#comite_local").empty();
        $("#comite_local").append("<option value='" + data.comites_locales_id+"'>"+data.comite_local+"</option>");  
            
           
        });
    }

var EliEmpleado = function(id,name)
{ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"
           +name+"</span></strong></br>").then(function() {  
      var route = "/RRHH/empleados/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
            document.location.href = '/RRHH/empleados';
        }
      }
      });
        
  
    });
};

// ************************   CRUD DE CENTROS DE ACOPIO ********************************************************************************
$("#RegSucursal").click(function(event)
    {       
        if( $("#RegSucursal").text() == 'Registrar' )
        {            
            var codigoId = $("#codigoId").val();
            var area = $("#area").val();
            var telefono = $("#telefono").val();
            var direccion = $("#direccion").val();
            var fax = $("#fax").val();
            var sucursal = $("#sucursal").val();
            var comites_locales_id = $("#comite_local").val();
            var token = $("#token").val();
            var route = "/RRHH/Sucursal";
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                datatype: 'json',
                //async: false,
    //            data:dataSting,
                data: {
                    sucursalId: codigoId,
                    areas_id: area,
                    telefono: telefono,
                    direccion: direccion,
                    fax: fax,
                    sucursal: sucursal,
                    comites_locales_id: comites_locales_id
                },
                success: function (data)
                {
                    if (data.success = 'true')
                    {
                        document.location.href = '/RRHH/Sucursal';
                    }
                },
                error: function (data)
                {
                    $("#error").html(data.responseJSON.codigoId);
                    if (data.status = 422) {
                        console.clear();
                    }
                }
            });
        }
        else if( $("#RegSucursal").text() == 'Actualizar' )
        {                      
            var codigoId = $("#codigoId").val();
            var area = $("#area").val();
            var telefono = $("#telefono").val();
            var direccion = $("#direccion").val();
            var fax = $("#fax").val();
            var sucursal = $("#sucursal").val();
            var comites_locales_id = $("#comite_local").val();
            var departamento = $("#departamento").val();
            var route = "/RRHH/Sucursal/" + codigoId + "";   
            alert(comites_locales_id);
            var token = $("#token").val();            
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'PUT',
                dataType: 'json',
                data: {
                    areas_id: area,
                    telefono: telefono,
                    direccion: direccion,
                    fax: fax,
                    sucursal: sucursal,
                    comites_locales_id: comites_locales_id
                },
                success: function (data) {

                    if (data.success = 'true')
                    {
                        document.location.href = '/RRHH/Sucursal';
                    }
                },
                error: function (data)
                {
                    $("#error").html(data.responseJSON.codigoId);
                }
            });
        
        }                                          
    });
    
    
    var Editsucur = function(id) 
    {        
        $("#RegSucursal").text('Actualizar');
        var route = "/RRHH/Sucursal/"+id+"/edit";

        $.get(route, function(data){

            $("#codigoId").val(data.sucursalId);
            $("#area").val(data.areas_id);
            $("#telefono").val(data.telefono);
            $("#direccion").val(data.direccion);
            $("#fax").val(data.fax);
            $("#sucursal").val(data.sucursal);
            
            $("#departamento").val(data.departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.provincias_id+"'>"+data.provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data.distritos_id+"'>"+data.distrito+"</option>");
        $("#comite_central").empty();
        $("#comite_central").append("<option value='" + data.comites_centrales_id+"'>"+data.comite_centra+"</option>");
            $("#comite_local").empty();
        $("#comite_local").append("<option value='" + data.comites_locales_id+"'>"+data.comite_local+"</option>");        
        });
    };
        
        
    
var EliSucursal = function(id,name)
{ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/RRHH/Sucursal/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
            document.location.href = '/RRHH/Sucursal';
        }
      }
      });
        
  
    });
};        
        
        
//  ************************   CRUD CARGOS


$("#RegCargo").click(function(event)
    {       
            var cargo = $("#cargo").val();
            var token = $("#token").val();           
            
            var route = "/RRHH/Cargos";            
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'post',
            datatype: 'json',
            //async: false,
//            data:dataSting,
            data: {cargo: cargo},
            success:function(data)
            {
                if(data.success = 'true')
                {                    
                    document.location.href= '/RRHH/Cargos';
                }
            },
            error:function(data)
            {                
                $("#error").html(data.responseJSON.cargo);               
                if (data.status = 422) {
                   console.clear();
                }

            }  
          })
      


    });

var EdiCargo = function(id) 
    {      
        var route = "/RRHH/Cargos/"+id+"/edit";
        $.get(route, function(data){
//            alert(id);
        $("#id").val(data.id);
        $("#cargo_1").val(data.cargo);        
        });
    };
                   
$("#ActCargo").click(function()
{

  var id = $("#id").val();
  
  var cargo = $("#cargo_1").val();
  var route = "/RRHH/Cargos/"+id+"";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'PUT',
    dataType: 'json',
    data: {cargo: cargo},
    success: function(data){
     
     if (data.success = 'true')
     {
        
        $("#myModal").fadeOut(3000);
        document.location.href= '/RRHH/Cargos';
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
   
   
var EliCArgo = function(id,name)
{ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/RRHH/Cargos/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
            document.location.href= '/RRHH/Cargos';
        }
      }
      });
        
  
    });
};

// ******************  CRUD AREAS
$("#RegArea").click(function(event)
    {       
            var area = $("#area").val();
            var token = $("#token").val();                       
            var route = "/RRHH/Area";            
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'post',
            datatype: 'json',

            data: {area: area},
            success:function(data)
            {
                if(data.success = 'true')
                {                    
                    document.location.href= '/RRHH/Area';
                }
            },              
          })
    });  

var EdiArea = function(id) 
    {                
        var route = "/RRHH/Area/"+id+"/edit";
        $.get(route, function(data){
//            alert(id);
        $("#id").val(data.id);
        $("#area_1").val(data.area);        
        });
    }

      
$("#ActArea").click(function()
{
  var id = $("#id").val();
  
  var area = $("#area_1").val();
  var route = "/RRHH/Area/"+id+"";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'PUT',
    dataType: 'json',
    data: {area: area},
    success: function(data){
     
     if (data.success = 'true')
     {       
        $("#myModal").fadeOut(1000);
        document.location.href= '/RRHH/Area';       
     }
    },
    error:function(data)
    {
        $("#error").html(data.responseJSON.area);
        $("#message-error").fadeIn();
        if (data.status == 422) {
           console.clear();
        }
    }  
  });
});
   
   
var EliArea = function(id,name)
{ 
     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/RRHH/Area/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
              document.location.href= '/RRHH/Area';    
        }
      }
      });
        
  
    });
};






// *************************  CRUD FAUNA  ********************************************************************************************************
$("#nuefauna").click(function(event){$("#RegFauna").text("Registrar");});

$("#RegFauna").click(function(event)
    {                   
            var fields = $("#formfauna").serialize();
            var token = $("#token").val();     
            var type = "POST";
            var route = "/socios/basicos/faunas";
            if( $("#RegFauna").text() == "Actualizar" )
            {
                route = "/socios/basicos/faunas/"+$("#idfauna").val();
                type="PUT";
            }
            
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',
            //async: false,
            data:fields,                  
            success:function(data)
            {                         
                if(data.success == 'true')
                {                         
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succesfauna").html(msj);
                   $("#msj-infofauna").fadeIn();
                    document.location.reload();
                }
            },
             error:function(data)
            {
                $("#error_fauna").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'fauna')$("#error_fauna").html(value);                                                    
                      });          
                               
            }
          })      
    });  

var EditFauna = function(id) 
    {                
        $("#RegFauna").text("Actualizar");
        var route = "/socios/basicos/faunas/"+id+"/edit";                
        $.get(route, function(data){   
        $("#idfauna").val(data.id);
        $("#fauna").val(data.fauna);          
        });
    }
          
var EliFauna = function(id,name)
{ 
     // ALERT JQUERY        
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/basicos/faunas/"+id+"";      
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
          document.location.reload();
        }
      }
      });          
    });
};

//  ***************************   CRUD INMUEBLE  **************************************************************************************************

$("#RegInmueble").click(function(event)
    {                   
            var fields = $("#forminmueble").serialize();
            var token = $("#token").val();
            var route = "/socios/basicos/inmuebles";     
            var type = "POST";
            if($("#RegInmueble").text() == "Actualizar")
            {
                route = "/socios/basicos/inmuebles/" + $("#idinmueble").val();
                type = "PUT";
            }
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',
            data: fields,            
            success:function(data)
            {                         
                if(data.success == 'true')
                {                
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succesinmueble").html(msj);
                   $("#msj-infoinmueble").fadeIn();
                    document.location.reload();
                }
            },
            error:function(data)
            {
                $("#error_inmueble").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'inmueble')$("#error_inmueble").html(value);                                                    
                      });          
                               
            }
          })      
    });  

var EdInmueble = function(id){              
        var route = "/socios/basicos/inmuebles/"+id+"/edit";                
        $.get(route, function(data){   
        $("#idinmueble").val(data.id);
        $("#inmueble").val(data.inmueble);  
        $("#RegInmueble").text("Actualizar");
        });
    };
    
 $("#nuevoinmueble").click(function(event){$("#RegInmueble").text("Registrar")});
           
var EliInmueble = function(id,name){ 
     // ALERT JQUERY        
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/basicos/inmuebles/"+id+"";      
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
          document.location.reload();
        }
      }
      });          
    });
};

// ******************************  CRUD FUNDOS  ***********************************************************************************************
   
    var Eliminarcultivo = function(fila,idcultivo) {        
        var valor=document.getElementById("tablacultivos").rows[fila].cells[0].innerText;            
        document.getElementById('tablacultivos').deleteRow(fila);
        $("#flora").append("<option value="+idcultivo+" selected='selected'>"+ valor+"</option>")
    };
           
    var Eliminarfauna = function(fila,idfauna)
    {
        var valor=document.getElementById("tablafauna").rows[fila].cells[0].innerText;            
        document.getElementById('tablafauna').deleteRow(fila);
        $("#fauna").append("<option value="+idfauna+" selected='selected'>"+ valor+"</option>")
    }
       
var Eliminarinmueble = function(fila,idinmueble){
        var valor=document.getElementById("tablainmueble").rows[fila].cells[0].innerText;            
        document.getElementById('tablainmueble').deleteRow(fila);
        $("#inmueble").append("<option value="+idinmueble+" selected='selected'>"+ valor+"</option>")
    }

var fundopropiedadFauna = function(fundo,fauna,cantidad,rendimiento)
{    
    var route = '/socios/propiedadfauna';
    var token = $("#token").val();
    $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:'POST',
            datatype: 'json',
            //async: false,
            data: {
                fundo:fundo,
                fauna:fauna,
                cantidad:cantidad,
                rendimiento:rendimiento
            },
            success:function(data)
            {                
                if(data.success == 'true')
                {                            
                   console.log('fauna registrado');
                }
            },            
          });
};

var fundopropiedadFlora = function(fundo,flora,hectarea,rendimiento)
{            
    var route = '/socios/propiedadflora';
    var token = $("#token").val();
    $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:'POST',
            datatype: 'json',
            //async: false,
            data: {
                fundo:fundo,
                flora:flora,
                hectarea:hectarea,
                rendimiento:rendimiento
            },
            success:function(data)
            {                
                if(data.success == 'true')
                {                            
                   console.log('flora registrado');
                }
            },            
          });
};

var fundopropiedadInmueble = function(fundo,inmueble)
{    
    var route = '/socios/propiedadinmueble';
    var token = $("#token").val();
    $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:'POST',
            datatype: 'json',
            //async: false,
            data: {
                fundo:fundo,
                inmueble:inmueble                
            },
            success:function(data)
            {                
                if(data.success == 'true')
                {                            
                   console.log('inmueble registrado');
                }
            },            
          });
};

var registropropoiedadesFundo = function()
{
    for (var i = 1; i < document.getElementById("tablacultivos").rows.length; i++) {
                        var hectarea =document.getElementById("tablacultivos").rows[i].cells[1].getElementsByTagName('input');
                        var rendimiento =document.getElementById("tablacultivos").rows[i].cells[2].getElementsByTagName('input');
                        var flora =document.getElementById("tablacultivos").rows[i].cells[0].innerText;                        
                        fundopropiedadFlora($("#fundo").val(),flora,hectarea[0].value,rendimiento[0].value);
                    }
                    for (var i = 1; i < document.getElementById("tablafauna").rows.length; i++) {
                        var cantidad =document.getElementById("tablafauna").rows[i].cells[1].getElementsByTagName('input');
                        var rendimiento =document.getElementById("tablafauna").rows[i].cells[2].getElementsByTagName('input');
                        var fauna =document.getElementById("tablafauna").rows[i].cells[0].innerText;                        
                        fundopropiedadFauna($("#fundo").val(),fauna,cantidad[0].value,rendimiento[0].value);
                    }
                    for (var i = 1; i < document.getElementById("tablainmueble").rows.length; i++) {                        
                        var inmueble =document.getElementById("tablainmueble").rows[i].cells[0].innerText;                        
                        fundopropiedadInmueble($("#fundo").val(),inmueble);
                    }
}

var limpiarPropiedadesFundo = function (idfundo){
    var route = "/socios/eliminarpropiedades/" + idfundo + "";
    var token = $("#token").val();
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function (data) {            
        }
    });
}

$("#RegFundo").click(function(event){      
            
        var errortexto;
    for (var i = 1; i < document.getElementById("tablacultivos").rows.length; i++) {
        var texto =document.getElementById("tablacultivos").rows[i].cells[1].getElementsByTagName('input');
        var texto2 =document.getElementById("tablacultivos").rows[i].cells[2].getElementsByTagName('input');
         if(texto[0].value == '') {
             errortexto =document.getElementById("tablacultivos").rows[i].cells[1].getElementsByTagName('div');
             errortexto[0].innerHTML = "Ingrese el N° de Hectarea";
         }
         else {var errortexto =document.getElementById("tablacultivos").rows[i].cells[1].getElementsByTagName('div');
             errortexto[0].innerHTML = "";}
         if(texto2[0].value == '') {
             errortexto =document.getElementById("tablacultivos").rows[i].cells[2].getElementsByTagName('div');
             errortexto[0].innerHTML = "Ingrese el rendimineto anual";
         }
         else {var errortexto =document.getElementById("tablacultivos").rows[i].cells[2].getElementsByTagName('div');
             errortexto[0].innerHTML = "";}
    }
    
    for (var i = 1; i < document.getElementById("tablafauna").rows.length; i++) {
        var texto =document.getElementById("tablafauna").rows[i].cells[1].getElementsByTagName('input');
        var texto2 =document.getElementById("tablafauna").rows[i].cells[2].getElementsByTagName('input');
         if(texto[0].value == '') {
             errortexto =document.getElementById("tablafauna").rows[i].cells[1].getElementsByTagName('div');
             errortexto[0].innerHTML = "Ingrese una cantidad";
         }
         else {var errortexto =document.getElementById("tablafauna").rows[i].cells[1].getElementsByTagName('div');
             errortexto[0].innerHTML = "";}
         if(texto2[0].value == '') {
             errortexto =document.getElementById("tablafauna").rows[i].cells[2].getElementsByTagName('div');
             errortexto[0].innerHTML = "Ingrese el rendimineto anual";
         }
         else {var errortexto =document.getElementById("tablafauna").rows[i].cells[2].getElementsByTagName('div');
             errortexto[0].innerHTML = "";}
    }
        
    if( $("#tablacultivos tr").length == 1) $("#error_cultivos").html("Agregue un cultivo"); 
    else $("#error_cultivos").html("");
    if( $("#tablafauna tr").length == 1) $("#error_crianzas").html("Agregue una crianza");
    else $("#error_crianzas").html("");
    if( $("#tablainmueble tr").length == 1) $("#error_inmuebles").html("Agregue un inmueble");
    else $("#error_inmuebles").html("");
    if($("#tablacultivos tr").length == 1 || $("#tablafauna tr").length == 1 || $("#tablainmueble tr").length == 1) return;            
    var type = 'POST';
    var route = '/socios/fundos';
    var fields = $("#formfundo").serialize('hidden');
    if($("#RegFundo").text() == "Actualizar")
    {
        type = "PUT";
        route = "/socios/fundos/"+$("#idfundo").val();
    }        
    var token = $("#token").val();
    $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:type,
            datatype: 'json',
            //async: false,
            data: fields,
            success:function(data)
            {        
                
                if(data.success == 'Registrar')
                {           
                    registropropoiedadesFundo();
                   var msj = "<h4>"+data.message+"</h4>";
                   $("#succesfundo").html(msj);
                   $("#msj-infofundo").fadeIn();                   
                    document.location.reload();
                }
                else if(data.success == 'Actualizar')
                {     
                    limpiarPropiedadesFundo($("#idfundo").val());                    
                    registropropoiedadesFundo();
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succesfundo").html(msj);
                   $("#msj-infofundo").fadeIn();                   
                    document.location.reload();
                }
            },
            error:function(data)
            {
                $("#error_fundo").html('');$("#error_estadofundo").html('');$("#error_fecha").html('');
                $("#error_comite_local_id").html('');$("#error_direccionf").html('');                
                var errors =  $.parseJSON(data.responseText);                
                $.each(errors,function(index, value) {                      
                            if(index == 'fundo')$("#error_fundo").html(value);
                            else if(index == 'estadofundo')$("#error_estadofundo").html(value);
                            else if(index == 'fecha') $("#error_fecha").html(value);
                            else if(index == 'comite_local_id')$("#error_comite_local_id").html(value);
                            else if(index == 'direccion') $("#error_direccionf").html(value);                              
                      });                       
            }
          });
});

  
var EliminarFundo = function(id,name)
{ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/fundos/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
            document.location.reload();          
        }
      }
      });
        
  
    });
};


//  **************************   CRUD PARIENTE  ***********************************************************************************************

$("#RegPariente").click(function(event)
    {       
            var dni = $("#dni_1").val();
            var paterno = $("#paterno_1").val();
            var materno = $("#materno_1").val();
            
            var nombre = $("#nombre_1").val();
            var sexo;if( $("#sexof").is(':checked') )sexo = $("#sexof").val();
            else sexo = $("#sexom").val();                        
            var fec_nac = $("#fec_nac_1").val();
            var direccion = $("#direccion_1").val();            
            var telefono = $("#telefono_1").val();
            var comite_local = $("#comites_locales_id").val();
            var beneficiario;if( $("#beneficiariop").is(':checked') ) beneficiario = $("#beneficiariop").val();
            else beneficiario = $("#beneficiarios").val();             
            var codigo = $("#socios_codigo").val();                                    
            var grado_inst = $("#grado_inst_1").val();   
            var estado_civil = $("#estado_civil_1").val();
            var tipo_pariente = $("#tipo_pariente").val();
            var token = $("#token").val();
            var route = "/socios/parientes"; 
            var type = "POST";            
            if($("#RegPariente").text() == 'Actualizar')
            {
                route = "/socios/parientes/"+$("#idpariente").val();   
                type="PUt";
            }
          $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:type,
            datatype: 'json',
            data: {
                   dni: dni,
                   paterno: paterno,
                   materno: materno,
                   nombre: nombre,
                   sexo: sexo,
                   fec_nac: fec_nac,
                   direccion: direccion,                   
                   telefono: telefono,
                   comites_locales_id: comite_local,
                   socios_codigo: codigo,                                      
                   estado_civil: estado_civil,                   
                   grado_inst: grado_inst, 
                   tipo_pariente:tipo_pariente,
                   beneficiario:beneficiario
            },
            success:function(data)
            {                
                if(data.success == 'true')
                {                            
                   var msj = "<h4>"+data.message+"</h4>";
                   $("#succespariente").html(msj);
                   $("#msj-infopariente").fadeIn();
                   $("#formpariente")[0].reset();
                }
                else
                {
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succespariente").html(msj);
                   $("#msj-infopariente").fadeIn();                    
                }
            },
             error:function(data)
            {
                $("#error_dnip").html('');$("#error_estado_civil_1").html('');$("#error_paternop").html('');$("#error_maternop").html('');$("#error_Direccion_1").html('');
                $("#error_nombrep").html('');$("#error_fec_nac_1").html(''); $("#error_grado_inst_1").html('');$("#error_comite_local_1").html('');$("#error_pariente").html('');
                var errors =  $.parseJSON(data.responseText);                
                $.each(errors,function(index, value) {
                            if(index == 'dni')$("#error_dnip").html(value);                            
                            else if(index == 'estado_civil')$("#error_estado_civil_1").html(value);
                            else if(index == 'paterno') $("#error_paternop").html(value);
                            else if(index == 'materno')$("#error_maternop").html(value);
                            else if(index == 'nombre')$("#error_nombrep").html(value);
                            else if(index == 'fec_nac')$("#error_fec_nac_1").html(value);                            
                            else if(index == 'grado_inst')$("#error_grado_inst_1").html(value);
                            else if(index == 'comites_locales_id')$("#error_comite_local_1").html(value);
                            else if(index == 'direccion')$("#error_Direccion_1").html(value);
                            else if(index == 'tipo_pariente')$("#error_pariente").html(value);
                      });                       
            }
          })      
    }); 
    
$("#nuepariente").click(function (event){   
                   $("#succespariente").html("");
                   $("#msj-infopariente").fadeOut();
                   $("#formpariente")[0].reset();
});

var editPariente = function(idsocio,dnipariente)
    {
        $("#nuepariente").hide();
        $("#RegPariente").text("Actualizar");
        var route = "/socios/parientes/"+idsocio+"/"+dnipariente;
        $.get(route, function(data){
            $("#dni_1").val(data.dni);
            $("#dni_1").prop('disabled',true);
            if(data.sexo == 'M') { $("#sexom").prop('checked',true); $("#sexof").prop('checked',false); }
            else { $("#sexom").prop('checked',false); $("#sexof").prop('checked',true); }
            $("#tipo_pariente").val(data.tipo_pariente);
            $("#paterno_1").val(data.paterno);
            $("#materno_1").val(data.materno);
            $("#nombre_1").val(data.nombre);
            $("#fec_nac_1").val(data.fec_nac);
            $("#idpariente").val(data.id);            
            $("#departamento_1").val(data.departamentos_id);
            $("#provincia_1").empty();
            $("#provincia_1").append("<option value='" + data.provincias_id+"'>"+data.provincia+"</option>");
            $("#distrito_1").empty();
            $("#distrito_1").append("<option value='" + data.distritos_id+"'>"+data.distrito+"</option>");
            $("#comite_central_1").empty();
            $("#comite_central_1").append("<option value='" + data.comites_centrales_id+"'>"+data.comite_central+"</option>");
            $("#comites_locales_id").empty();
            $("#comites_locales_id").append("<option value='" + data.comites_locales_id+"'>"+data.comite_local+"</option>");            
            $("#grado_inst_1").val(data.grado_inst);
            $("#telefono_1").val(data.telefono);
            $("#estado_civil_1").val(data.estado_civil);
            $("#direccion_1").val(data.direccion);            
            if(data.beneficiario == 0) { $("#beneficiarios").prop('checked',true); $("#beneficiariop").prop('checked',false); }
            else { $("#beneficiariop").prop('checked',true); $("#beneficiarios").prop('checked',false); }            
        });
    }

//  ********************  CRUD SOCIOS   ********************************************************************************************************
$("#RegSocio").click(function(event)
    {                  
        var fields = $("#formsocios").serialize();                                       
            var token = $("#token").val();                       
            var route = "/socios";
            var type = 'post';                              
            if($("#RegSocio").text() == 'Actualizar')
            {               
                type = 'PUT';
                route=  "/socios/"+$("#codigo").val()+"";                
            }
          $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:type,
            datatype: 'json',
            //async: false,
            data: fields,
            success:function(data)
            {                
                if(data.success == 'true')
                {                            
                   var msj = "<h4>"+data.message+"</h4>";
                   $("#succes").html(msj);
                   $("#msj-info").fadeIn();
                    document.location.reload();
                }
            },
            error:function(data)
            {
                $("#error_codigo").html('');$("#error_dni").html('');$("#error_estado").html('');$("#error_estado_civil").html('');$("#error_paterno").html('');
                $("#error_materno").html('');$("#error_nombre").html('');$("#error_fec_nac").html('');$("#error_fec_empadron").html('');
                $("#error_fec_asociado").html('');$("#error_grado_inst").html('');$("#error_comite_local").html('');$("#error_direccion").html('');
                $("#error_direccion").html('');$("#error_produccion").html('');$("#error_ocupacion").html('');  
                var errors =  $.parseJSON(data.responseText);                
                $.each(errors,function(index, value) {                      
                            if(index == 'codigo')$("#error_codigo").html(value);
                            else if(index == 'dni')$("#error_dni").html(value);
                            else if(index == 'estado') $("#error_estado").html(value);
                            else if(index == 'estado_civil')$("#error_estado_civil").html(value);
                            else if(index == 'paterno') $("#error_paterno").html(value);
                            else if(index == 'materno')$("#error_materno").html(value);
                            else if(index == 'nombre')$("#error_nombre").html(value);
                            else if(index == 'fec_nac')$("#error_fec_nac").html(value);
                            else if(index == 'fec_empadron')$("#error_fec_empadron").html(value);
                            else if(index == 'fec_asociado')$("#error_fec_asociado").html(value);
                            else if(index == 'grado_inst')$("#error_grado_inst").html(value);
                            else if(index == 'comite_local')$("#error_comite_local").html(value);
                            else if(index == 'direccion')$("#error_direccion").html(value);
                            else if(index == 'produccion')$("#error_produccion").html(value);
                            else if(index == 'ocupacion')$("#error_ocupacion").html(value);                              
                      });                       
            }
          })      
    });    
    
   var EditSocio = function(codigo)
{     
    $("#RegSocio").text('Actualizar');
    $("#titulosocio").empty().append('<center>ACTUALIZAR DATO</center>');
    var route = "/socios/"+codigo+"/edit";    
    $.get(route, function(data){
//            alert(id);             
        $("#codigo").val(data.codigo);
        $("#dni").val(data.dni);
        $("#sexo").val(data.sexo);
        $("#estado").val(data.estado); 
        $("#estado_civil").val(data.estado_civil);         
        $("#paterno").val(data.paterno);
        $("#materno").val(data.materno);
        $("#nombre").val(data.nombre);
        
        $("#fec_nac").val(data.fec_nac);
        $("#fec_empadron").val(data.fec_empadron);
        $("#fec_asociado").val(data.fec_asociado);
        $("#telefono").val(data.telefono);    
        $("#grado_inst").val(data.grado_inst);
        
        $("#departamento").val(data.departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.provincias_id+"'>"+data.provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data.distritos_id+"'>"+data.distrito+"</option>");
        $("#comite_central").empty();
        $("#comite_central").append("<option value='" + data.comites_centrales_id+"'>"+data.comite_central+"</option>");
        $("#comite_local").empty();
        $("#comite_local").append("<option value='" + data.comites_locales_id+"'>"+data.comite_local+"</option>");
        $("#direccion").val(data.direccion);
        
        $("#produccion").val(data.produccion);                       
        $("#ocupacion").val(data.ocupacion);        
        $("#codigo").attr('disabled','disabled') ;
        $("#dni").prop( "disabled", true );
        });      
};


var EliSocio = function(codigo,name)
{ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/"+codigo+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
            document.location.reload();
        }
      }
      });
        
  
    });
};

//  *****************  CRUD FLORA  **********************************************************************************************************
$("#nuevaflora").click(function (event){ $("#RegFlora").text("Registrar");$("#error_flora").html('');});

$("#RegFlora").click(function(event)
    {                   
            var fields = $("#formflora").serialize();
            var token = $("#token").val();
            var route = "/socios/basicos/floras";    var type = "POST";
            if($("#RegFlora").text() == "Actualizar"){
                route = "/socios/basicos/floras/" + $("#idflora").val(); type = "PUT";
            }            
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type: type,
            datatype: 'json',
            data: fields,            
            success:function(data)
            {                         
                if(data.success == 'true')
                {            
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succesflora").html(msj);
                   $("#msj-infoflora").fadeIn();
                    document.location.reload();
                }
            },
            error:function(data)
            {
                $("#error_flora").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'flora')$("#error_flora").html(value);                                                    
                      });                                         
            }
          })      
    });  

var EdFlora = function(id) 
    {           
        $("#RegFlora").text("Actualizar");
        var route = "/socios/basicos/floras/"+id+"/edit";                
        $.get(route, function(data){              
        $("#idflora").val(data.id);
        $("#flora").val(data.flora);          
        });
    }
           
var EliFlora = function(id,name)
{ 
     // ALERT JQUERY        
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/basicos/floras/"+id+"";      
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
          document.location.href= '/socios/basicos/floras';
        }
      }
      });          
    });
};


// *******************   CRUD CARGO DELEGADO  ***************************************************************************************************
$("#nuevodelegado").click(function(event){ $("#RegDelegado").text("Registrar"); });

$("#RegDelegado").click(function(event){                   
            var fields = $("#formdelegado").serialize();
            var token = $("#token").val(); var type = "POST";
            var route = "/socios/basicos/delegados";    
            if($("#RegDelegado").text() == "Actualizar"){
                route = "/socios/basicos/delegados/"+$("#iddelegado").val(); 
                type="PUT";
            }            
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',
            //async: false,
//            data:dataSting,
            data: fields,            
            success:function(data)
            {                         
                if(data.success == 'true')
                {                         
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succesdelegado").html(msj);
                   $("#msj-infodelegado").fadeIn();
                    document.location.reload();
                }
            },
             error:function(data)
            {                
                $("#error_delegado").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'cargo_delegado')$("#error_delegado").html(value);                                                    
                      });          
                               
            }
             
          })      
    });  

var EdDelegado = function(id){         
        $("#RegDelegado").text("Actualizar");
        var route = "/socios/basicos/delegados/"+id+"/edit";                
        $.get(route, function(data){              
        $("#iddelegado").val(data.id);
        console.log($("#iddelegado").val());
        $("#cargo_delegado").val(data.cargo_delegado);          
        });
    }
        
var EliDelegado = function(id,name){      
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/basicos/delegados/"+id+"";      
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
          document.location.reload();
        }
      }
      });          
    });
};



//  ************************  CRUD DIRECTIVO   **********************************************************************************************

$("#nuevodirectivo").click(function(event){$("#RegDirectivo").text("Registrar"); });

$("#RegDirectivo").click(function(event) {                   
            var fields = $("#formdirectivos").serialize();
            var token = $("#token").val();var type = "POST";
            var route = "/socios/basicos/directivos";  
            if($("#RegDirectivo").text() == "Actualizar"){
                route = "/socios/basicos/directivos/" + $("#iddirectivo").val();
                type = "PUT";
            };
            console.log(fields);
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',
           
            data: fields,            
            success:function(data)
            {            
                
                if(data.success = 'true')
                {                         
                 var msj = "<h4>"+data.message+"</h4>";
                   $("#succesdirectivo").html(msj);
                   $("#msj-infodirectivo").fadeIn();
                    document.location.reload();
                }
            },
             error:function(data)
            {                      
                $("#error_directivo").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'cargo_directivo')$("#error_directivo").html(value);                                                    
                      });          
                               
            }
             
          });     
    });  

var EdDirectivo = function(id) 
    {              
        var route = "/socios/basicos/directivos/"+id+"/edit";
        $("#RegDirectivo").text("Actualizar");
        $.get(route, function(data){              
        $("#iddirectivo").val(data.id);
        $("#cargo_directivo").val(data.cargo_directivo);          
        });
    }
          
var EliDirectivo = function(id,name)
{ 
     // ALERT JQUERY        
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/basicos/directivos/"+id+"";      
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
          document.location.reload();
          
        }
      }
      });          
    });
};

//***********************************   DEPARTAMENTO  *********************************************************************************************
$("#nuevodepartamento").click(function(event){ $("#regdepartamento").text("Registrar");$("#error_departamento").html('');});

$("#regdepartamento").click(function(event){       
            var fields = $("#formdepartamento").serialize();
            var token = $("#token").val();
            var type = "POST";
            var route = "/socios/departamentos/";                        
            if($("#regdepartamento").text() == "Actualizar"){
                route = "/socios/departamentos/"+$("#iddepartamento").val();
                type = "PUT";
            }
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',           
            data: fields,            
            success:function(data)
            {                
                if(data.success == 'true')
                {                         
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succesdepartamento").html(msj);
                   $("#msj-infodepartamento").fadeIn();
                    document.location.reload();
                }
            },
             error:function(data)
            {
                $("#error_departamento").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'departamento')$("#error_departamento").html(value);                                                    
                      });          
                               
            }
             
          })      
    });  

    var btneditar = function(id){                
        $("#regdepartamento").text("Actualizar");
        var route = "/socios/departamentos/"+id+"/edit";
        $.get(route, function(data){
//            alert(id);        
        $("#iddepartamento").val(data.id);
        $("#departamento").val(data.departamento);        
        });
    };

 var Eliminar = function(id,name) {
     $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"
             +"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>")
             .then(function(){
                var route = "/socios/departamentos/" + id + "" ;
                var token = $("#token").val();
                $.ajax( { 
                   url: route,
                   headers: { 'X-CSRF-TOKEN':token},
                   type: 'DELETE',
                   datatype: 'json',
                   success: function(data)
                   {
                       if(data.success = 'true')
                       {
                           document.location.reload();
                       }
                   }
                });                             
            });
 }; 


// **************  CRUD PROVINCIAS   **************************************************************************************************************
$("#nuevaprovincia").click(function(event){ $("#RegProvincia").text("Registrar"); $("#error_provincia").html(''); $("#error_departamento").html(''); });

var EdProvincia = function(id) {        
              $("#RegProvincia").text("Actualizar"); 
        var route = "/socios/provincias/"+id+"/edit";
        $.get(route, function(data){
        $("#idprovincia").val(data.id);
        $("#provincia").val(data.provincia);
        $("#departamento").val(data.departamentos_id);
//        alert(data.departamentos_id)
        });
    }
    
$("#RegProvincia").click(function(event) {                               
            var fields = $("#formprovincia").serialize();                
            var token = $("#token").val();     
            var type = "POST";
            var route = "/socios/provincias/"; 
            if($("#RegProvincia").text() == "Actualizar"){
                type = "PUT"; route="/socios/provincias/"+$("#idprovincia").val();
            }
          $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:type,
            datatype: 'json',
            data: fields,
            success:function(data)
            {
               if(data.success == 'true')
                {                         
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succesprovincia").html(msj);
                   $("#msj-infoprovincia").fadeIn();
                    document.location.reload();
                }
            },
             error:function(data)
            {
                $("#error_provincia").html(''); $("#error_departamento").html('');
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'provincia')$("#error_provincia").html(value);
                            else if(index == 'departamento')$("#error_departamento").html(value); 
                      });          
                               
            }
             
          })      
    }); 
    
var EliProvincia = function(id,name){ 
     // ALERT JQUERY        
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/provincias/"+id+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
          document.location.reload();
        }
      }
      });          
    });
};


//   *********************   CRUD DE DISTRITOS  ********************************************************************************
$("#nuevodistrito").click(function(event){ $("#RegDistrito").text("Registrar");
    $("#error_provincia").html(''); $("#error_departamento").html('');$("#error_distrito").html('');});

$("#RegDistrito").click(function(event){       
            var fields = $("#formdistrito").serialize();          
            var type = "POST";
            var token = $("#token").val();            
            var route = "/socios/distritos";   
            if($("#RegDistrito").text() == "Actualizar"){
                route = "/socios/distritos/"+$("#iddistrito").val();
                type="PUT";
            }
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',
          
            data: fields,            
            success:function(data)
            {                         
                if(data.success == 'true')
                {                         
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succesdistrito").html(msj);
                   $("#msj-infodistrito").fadeIn();
                    document.location.reload();
                }
            },
             error:function(data)
            {
                $("#error_provincia").html(''); $("#error_departamento").html('');$("#error_distrito").html('');
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'provincia')$("#error_provincia").html(value);
                            else if(index == 'departamento')$("#error_departamento").html(value); 
                             else if(index == 'distrito')$("#error_distrito").html(value);
                      });                                         
            }
             
          })      
    });  

var EdDistrito = function(id) {
        $("#RegDistrito").text("Actualizar");
        var route = "/socios/distritos/"+id+"/edit";
        $.get(route, function(data){        
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.provincias_id+"'>"+data.provincia+"</option>");
        $("#iddistrito").val(data.id);          
        $("#distrito").val(data.distrito);        
        $("#departamento").val(data.departamentos_id);
        });
    }
 
var EliDistrito = function (id, name) {
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/distritos/"+id+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true'){
          document.location.reload();
        }
      }
      });          
    });
};

//  **************   CRUD COMITE CENTRAL  *****************************************************************************
$("#RegCentral").click(function(event)  {       
            var fields = $("#formcomite_central").serialize();
            
            var token = $("#token").val();
            var route = "/socios/comite-central"; 
            var type = "POST";
            if( $("#RegCentral").text() == "Actualizar" ){
                route = "/socios/comite-central/" + $("#idcomite_central").val();
                type="PUT";
            }                        
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',    
            data: fields,            
            success:function(data)
            {                         
                if(data.success == 'true')
                {                         
                    var msj = "<h4>"+data.message+"</h4>";
                   $("#succescentral").html(msj);
                   $("#msj-infocentral").fadeIn();
                    document.location.reload();
                }
            },
             error:function(data)
            {
                $("#error_provincia").html(''); $("#error_departamento").html('');$("#error_distrito").html('');$("#error_central").html('');
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'provincia')$("#error_provincia").html(value);
                            else if(index == 'departamento')$("#error_departamento").html(value); 
                             else if(index == 'distrito')$("#error_distrito").html(value);
                             else if(index == 'comite_central')$("#error_central").html(value);
                      });                                         
            }
             
          })      
    });  

var Edcentral = function(id) {
        $('#RegCentral').hide();
        $('#ActCentral').show();        
        var route = "/socios/comite-central/"+id+"/edit";                
        $.get(route, function(data){            
        $("#departamento").val(data[0].departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data[0].provincias_id+"'>"+data[0].provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data[0].distritos_id+"'>"+data[0].distrito+"</option>");
        $("#id").val(data[0].id);          
        $("#comite_central_1").val(data[0].comite_central);        
        
        });
    };
   
var EliCentral = function(id,name){ 
 
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/comite-central/"+id+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
          document.location.reload();
        }
      }
      });          
    });
};

// ******************  CRUD DE COMITE LOCAL  **********************************************************************
$("#nuevolocal").click(function(event){$("#RegLocal").text("Registrar");$("#error_provincia").html(''); $("#error_departamento").html('');$("#error_distrito").html('');$("#error_central").html('');
                $("#error_local").html('');});

$("#RegLocal").click(function(event){                   
            var fields = $("#formlocal").serialize();
            var type = "POST";
            var token = $("#token").val();
            var route = "/socios/comite-local";     
            if($("#RegLocal").text() == "Actualizar"){
                route = "/socios/comite-local/" + $("#idlocal").val();
                type = "PUT";
            }
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',           
            data: fields,            
            success:function(data)
            {                         
                if(data.success == 'true')
                {                         
                   var msj = "<h4>"+data.message+"</h4>";
                   $("#succeslocal").html(msj);
                   $("#msj-infolocal").fadeIn();
                   document.location.reload();
                }
            },
             error:function(data)
            {
                $("#error_provincia").html(''); $("#error_departamento").html('');$("#error_distrito").html('');$("#error_central").html('');
                $("#error_local").html('');
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'provincia')$("#error_provincia").html(value);
                            else if(index == 'departamento')$("#error_departamento").html(value); 
                             else if(index == 'distrito')$("#error_distrito").html(value);
                             else if(index == 'comite_central')$("#error_central").html(value);
                             else if(index == 'comite_local')$("#error_local").html(value);
                });                                         
            }             
          })      
    });  

var Edlocal = function(id) {
        $('#RegLocal').text("Actualizar");               
        var route = "/socios/comite-local/"+id+"/edit";                
        $.get(route, function(data){            
        $("#departamento").val(data.departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.provincias_id+"'>"+data.provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data[0].distritos_id+"'>"+data.distrito+"</option>");
        $("#comite_central").empty();
        $("#comite_central").append("<option value='" + data.comites_centrales_id+"'>"+data.comite_central+"</option>");
        $("#idlocal").val(data.id);          
        $("#comite_local").val(data.comite_local);                
        });
    }
  
var EliLocal = function(id,name){     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/socios/comite-local/"+id+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
          document.location.reload();
        }
      }
      });          
    });
};


//  ************************  CRUD TECNICOS  ********************************************************************************
var RegSectores = function(idempleado){
    var options = $("#zona_final option[value]");
    var route = "/RRHH/Tecnicos"; var token = $("#token").val();
      $.each(options,function( index, value ){
          $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                datatype: 'json',
                data: { comites_locales_id: value.value,
                    empleados_empleadoId:idempleado
                },
                success: function (data)
                {
                    if (data.success == 'true')
                    {
                        var msj = "<h4>" + data.message + "</h4>";
                        $("#succestecnicos").html(msj);
                        $("#msj-infotecnicos").fadeIn();
                        document.location.reload();
                    }
                },
            });          
      });
}

$("#RegTecnicos").click(function() {

        //elimina
      var fields = $("#formtecnicos").serialize();      
      var route = "/RRHH/Tecnicos/"+$("#tecnico").val()+"";
      var token = $("#token").val();      
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){ }
      });  
      RegSectores($("#tecnico").val());
    });
//var cargarForm = function(idform)
//{
//    var cadena = "@section('contentheader_title')Parientes y Beneficiario @stop";
//    if(idform == 1) var url="/socios/parientes";
//    
//    $.get(url,function(resul){
//        $("#titulo-content").empty();
//        $("#titulo-content").append("PARIENTES");
////        var tablinks = document.getElementsByid("linksocio");
////        for (i = 0; i < tablinks.length; i++) {
////        tablinks[i].className = tablinks[i].className.replace(" active", "");        
////        }
//      $("#main-content").html(resul);
////      evt.currentTarget.className += " active";
//    })
//    
//}


 
 