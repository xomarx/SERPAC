/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var temporal=0;
$(document).ready(function() {
    $('#myTable').DataTable( {        
        responsive: true,
        "language": {
            "url": "/js/Spanish.json",
        },        
    } );
} );


var department = function(event){        
    cargarprovincia(event.target.value,'provincia');
};

var cargarprovincia = function(iddepa,idselec) {
    var route = '/provincias/'+iddepa;       
    $.get(route,function(response){        
        $("#"+idselec).empty();
        $("#"+idselec).append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#"+idselec).append("<option value='" + response[i].id+"'>"+response[i].provincia+"</option>");
        }
    });
};

var province = function(){
    cargardistrito($("#provincia").val(),'distrito');
};

var cargardistrito = function (iddist,idsele) {
      var route = "/distritos/"+iddist + "";         
    $.get(route,function(response){          
        $("#"+idsele).empty();
        $("#"+idsele).append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#"+idsele).append("<option value='" + response[i].id+"'>"+response[i].distrito+"</option>");
        }
    }); 
 };
 
 var district = function(){
     cargarcomite_central($("#distrito").val(),'comite_central')
 };
 
  var cargarcomite_central = function (idcomitecentral,idselec) {
     var route = "/comites_centrales/"+ idcomitecentral; 
     $.get(route,function(response){           
        $("#"+idselec).empty();
        $("#"+idselec).append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#"+idselec).append("<option value='" + response[i].id+"'>"+response[i].comite_central+"</option>");
        }
    }); 
 };
 
 var central_committe = function(){
     cargarComitelocal($("#comite_central").val(),'comite_local');
 };
 
 var cargarComitelocal = function (idcomitelocal,idselec) {
     var route = "/comite_locales/"+idcomitelocal;        
    $.get(route,function(response){        
        $("#"+idselec).empty();
        $("#"+idselec).append("<option value=''>Seleccione</option>");
        for (var i = 0; i < response.length; i++) {            
            $("#"+idselec).append("<option value='" + response[i].id+"'>"+response[i].comite_local+"</option>");
        }
    }); 
 };

//  recepcion de fondo          
    var meses = function(anio){  
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre");
        var cont = 12;
        if(anio == (new Date).getFullYear()){
            cont = (new Date).getMonth() + 1;
        }
        var htm='<option value=0>Todo los Meses</option>';
        for(var i = 1;i <= cont ; i++){
                htm +='<option value='+i+'>'+meses[i-1]+'</option>';
            }
        $("#mes").html(htm);            
    };
    
    $(document).ready().on('click','.pagination li a',function(e){        
     e.preventDefault();
     var url = $(this).attr('href');   
     
     $.ajax({
        type:'get',
        url:url,
        success:function(data){            
            $("#contenidos-box").empty().html(data);
        }
     });
  });
  
  function soloNumeros(e){ 
    var key = window.Event ? e.which : e.keyCode 
    return ((key >= 48 && key <= 57) || (key==8))
}
  
var activarForm = function(id){
//        if(id == 1) {var route = '/Usuario/RolHead'}        
        if(id == 2) {var route = 'headPermisos';}
        else if(id == 3) {var route = 'Caja-Chica/'+$("#anioc").val()+'/'+$("#mesc").val()+'/'+$("#buscarc").val();}
        else if(id == 4) {var route = 'ListMovcheques/'+$("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();}
        else if(id == 5) {var route = 'ListUsuarios';}
        else if(id == 6) {var route = '/Socios/fundos/Listfundos/'+$("#buscar").val();}
        else if(id == 7) {var route = 'ListaPlanillaSemanal';}
        else if(id == 8) {var route = 'listaRecepcionFondos/'+$("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();}
        else if(id == 9) {var route = 'ListaDistribucion/'+$("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();}
        else if(id == 10) {var route = '/Acopio/Compra-Grano/ListaCompras/'+$("#buscar").val();}
        else if(id == 11) {var route = '/Acopio/Planilla-Semanal/ListaSemanal';}
        else if(id == 12) {var route = 'ListaCheques/'+$("#buscar").val();}
        else if(id == 13) {var route = '/Tesoreria/Mov-Dinero/Con-Documento';}        
        else if(id == 14) {var route = '/Tesoreria/Mov-Caja-Chica/Crear-Caja';}
        else if(id == 15) {var route = '/Socios/Socios/ListaSocios/'+$("#buscar").val();}
        else if(id == 16) {var route = '/Socios/parientes/ListaParientes/'+$("#buscar").val();}
        else if(id == 17) {var route = '/Socios/Asignacion-Delegados/ListaAsigDelegados/'+$("#buscar").val();}
        else if(id == 18) {var route = '/Socios/Asignacion-Directivos/ListaAsigDirectivos/'+$("#buscar").val();}
        else if(id == 19) {var route = '/RRHH/Empresas/ListaEmpresa';}
        else if(id == 20) {var route = '/RRHH/Sucursal/SucursalList/'+$("#buscar").val();}
        $.ajax({
            type:'get',
            url:route,
            success:function(data){                
                $("#contenidos-box").html(data);                
            }            
        })
    };
    
var activarFormHead = function(head,body){
    if(head==1) { var route = 'headmovcheque'; }
    else if(head==2) { var route = 'headcajachica'; }       
    $.ajax({
       type:'get' ,
       url:route,
       success: function(data){ 
           var tem = '<div class="box box-body" id="contenidos-box"></div>';
           $("#conten-box").html(data+tem);
            activarForm(body);
       }
    });
    
}

var activarmodal = function(id){        
        
        if(id==1){ var route = 'RolUsuario';}
        else if(id==2){ var route = 'PermisoUser';}
        else if(id==3){ var route = 'modalcheque';}
        else if(id==4){ var route = '/Tesoreria/modalmovcheque';}
        else if(id==5){ var route = 'Mov-Caja-Chica/modalCaja';}
        else if(id==6){ var route = '/Socios/Socios/modalsocio';}
        else if(id==0){ var route = '/error-403';}
        else if(id==7){ var route = 'modalempleado';} 
        else if(id==8){ var route = 'Mov-Dinero/Modal-Dinero';} 
        else if(id==9){ var route = '/Acopio/Adelantos-Acopio/Modal-Adelanto';} 
        else if(id==10){ var route = 'Empleados/Amonestacion';}
        else if(id==11){ var route = '/Auxiliar/Persona';}
        else if(id==12){ var route = 'AlmacenModal';}
            
        $.get(route,function(data){            
            $("#conten-modal").empty().html(data);
            $(".select2").select2();
            $("#modal-form").modal();
        });
    };
    
var mensajeRegistro = function(data,formu){
    $("#alert-msj").fadeIn();
              if(data.success){
                $("#alert-msj").removeClass('alert-danger');
                  $("#alert-msj").addClass('alert-success');
                $("#alert-txt").html(data.message);                
                $("#"+formu)[0].reset();
                var tiempo = 2000;
              }
              else{
                  $("#alert-msj").removeClass('alert-success');
                  $("#alert-msj").addClass('alert-danger');
                  $("#alert-txt").html(data.message);   
                  tiempo = 7000;
              }
              $("#alert-msj").fadeOut(tiempo);
};

$(document).ready().on('keyup','#dni',function(event){      
    if(event.keyCode == 13){//enter        
        if($("#dni").val().length < 8)
            $.alertable.alert("Faltan digitos");
        $.ajax({
            url:'/auxiliar/DNIpersonas/'+event.target.value,
            type:'GET',
            datatype: 'json',
            success:function(data){
                $("#paterno").val(data.paterno);
                $("#nombre").val(data.nombre);
                $("#materno").val(data.materno);
//                $("#datos").val(data.paterno+ ' ' + data.materno + ' ' + data.nombre);
            }
        });
        
//        var next = document.getElementById("dni").tabIndex;
//        next++;
//        console.log(next)        
//        document.forms[0].elements[2].focus(); 
        
    }            
});
//  ******************************************************************  CRUD SOCIOS   *******************************************************************
$("#nuevosocio").click(function (){    
    activarmodal(6);                   
});

$(document).ready().on('click','#Regsocio',function(){
            var options = $("#condicion option:selected");
            var route = "/Socios/Socios";
            var type = 'post';      
            var cod = $("#codigo").val();
            if($("#Regsocio").text() == 'Actualizar')
            {               
                type = 'PUT';
                route=  "/Socios/Socios/"+$("#codigo").val()+"";                
            }
          $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':$("input[name=_token]").val()},            
            type:type,
            datatype: 'json',
            data: $("#formsocios").serialize(),
            success:function(data)
            {                
                mensajeRegistro(data,'formsocios');
                limpiarCondicion(cod);
                $.each(options,function( index, value ){                    
                $.ajax({
                          url: '/Socios/Socios/Condicions-socios',
                          headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
                          type: 'post',
                          datatype: 'json',
                          data: { 
                              condicions_id: value.value,
                              socios_codigo:cod
                          },
                          success: function (data)
                          {       
                              activarForm(15);
                          },
                          error:function(data){                              
                          }
                      });          
                });
                
            },
            error:function(data){
                if(data.status == 403)                    
                    $("#error-modal").html(data.responseText);
                else {
                $("#error_codigo").html('');$("#error_dni").html('');$("#error_estado").html('');$("#error_estado_civil").html('');$("#error_paterno").html('');
                $("#error_materno").html('');$("#error_nombre").html('');$("#error_fec_nac").html('');$("#error_fec_empadron").html('');
                $("#error_fec_asociado").html('');$("#error_grado_inst").html('');$("#error_comite_local").html('');$("#error_direccion").html('');
                $("#error_direccion").html('');$("#error_produccion").html('');$("#error_ocupacion").html('');  $("#error_sexo").html('');
                $("#error-condicion").html('');$("#error-local").html('');$("#error-central").html('');$("#error-departamento").html('');$("#error-provincia").html('');
                $("#error-distrito").html('');
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
                            else if(index == 'comite_local')$("#error-local").html(value);
                            else if(index == 'comite_central')$("#error-central").html(value);
                            else if(index == 'departamento')$("#error-departamento").html(value);
                            else if(index == 'provincia')$("#error-provincia").html(value);
                            else if(index == 'distrito')$("#error-distrito").html(value);
                            else if(index == 'direccion')$("#error_direccion").html(value);
                            else if(index == 'produccion')$("#error_produccion").html(value);
                            else if(index == 'ocupacion')$("#error_ocupacion").html(value);
                            else if(index == 'sexo')$("#error_sexo").html(value);
                            else if(index == 'condicion')$("#error-condicion").html(value);
                      });                       
            }}
          })
});

var limpiarCondicion = function(idsocio){
    $.ajax({
            url: '/Socios/Socios/Condicions-socios/'+idsocio,
            headers: {'X-CSRF-TOKEN':$("input[name=_token]").val()},
            type: 'delete',
            datatype: 'json',                          
                success: function (data)
                {                                  
                },
                error:function(data){                              
                }
            });          
}
      
      
var EditSocio = function(codigo){     
        
    var route = '/Socios/Socios/modalsocio';
        $.get(route,function(data){            
            $("#conten-modal").empty().html(data);
            $(".select2").select2();
            
            $.getJSON("/Socios/Socios/"+codigo+"/edit", function(data){
        $("#Regsocio").text('Actualizar');        
        $("#titulosocio").empty().append('<center>ACTUALIZAR DATO</center>');
        $("#codigo").val(data.socio.codigo);
        $("#dni").val(data.socio.dni);
        if(data.socio.sexo == 'M') $("#sexoM").prop("checked",true);
        else if(data.socio.sexo == 'F') $("#sexoF").prop("checked",true);        
        $("#estado").val(data.socio.estado); 
        $("#estado_civil").val(data.socio.estado_civil);         
        $("#paterno").val(data.socio.paterno);
        $("#materno").val(data.socio.materno);
        $("#nombre").val(data.socio.nombre);
        
        $("#fec_nac").val(data.socio.fec_nac);
        $("#fec_empadron").val(data.socio.fec_empadron);
        $("#fec_asociado").val(data.socio.fec_asociado);
        $("#telefono").val(data.socio.telefono);    
        $("#grado_inst").val(data.socio.grado_inst);
        
        $("#departamento").val(data.socio.departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.socio.provincias_id+"'>"+data.socio.provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data.socio.distritos_id+"'>"+data.socio.distrito+"</option>");
        $("#comite_central").empty();
        $("#comite_central").append("<option value='" + data.socio.comites_centrales_id+"'>"+data.socio.comite_central+"</option>");
        $("#comite_local").empty();
        $("#comite_local").append("<option value='" + data.socio.comites_locales_id+"'>"+data.socio.comite_local+"</option>");
        $("#direccion").val(data.socio.direccion);
        
        $("#produccion").val(data.socio.produccion);                       
        $("#ocupacion").val(data.socio.ocupacion);        
        $("#codigo").attr('disabled','disabled') ;
        $("#dni").prop( "disabled", true );
        var valor = [];
        $.each(data.condicions,function( index,value){           
            valor.push(value.condicions_id);           
        });        
        $("#condicion").val(valor);
        $("#modal-form").modal();
        $(".select2").select2();
        }); 
            
            
            $("#modal-form").modal();
        });
         
};

var EliSocio = function(codigo,name){      
               
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Socios/Socios/"+codigo+"";      
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){           
        if (data.success){ activarForm(15);}
        else
            $.alertable.alert("<h4>No se puede eliminar al Socio: "+name+" <br> Cuenta con Registros</h4>");
        
      },
      error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
      });
        
  
    });
};

//  **********************************************************   CRUD PARIENTE  ***************************************************************************

var RegPariente = function(){       
        
            var fields = $("#formpariente").serialize();
            var token = $("input[name=_token]").val();
            var route = "/Socios/parientes"; 
            var type = "POST";            
            if($("#Regpariente").text() == 'Actualizar')
            {
                route = "/Socios/parientes/"+$("#idpariente").val();   
                type="PUt";
            }            
          $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:type,
            datatype: 'json',
            data: fields,
            success:function(data)
            {    
               mensajeRegistro(data,'formpariente');
               if($("#Regpariente").text() == 'Actualizar') activarForm(16);
            },
             error:function(data)
            {
                if(data.status == 403)
                    $("#error-modal").html(data.responseText);
                else{
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
                            else if(index == 'comite_local')$("#error_comite_local_1").html(value);
                            else if(index == 'direccion')$("#error_Direccion_1").html(value);
                            else if(index == 'tipo_pariente')$("#error_pariente").html(value);
                      });                       
            }
            }
          })      
    }; 

var editPariente = function(idsocio,dnipariente){
    
    var route = '/Socios/modalparientes';
    $.get(route, function (data) {
        $("#conten-modal").html(data);
        $("#titulo").empty();
        $("#titulo").append('PARIENTES DE ' + idsocio);
        $("#socios_codigo").val(idsocio);

        var ruta = "/Socios/parientes/" + idsocio + "/" + dnipariente;
        $.getJSON(ruta, function (data) {            
            $("#dni").val(data.dni);
            $("#dni").prop('disabled', true);
            if (data.sexo == 'M') {
                $("#sexom").prop('checked', true);
                $("#sexof").prop('checked', false);
            } else {
                $("#sexom").prop('checked', false);
                $("#sexof").prop('checked', true);
            }
            $("#tipo_pariente").val(data.tipo_pariente);
            $("#paterno").val(data.paterno);
            $("#materno").val(data.materno);
            $("#nombre").val(data.nombre);
            $("#fec_nac").val(data.fec_nac);
            $("#idpariente").val(data.id);
            $("#departamento").val(data.departamentos_id);
            $("#provincia").empty();
            $("#provincia").append("<option value='" + data.provincias_id + "'>" + data.provincia + "</option>");
            $("#distrito").empty();
            $("#distrito").append("<option value='" + data.distritos_id + "'>" + data.distrito + "</option>");
            $("#comite_central").empty();
            $("#comite_central").append("<option value='" + data.comites_centrales_id + "'>" + data.comite_central + "</option>");
            $("#comite_local").empty();
            $("#comite_local").append("<option value='" + data.comites_locales_id + "'>" + data.comite_local + "</option>");
            $("#grado_inst").val(data.grado_inst);
            $("#telefono").val(data.telefono);
            $("#estado_civil").val(data.estado_civil);
            $("#direccion").val(data.direccion);
            $("#Regpariente").text("Actualizar");
            if (data.beneficiario == 0) {
                $("#beneficiarios").prop('checked', true);
                $("#beneficiariop").prop('checked', false);
            } else {
                $("#beneficiariop").prop('checked', true);
                $("#beneficiarios").prop('checked', false);
            }
        });
        $("#modal-form").modal();
    });
};
    
var ElimPariente = function(dni,codsocio){
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"
            +dni+"</span></strong></br>").then(function() {  
      var route = "/Socios/parientes/"+dni+"/"+codsocio;
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success) activarForm(16);        
        else
            $.alertable.alert("<h4>No se puede eliminar al Registro del DNI: "+dni+" <br> Cuenta con Registros</h4>");                
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });
        
  
    });
};
    
// *****************************************************************************  CRUD FUNDOS  *********************************************************
   
    var Eliminarcultivo = function(fila,idcultivo) {        
        var valor=document.getElementById("tablacultivos").rows[fila].cells[0].innerText;            
        document.getElementById('tablacultivos').deleteRow(fila);
        $("#flora").append("<option value="+idcultivo+" selected='selected'>"+ valor+"</option>")
    };
           
    var Eliminarfauna = function(fila,idfauna) {
        var valor=document.getElementById("tablafauna").rows[fila].cells[0].innerText;            
        document.getElementById('tablafauna').deleteRow(fila);
        $("#fauna").append("<option value="+idfauna+" selected='selected'>"+ valor+"</option>")
    }
       
var Eliminarinmueble = function(fila,idinmueble){
        var valor=document.getElementById("tablainmueble").rows[fila].cells[0].innerText;            
        document.getElementById('tablainmueble').deleteRow(fila);
        $("#inmueble").append("<option value="+idinmueble+" selected='selected'>"+ valor+"</option>")
    }

function fundopropiedadFauna(fundo,fauna,cantidad,rendimiento){      
    var route = '/Socios/propiedadfauna';
    var token = $("input[name=_token]").val();
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
            },            
          });
};

function fundopropiedadFlora(fundo,flora,hectarea,rendimiento) {            
    var route = '/Socios/propiedadflora';    
    var token = $("input[name=_token]").val();
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
            },            
          });
};

function fundopropiedadInmueble(fundo,inmueble){    
    var route = '/Socios/propiedadinmueble';    
    var token = $("input[name=_token]").val();
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
            },            
          });
};

 function registropropoiedadesFundo(){
   
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
    if(idfundo!=''){
    var route = "/Socios/eliminarpropiedades/" + idfundo + "";
    var token = $("input[name=_token]").val();
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function (data) {            
        }
    });}
}

$(document).ready().on('click','#Regfundo',function(event){
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
    var route = '/Socios/fundos';
    var fields = $("#formfundo").serialize();    
    if($("#Regfundo").text() == "ACTUALIZAR")  {
        type = "PUT";
        route = "/Socios/fundos/"+$("#idfundo").val();        
    }         
    $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':$("input[name=_token]").val()},            
            type:type,
            datatype: 'json',
            //async: false,
            data: fields,
            success:function(data)
            {                                                              
                limpiarPropiedadesFundo($("#idfundo").val());
                registropropoiedadesFundo();
                if($("#Regfundo").text() == "ACTUALIZAR"){ activarForm(6);  } 
                mensajeRegistro(data,'formfundo');
                if(data.success){
                    $("#modal-form").fadeOut(3000);
                }
            },
            error:function(data)
            {
                if(data.status == 403)
                    $("#error-modal").html(data.responseText);
                else{
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
            }
          });
});

 
var EliminarFundo = function(id,name){ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"
           +name+"</span></strong></br>").then(function() {  
      var route = "/socios/fundos/"+id+"";
      var token = $("input[name=_token]").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success) document.location.reload();                  
      },
      error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
      });
        
  
    });
};

      
      //****************************************************************************        TRANSFERENCIAS ********************************************
      
      
      
$("#nuevatrans").click(function(){
    if($("#nuevatrans").text() == "LISTA TRANSFERENCIA") document.location.reload();
    else {
        var route = 'transferencias/newtransferencias';
        $.ajax({
            type:'get',
            url:route,
            success:function(data){                
                $("#contenidos-box").html(data);   
                $("#nuevatrans").text("LISTA TRANSFERENCIA"); 
                autocompletes();
            }            
        })
        
    }
});
      
var RegTransferencia = function (){                       
            var token = $("input[name=_token]").val();                       
            var route = "/Socios/transferencias";             
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'post',
            datatype: 'json',            
            data: $("#formtransferencia").serialize(),
            success:function(data)
            {
                mensajeRegistro(data,'formtransferencia');
                if(data.success) document.location.reload();//activarForm(6);                
            },
            error:function(data)
            {                
                if(data.status == 403)
                    $("#contenidos-box").html(data.responseText);
                else{
                    $("#error-codigo").html('');$("#error-dni_socio").html('');$("#error-motivo").html('');
                    $("#error-socio").html('');$("#error-dni_nuevo_socio").html('');$("#error-dni_beneficiario").html('');
                    var errors =  $.parseJSON(data.responseText);                
                    $.each(errors,function(index, value) {
                            if(index == 'codigo')$("#error-codigo").html(value);                            
                            else if(index == 'dni_socio')$("#error-dni_socio").html(value);
                            else if(index == 'motivo') $("#error-motivo").html(value);
                            else if(index == 'socio')$("#error-socio").html(value);
                            else if(index == 'dni_nuevo_socio')$("#error-dni_nuevo_socio").html(value);
                            else if(index == 'dni_beneficiario')$("#error-dni_beneficiario").html(value);
                      });
                }
            }  
          })
};

//  *************************************************************************************************   CRUD CARGOS  *************************************
$("#nuevocargos").click(function(){
    $("#RegCargo").text("Registrar");
});

var EdiCargo = function(id) {      
        var route = "/RRHH/Cargos/"+id+"/edit";
        $.getJSON(route, function(data){
//            alert(id);
        $("#idcargo").val(id);
        $("#cargo").val(data.cargo);
        $("#RegCargo").text("Actualizar");
        });
    };
                   
$("#RegCargo").click(function(){    
  var cargo = $("#cargo").val();
  var route = "/RRHH/Cargos";var type = "POST"
  var token = $("input[name=_token]").val();
    if($("#RegCargo").text() == "Actualizar"){
        route = "/RRHH/Cargos/"+$("#idcargo").val();
        type = "PUT";
    }
  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: type,
    dataType: 'json',
    data: {cargo: cargo},
    success: function(data){
        mensajeRegistro(data,'formcargos');
        document.location.reload();           
   },
    error:function(data)
    {        
        if(data.status==403)activarmodal(0);
        else{
            $("#error-cargo").empty();
            var errors = $.parseJSON(data.responseText);
                $.each(errors, function (index, value) {
                    if (index == 'cargo')
                        $("#error-cargo").html(value);
                });
        }
    }  
  });
});   
   
var EliCArgo = function(id,name){ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/RRHH/Cargos/"+id+"";
      var token = $("input[name=_token]").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success )        
            document.location.reload();
      },
      error:function(data){
          console.log(data);
          if(data.status==403)
                    activarmodal(0);
      }
      });
        
  
    });
};

// **************************************************************************************************  CRUD AREAS ***************************************

$("#nuevaarea").click(function (){
    $("#RegArea").text('Registrar');$("#area").val('');
});

$("#RegArea").click(function(event){       
            var area = $("#area").val();
            var token = $("input[name=_token]").val();
            var route = "/RRHH/Area"; var type = "POST";
            if($("#RegArea").text() == "Actualizar")
            {   
                route = "/RRHH/Area/" + $("#idarea").val();
                type = "PUT";
            }            
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',
            data: {area: area},
            success:function(data)
            {
                if(data.success) document.location.reload();                
            }, 
            error: function(data){
                if(data.status==403) activarmodal(0);
                else{                
                    $("#error-area").empty();                    
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function (index, value) {
                    if (index == 'area')
                        $("#error-area").html(value);
                });
            }
            }
          })
    });  

var EdiArea = function(id) {                
        var route = "/RRHH/Area/"+id+"/edit";
        $("#RegArea").text("Actualizar");
        $.getJSON(route, function(data){
            $("#idarea").val(data.id);
            $("#area").val(data.area);        
        });
    };
      
var EliArea = function(id,name){      
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/RRHH/Area/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success) document.location.reload();        
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
};

// ******************************************************************************  CRUD FAUNA  ********************************************************
$("#nuefauna").click(function(event){$("#RegFauna").text("Registrar");});

$("#RegFauna").click(function (event) {
    var fields = $("#formfauna").serialize();
    var token = $("input[name=_token]").val();
    var type = "POST";
    var route = "/Socios/basicos/faunas";
    if ($("#RegFauna").text() == "Actualizar")
    {
        route = "/Socios/basicos/faunas/" + $("#idfauna").val();
        type = "PUT";
    }

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: type,
        datatype: 'json',
        //async: false,
        data: fields,
        success: function (data)
        {
            mensajeRegistro(data, 'formfauna');
            document.location.reload();

        },
        error: function (data)
        {
            if (data.status == 403)
                activarmodal(0);
            else {
                $("#error_fauna").html('');
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function (index, value) {
                    if (index == 'fauna')
                        $("#error_fauna").html(value);
                });
            }
        }
    })
});  

var EditFauna = function(id) {                
        $("#RegFauna").text("Actualizar");
        var route = "/Socios/basicos/faunas/"+id+"/edit";                
        $.get(route, function(data){   
        $("#idfauna").val(data.id);
        $("#fauna").val(data.fauna);          
        });
    }
          
var EliFauna = function(id,name){ 
     // ALERT JQUERY        
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Socios/basicos/faunas/"+id+"";      
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)
        
          document.location.reload();
        
      },
      error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
      });          
    });
};

//  *******************************************************************************   CRUD INMUEBLE  ***************************************************

$("#RegInmueble").click(function(event){                   
            var fields = $("#forminmueble").serialize();
            var token = $("input[name=_token]").val();
            var route = "/Socios/basicos/inmuebles";     
            var type = "POST";
            if($("#RegInmueble").text() == "Actualizar")
            {
                route = "/Socios/basicos/inmuebles/" + $("#idinmueble").val();
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
                    mensajeRegistro(data,'forminmueble');
                    document.location.reload();
                
            },
            error:function(data)
            {
                if(data.status==403)
                    activarmodal(0);
                else{
                $("#error_inmueble").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'inmueble')$("#error_inmueble").html(value);                                                    
                      });          
                  }            
            }
          })      
    });  

var EdInmueble = function(id){              
        var route = "/Socios/basicos/inmuebles/"+id+"/edit";                
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
      var route = "/Socios/basicos/inmuebles/"+id+"";      
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)        
          document.location.reload();        
      },
      error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
      });          
    });
};

//  ***************************************************************************  CRUD FLORA  ***********************************************************
$("#nuevaflora").click(function (event){ $("#RegFlora").text("Registrar");$("#error_flora").html('');});

$("#RegFlora").click(function(event){                   
            var fields = $("#formflora").serialize();
            var token = $("input[name=_token]").val();
            var route = "/Socios/basicos/floras";    var type = "POST";
            if($("#RegFlora").text() == "Actualizar"){
                route = "/Socios/basicos/floras/" + $("#idflora").val(); type = "PUT";
            }            
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type: type,
            datatype: 'json',
            data: fields,            
            success:function(data)
            {                         
                mensajeRegistro(data,'formflora');
                    document.location.reload();
                
            },
            error:function(data)
            {
                if(data.status==403)
                    activarmodal(0);
                else {
                $("#error_flora").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'flora')$("#error_flora").html(value);                                                    
                      });                                         
            }
        }
          })      
    });  

var EdFlora = function(id){           
        $("#RegFlora").text("Actualizar");
        var route = "/Socios/basicos/floras/"+id+"/edit";                
        $.get(route, function(data){              
        $("#idflora").val(data.id);
        $("#flora").val(data.flora);          
        });
    }
           
var EliFlora = function(id,name){ 
     // ALERT JQUERY        
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Socios/basicos/floras/"+id+"";      
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)        
          document.location.reload();
        
      },
      error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
      });          
    });
};

// ***********************************************************************   CRUD CARGO DELEGADO  ******************************************************
$("#nuevodelegado").click(function(event){ $("#RegDelegado").text("Registrar"); });

$("#RegDelegado").click(function(event){
    
            var fields = $("#formdelegados").serialize();
            var token = $("input[name=_token]").val(); 
            var type = "POST";
            var route = "/Socios/basicos/delegados";    
            if($("#RegDelegado").text() == "Actualizar"){
                route = "/Socios/basicos/delegados/"+$("#iddelegado").val(); 
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
                    mensajeRegistro(data,'formdelegados')
                    document.location.reload();                
            },
             error:function(data)
            {    
                if(data.status== 403)
                    $("#contenidos-box").html(data.responseText);
                else{
                $("#error_delegado").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'cargo_delegado')$("#error_delegado").html(value);                                                    
                      });          
                  }          
            }
             
          })      
    });  

var EdDelegado = function(id){         
        $("#RegDelegado").text("Actualizar");
        var route = "/Socios/basicos/delegados/"+id+"/edit";                
        $.get(route, function(data){              
        $("#iddelegado").val(data.id);        
        $("#cargo_delegado").val(data.cargo_delegado);          
        });
    }
        
var EliDelegado = function(id,name){      
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Socios/basicos/delegados/"+id+"";      
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)
        
          document.location.reload();
        
      },
      error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
      });          
    });
};

//  ************************************************************************  CRUD DIRECTIVO   *********************************************************

$("#nuevodirectivo").click(function(event){$("#RegDirectivo").text("Registrar"); });

$("#RegDirectivo").click(function(event) {                   
            var fields = $("#formdirectivos").serialize();
            var token = $("input[name=_token]").val();var type = "POST";
            var route = "/Socios/basicos/directivos";  
            if($("#RegDirectivo").text() == "Actualizar"){
                route = "/Socios/basicos/directivos/" + $("#iddirectivo").val();
                type = "PUT";
            };
            
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',
           
            data: fields,            
            success:function(data)
            {                            
                mensajeRegistro(data,'formdirectivos')
                document.location.reload();                
            },
             error:function(data){                      
                 if(data.status==403)
                    activarmodal(0);
                 else{
                $("#error_directivo").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'cargo_directivo')$("#error_directivo").html(value);                                                    
                      });          
                  }          
            }
             
          });     
    });  

var EdDirectivo = function(id){              
        var route = "/Socios/basicos/directivos/"+id+"/edit";
        $("#RegDirectivo").text("Actualizar");
        $.get(route, function(data){              
        $("#iddirectivo").val(data.id);
        $("#cargo_directivo").val(data.cargo_directivo);          
        });
    }
          
var EliDirectivo = function(id,name){      
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Socios/basicos/directivos/"+id+"";      
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)        
          document.location.reload();                  
      },
      error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
      });          
    });
};

//**************************************************************************************   DEPARTAMENTO  ***********************************************
$("#nuevodepartamento").click(function(event){ $("#regdepartamento").text("Registrar");$("#error_departamento").html('');});

$("#regdepartamento").click(function(event){       
            var fields = $("#formdepartamento").serialize();
            var token = $("input[name=_token]").val();
            var type = "POST";
            var route = "/Socios/departamentos/";                        
            if($("#regdepartamento").text() == "Actualizar"){
                route = "/Socios/departamentos/"+$("#iddepartamento").val();
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
                    mensajeRegistro(data,'formdepartamento')
                    document.location.reload();                
            },
             error:function(data)
            {
                if(data.status==403)
                    activarmodal(0);
                else{
                $("#error_departamento").html('');                  
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'departamento')$("#error_departamento").html(value);                                                    
                      });          
                  }              
            }
             
          })      
    });  

    var btneditar = function(id){                
        $("#regdepartamento").text("Actualizar");
        var route = "/Socios/departamentos/"+id+"/edit";
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
                var route = "/Socios/departamentos/" + id + "" ;
                var token = $("input[name=_token]").val();
                $.ajax( { 
                   url: route,
                   headers: { 'X-CSRF-TOKEN':token},
                   type: 'DELETE',
                   datatype: 'json',
                   success: function(data)
                   {
                       if(data.success)
                       
                           document.location.reload();
                       
                   },
                   error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
                });                             
            });
 }; 


// ****************************************************************************  CRUD PROVINCIAS   ******************************************************
$("#nuevaprovincia").click(function(event){ $("#RegProvincia").text("Registrar"); 
    $("#error_provincia").html(''); $("#error_departamento").html(''); });

var EdProvincia = function(id) {        
              $("#RegProvincia").text("Actualizar"); 
        var route = "/Socios/provincias/"+id+"/edit";
        $.get(route, function(data){
        $("#idprovincia").val(data.id);
        $("#provincia").val(data.provincia);
        $("#departamento").val(data.departamentos_id);
//        alert(data.departamentos_id)
        });
    }
    
$("#RegProvincia").click(function(event) {                               
            var fields = $("#formprovincia").serialize();                
            var token = $("input[name=_token]").val();
            var type = "POST";
            var route = "/Socios/provincias/"; 
            if($("#RegProvincia").text() == "Actualizar"){
                type = "PUT"; route="/Socios/provincias/"+$("#idprovincia").val();
            }
          $.ajax({              
            url:route,            
            headers:{'X-CSRF-TOKEN':token},            
            type:type,
            datatype: 'json',
            data: fields,
            success:function(data)
            {
               mensajeRegistro(data,'formprovincia');
                    document.location.reload();                
            },
             error:function(data)
            {
                if(data.status==403)
                    activarmodal(0);
                else{
                $("#error_provincia").html(''); $("#error_departamento").html('');
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'provincia')$("#error_provincia").html(value);
                            else if(index == 'departamento')$("#error_departamento").html(value); 
                      });          
                  }               
            }
             
          })      
    }); 
    
var EliProvincia = function(id,name){ 
     // ALERT JQUERY        
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Socios/provincias/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)        
          document.location.reload();        
      },
      error:function(data){
          if(data.status==403)
                    activarmodal(0);
      }
      });          
    });
};

//   *************************************************************************************   CRUD DE DISTRITOS  *****************************************
$("#nuevodistrito").click(function(event){ $("#RegDistrito").text("Registrar");
    $("#error_provincia").html(''); $("#error_departamento").html('');$("#error_distrito").html('');});

$("#RegDistrito").click(function(event){       
            var fields = $("#formdistrito").serialize();          
            var type = "POST";
            var token = $("input[name=_token]").val();            
            var route = "/Socios/distritos";   
            if($("#RegDistrito").text() == "Actualizar"){
                route = "/Socios/distritos/"+$("#iddistrito").val();
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
                mensajeRegistro(data,'formdistrito');
                    document.location.reload();
                
            },
             error:function(data)
            {
                if(data.status==403) activarmodal(0);
                else{
                $("#error_provincia").html(''); $("#error_departamento").html('');$("#error_distrito").html('');
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'provincia')$("#error_provincia").html(value);
                            else if(index == 'departamento')$("#error_departamento").html(value); 
                             else if(index == 'distrito')$("#error_distrito").html(value);
                      });    
                  }
            }
             
          })      
    });  

var EdDistrito = function(id) {
        $("#RegDistrito").text("Actualizar");
        var route = "/Socios/distritos/"+id+"/edit";
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
      var route = "/Socios/distritos/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)
          document.location.reload();
        
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
};

//  **************************************************************************   CRUD COMITE CENTRAL  ***************************************************
$("#RegCentral").click(function(event)  {       
            var fields = $("#formcomite_central").serialize();
            
            var token = $("input[name=_token]").val();
            var route = "/Socios/comite-central"; 
            var type = "POST";
            if( $("#RegCentral").text() == "Actualizar" ){
                route = "/Socios/comite-central/" + $("#idcentral").val();
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
                mensajeRegistro(data,'formcomite_central');
                    document.location.reload();
                
            },
             error:function(data)
            {
                if(data.status==403) activarmodal(0);
                else{
                $("#error_provincia").html(''); $("#error_departamento").html('');$("#error_distrito").html('');$("#error_central").html('');
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'provincia')$("#error_provincia").html(value);
                            else if(index == 'departamento')$("#error_departamento").html(value); 
                             else if(index == 'distrito')$("#error_distrito").html(value);
                             else if(index == 'comite_central')$("#error_central").html(value);
                      });  
                  }
            }
             
          })      
    });  

var Edcentral = function(id) {
        $('#RegCentral').text("Actualizar");
              
        var route = "/Socios/comite-central/"+id+"/edit";                
        $.get(route, function(data){            
        $("#departamento").val(data.departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.provincias_id+"'>"+data.provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data.distritos_id+"'>"+data.distrito+"</option>");
        $("#idcentral").val(data.id);          
        $("#comite_central").val(data.comite_central);        
        
        });
    };
   
var EliCentral = function(id,name){ 
 
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Socios/comite-central/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success) document.location.reload();
        
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
};

// ***********************************************************************************  CRUD DE COMITE LOCAL  *******************************************
$("#nuevolocal").click(function(event){$("#RegLocal").text("Registrar");$("#error_provincia").html(''); 
    $("#error_departamento").html('');$("#error_distrito").html('');$("#error_central").html('');
                $("#error_local").html('');});

$("#RegLocal").click(function(event){                   
            var fields = $("#formlocal").serialize();
            var type = "POST";
            var token = $("input[name=_token]").val();
            var route = "/Socios/comite-local";     
            if($("#RegLocal").text() == "Actualizar"){
                route = "/Socios/comite-local/" + $("#idlocal").val();
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
                mensajeRegistro(data,'formlocal');
                   document.location.reload();                
            },
             error:function(data)
            {
                if(data.status==403)  activarmodal(0);
                else {
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
            }             
          });      
    });  

var Edlocal = function(id) {
        $('#RegLocal').text("Actualizar");               
        var route = "/Socios/comite-local/"+id+"/edit";                
        $.getJSON(route, function(data){              
        $("#departamento").val(data.departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.provincias_id+"'>"+data.provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data.distritos_id+"'>"+data.distrito+"</option>");
        $("#comite_central").empty();
        $("#comite_central").append("<option value='" + data.comites_centrales_id+"'>"+data.comite_central+"</option>");
        $("#idlocal").val(data.id);          
        $("#comite_local").val(data.comite_local);                
        });
    }
  
var EliLocal = function(id,name){     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Socios/comite-local/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)        
          document.location.reload();        
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
};

//  **************************************************************************************  CRUD TECNICOS  **********************************************
$("#nuevotecnicos").click(function () {
    var route = 'modaltecnicos';
    $.get(route, function (data) {
        $("#conten-modal").html(data);        
        loadTecnicos();       
        $("#modal-form").modal();                       
    });
});

var cargarZonas = function(){
    var route = "/RRHH/Tecnicos/Tecnico-Local";
        $.getJSON(route, function (data) {            
            $("#zona_inicial").empty();var datos;
            $.each(data.lista, function (index, value) {
                datos += "<option value='" + index+"'>"+ value+"</option>"; 
            });
            $("#zona_inicial").html(datos);                       
        }); 
};

var changetecnicos = function (){
    var route = '/RRHH/Tecnicos/'+$("#tecnico").val();  
    cargarZonas();
    $.get(route,function(data){                  
          if(data.success){
              $("#zona_final").empty();var datos;
              $.each(data.sectores, function( index, value ){                   
                  datos += "<option value='" + value.comites_locales_id+"'>"+ value.comite_local+"</option>"; 
              });              
              $("#zona_final").html(datos);
          }
      });
};

var loadTecnicos = function () {
    
    $("#tecnico").select2({
            allowClear: true,
        });
    $("#zona_inicial").dblclick(function (event) {
        $("#zona_inicial option:selected").clone().appendTo("#zona_final");
        $("#zona_inicial option:selected").remove();
    });

    $("#zona_final").dblclick(function (event) {
        $("#zona_final option:selected").clone().appendTo("#zona_inicial");
        $("#zona_final option:selected").remove();
    });

    $("#inicial").click(function (event) {
        $("#zona_inicial option").clone().appendTo("#zona_final");
        $("#zona_inicial option").remove();
    });

    $("#final").click(function (event) {
        $("#zona_final option").clone().appendTo("#zona_inicial");
        $("#zona_final option").remove();
    });

    $("#buscarinicial").keyup(function (event) {
        var texto = $(this).val();
        if (!texto)
        {
            $("#zona_inicial option").show();
        } else {
            $("#zona_inicial option").hide();
            $("#zona_inicial ").find('option:contains("' + texto.toUpperCase() + '")').show();
        }
    });

    $("#buscarfinal").keyup(function (event) {
        var texto = $(this).val();
        if (!texto)
        {
            $("#zona_final option").show();
        } else {
            $("#zona_final option").hide();
            $("#zona_final ").find('option:contains("' + texto.toUpperCase() + '")').show();
        }
    });
    
    $("#RegTecnicos").click(function() {        
      if(!$("#tecnico").val())
        {$("#error_tecnico").html("Seleccione un Tecnico o Extensionista"); return;}
      $("#error_tecnico").html("")      
      var route = "/RRHH/Tecnicos/"+$("#tecnico").val()+"";
      var token = $("input[name=_token]").val();      
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){ 
           RegSectores($("#tecnico").val());
        },
        error:function(data){
            if(data.status==403) $("#error-modal").html(data);
        }
      });        
    });
};

var RegSectores = function(idempleado){
    var options = $("#zona_final option[value]");
    var route = "/RRHH/Tecnicos"; var token = $("input[name=_token]").val();
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
                        mensajeRegistro(data,'formtecnicos');
                        document.location.reload();
                },
                error:function(data){
                    if(data.status==403) $("#error-modal").html(data);
                }
            });          
      }); 
      
}

 
// ********************************************************************************************************  CRUD EMPLEADO  *****************************

  $("#nuevoempleado").click(function(event){     
      activarmodal(7);
 });
 
var RegEmpleado = function(){                       
       
        var route = "/RRHH/Empleados";
        var type = "POST";
        if($("#Regempleado").text() == "Actualizar"){
            route = "/RRHH/Empleados/" + $("#codigo").val();
            type="PUT"            
        }                                                                  
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
                type: type,
                datatype: 'json',                
                data: $("#formempleado").serialize(),
                success: function (data)
                {
                    mensajeRegistro(data,'formempleado');
                    if(data.success) document.location.reload();                    
                },
                error: function (data){
                    if(data.status==403)
                        $("#error-modal").html(data.responseText);
                    else{
                    $("#error_codigo").html('');$("#error_dni").html('');$("#error_ruc").html('');
                    $("#error_estado").html('');$("#error_estado_civil").html('');$("#error_area").html('');
                    $("#error_cargo").html('');$("#error_paterno").html(''); $("#error_materno").html('');
                    $("#error_nombre").html('');$("#error_fec_nac").html('');$("#error_profesion").html('');
                    $("#error_provincia").html(''); $("#error_departamento").html(''); $("#error_distrito").html('');
                    $("#error_central").html('');$("#error_local").html('');$("#error_email").html('');$("#error_direccion").html('');                    
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (index, value) {
                        if (index == 'codigo')$("#error_codigo").html(value);
                        else if (index == 'dni')$("#error_dni").html(value);
                        else if (index == 'ruc')$("#error_ruc").html(value);
                        else if (index == 'estado')$("#error_estado").html(value);
                        else if (index == 'estado_civil')$("#error_estado_civil").html(value);                        
                        else if (index == 'area')$("#error_area").html(value);
                        else if (index == 'cargo')$("#error_cargo").html(value);
                        else if (index == 'paterno')$("#error_paterno").html(value);
                        else if (index == 'materno')$("#error_materno").html(value);                        
                        else if (index == 'nombre')$("#error_nombre").html(value);
                        else if (index == 'fec_nac')$("#error_fec_nac").html(value);
                        else if (index == 'profesion')$("#error_profesion").html(value);
                        else if (index == 'departamento') $("#error_departamento").html(value);                        
                        else if (index == 'provincia')$("#error_provincia").html(value);
                        else if (index == 'distrito')$("#error_distrito").html(value);
                        else if (index == 'comite_central') $("#error_central").html(value);
                        else if (index == 'comite_local')$("#error_local").html(value);                        
                        else if (index == 'email')$("#error_email").html(value);
                        else if (index == 'direccion')$("#error_direccion").html(value);                        
                    }); 
                }
                }
            });                                                          
    };

var EdiEmpleado = function (id) {
    $.get('modalempleado', function (data) {
        $("#conten-modal").html(data);
        var route = "/RRHH/Empleados/" + id + "/edit";
        $.get(route, function (data) {
            $("#Regempleado").text("Actualizar");
            $("#titulo-empleado").html("ACTUALIZAR DATOS EMPLEADO")
            $("#codigo").val(data.empleadoId);
            $("#codigo").prop("readonly", true);
            $("#dni").val(data.personas_dni);
            $("#dni").prop("readonly", true);
            $("#estado_civil").val(data.estadocivil);
            $("#estado").val(data.estado);
            $("#email").val(data.email);
            $("#profesion").val(data.profesion);
            $("#ruc").val(data.ruc);
            $("#cargo").val(data.cargos_id);

            $("#area").val(data.areas_id);
            $("#paterno").val(data.paterno);
            $("#materno").val(data.materno);
            $("#nombre").val(data.nombre);
            $("#fec_nac").val(data.fec_nac);
            if (data.sexo == 'M')
                $("#sexoM").prop("checked", true);
            else if (data.sexo == 'F')
                $("#sexoF").prop("checked", true);
            $("#direccion").val(data.direccion);
            $("#empresa").val(data.empresas_ruc);
            $("#referencia").val(data.referencia);
            $("#celular").val(data.telefono);
            $("#departamento").val(data.departamentos_id);
            $("#provincia").empty();
            $("#provincia").append("<option value='" + data.provincias_id + "'>" + data.provincia + "</option>");
            $("#distrito").empty();
            $("#distrito").append("<option value='" + data.distritos_id + "'>" + data.distrito + "</option>");
            $("#comite_central").empty();
            $("#comite_central").append("<option value='" + data.comites_centrales_id + "'>" + data.comite_central + "</option>");
            $("#comite_local").empty();
            $("#comite_local").append("<option value='" + data.comites_locales_id + "'>" + data.comite_local + "</option>");
            $("#modal-form").modal();
        });
    });
       
      
        
    }

var EliEmpleado = function(id,name){ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"
           +name+"</span></strong></br>").then(function() {  
      var route = "/RRHH/Empleados/"+id+"";
      var token = $("input[name=_token]").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success) document.location.reload();
        else $.alertable.alert("No se puede Eliminar el codigo: "+id+"<br> El Codigo Cuenta con Registros de Operacion");
      },
      error:function(data){
         if(data.status==403) activarmodal(0);
      }
      });
        
  
    });
};

// ****************************************************************************************   CRUD DE CENTROS DE ACOPIO *********************************
$("#nuevasucursal").click(function(){
    activarmodal(12);
});

$(document).ready().on('click','#personaSalir',function(event){
    activarmodal(12);
});

$(document).ready().on('click','#RegPersona',function(){
    $.ajax({
        url: '/Auxiliar/AddPersona',
                headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
                type: 'POST',
                datatype: 'json',              
                data: $("#fomrPersona").serialize(),
                success: function (data)
                {
                    mensajeRegistro(data,'fomrPersona');
                    if(data.success) activarmodal(12);
                },
                error: function (data)
                { 
                    $("#error-dni").empty();$("#error-sexo").empty();$("#error-paterno").empty();
                        $("#error-materno").empty();$("#error-nombre").empty();$("#error-nacimiento").empty();
                        $("#error-direccion").empty();                 
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (index, value) {
                            if (index == 'dni')$("#error-dni").html(value);
                            else if (index == 'sexo')$("#error-sexo").html(value);
                            else if (index == 'paterno')$("#error-paterno").html(value);
                            else if (index == 'materno')$("#error-materno").html(value);
                            else if (index == 'nombre')$("#error-nombre").html(value);
                            else if (index == 'fec_nacimiento')$("#error-fec_nacimiento").html(value);
                            else if (index == 'direccion')$("#error-direccion").html(value);
                        });                   
                }
    })
});

$(document).ready().on('click','#RegAlmacen',function(){
    var type = "POST";
    var token = $("input[name=_token]").val();
    var route = "/RRHH/Sucursal";
    var fields = $("#formsucursal").serialize();    
    if( $("#RegAlmacen").text() == 'Actualizar' ){   
            type="PUT";route = "/RRHH/Sucursal/"+ $("#codigoId").val();
    }                    
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: type,
                datatype: 'json',              
                data: fields,
                success: function (data)
                {
                    mensajeRegistro(data,'formsucursal');
                        activarForm(20);
                   
                },
                error: function (data)
                {   
                    if(data.status==403) $("#error-modal").html(data.responseText);
                    else {
                        $("#error_codigoId").empty();$("#error_area").empty();$("#error_telefono").empty();
                        $("#error_sucursal").empty();$("#error_fax").empty();$("#error_acopiador").empty();
                        $("#error_provincia").empty(); $("#error_departamento").empty(); $("#error_distrito").empty();
                        $("#error_central").empty();$("#error_local").empty();$("#error_direccion").empty();                    
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (index, value) {
                            if (index == 'codigoId')$("#error_codigoId").html(value);
                            else if (index == 'area')$("#error_area").html(value);
                            else if (index == 'telefono')$("#error_telefono").html(value);
                            else if (index == 'fax')$("#error_fax").html(value);
                            else if (index == 'sucursal')$("#error_sucursal").html(value);                                                
                            else if (index == 'departamento') $("#error_departamento").html(value);                        
                            else if (index == 'provincia')$("#error_provincia").html(value);
                            else if (index == 'distrito')$("#error_distrito").html(value);
                            else if (index == 'comite_central') $("#error_central").html(value);
                            else if (index == 'comite_local')$("#error_local").html(value);                                                
                            else if (index == 'direccion')$("#error_direccion").html(value);
                            else if (index == 'acopiador')$("#error_acopiador").html(value);
                        }); 
                    }
                }
            });                  
});

    var Editsucur = function (id) {
    var route = "/RRHH/Sucursal/" + id + "/edit";
    $.get('AlmacenModal', function (data) {
        $("#conten-modal").empty().html(data);
        $(".select2").select2();
        $.getJSON(route, function (data) {
            $("#RegAlmacen").text('Actualizar');
            $("#codigoId").prop("readonly", true);
            $("#codigoId").val(id);
            $("#area").val(data.areas_id);
            $("#telefono").val(data.telefono);
            $("#direccion").val(data.direccion);
            $("#fax").val(data.fax);
            document.getElementById('acopiador').value = data.personas_dni;            
            $("#sucursal").val(data.sucursal);
            $("#departamento").val(data.departamentos_id);
            $("#provincia").empty();
            $("#provincia").append("<option value='" + data.provincias_id + "'>" + data.provincia + "</option>");
            $("#distrito").empty();
            $("#distrito").append("<option value='" + data.distritos_id + "'>" + data.distrito + "</option>");
            $("#comite_central").empty();
            $("#comite_central").append("<option value='" + data.comites_centrales_id + "'>" + data.comite_central + "</option>");
            $("#comite_local").empty();
            $("#comite_local").append("<option value='" + data.comites_locales_id + "'>" + data.comite_local + "</option>");
        });
        $("#modal-form").modal();
    });
};
                    
var EliSucursal = function(id,name){ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/RRHH/Sucursal/"+id+"";
      var token = $("input[name=_token]").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)        
                    activarForm(20);
        
      },
      error:function(data){
          if(data.status) activarmodal(0);
      }
      });
        
  
    });
};        
        

// **********************************************************************************     DISTRIBUCION FONDOS DE ACOPIO *********************************
var AnulDistribucion = function(id,name){
   $.alertable.prompt('<h3>Motivo de la Anulacion ? </h3>'+"<span style='color:#ff0000'>"+name+"</span>").then(function(data){       
            var motivo = data.value;
            var route = "/Tesoreria/Distribucion-Fondos/"+id+"";            
            var token = $("input[name=_token]").val();            
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: {
                motivo:motivo
            },
            success: function (data) {
                if (data.success)
                    activarForm(9);
                else
                    $.alertable.alert("<span style='color:#ff0000'>"+data.message+"</span>")                                   
            },
            error:function(data){
                if(data.status==403) activarmodal(0);
                else
                    activarForm(9);
            }
        });
   });    
};
    
$("#RegDistribucion").click(function(){
    if($("#monto").val() > temporal){
        $.alertable.alert("<span style='color:#ff0000'>EL MONTO SOBREPASA CON EL SALDO DEL CHEQUE</span>");
        return;
    }
      var fields = $("#formfondosdistri").serialize();      
    var route = "/Tesoreria/Distribucion-Fondos";
      var token = $("input[name=_token]").val();       
      $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                datatype: 'json',                
                data: fields,
                success: function (data)
                {                    
                    mensajeRegistro(data,'formfondosdistri');
                    activarForm(9);                    
                    $.alertable.confirm("<span style='color:#000'>¿Deseas Imprimir el Recibo?</span>").then(function(){
                        var route = $("#printdelivery").attr('href');
                        var route = route +"/"+data.id;
                        $("#printdelivery").attr('href',route);
                        document.getElementById('printdelivery').click();                        
                      });
                },
                error: function (data)
                {             
                    if(data.status==403) $("#error-modal").html(data.responseText);
                    else{
                    $("#error_tecnico").html('');$("#error_sucursal").html('');$("#error_fecha").html('');
                    $("#error_monto").html('');$("#error-recibo").html('');$("#error-cheque").html('');$("#error-numero").html('');
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (index, value) {
                        if (index == 'tecnico')$("#error_tecnico").html(value);
                        else if (index == 'sucursal')$("#error_sucursal").html(value);
                        else if (index == 'fecha')$("#error_fecha").html(value);
                        else if (index == 'monto')$("#error_monto").html(value);
                        else if (index == 'cheque')$("#error-cheque").html(value);
                        else if (index == 'numero')$("#error-numero").html(value);
                        else if (index == 'recibo')$("#error-recibo").html(value);
                    }); 
                }
                }            
            });
});

//  *******************************************************************************  CRUD DE RECIBOS  ***************************************************
$("#nuevorecibo").click(function(data){
    $("#RegRecibo").text("Registrar");$("#codigo").prop('readonly',false);
     $("#error_codigo").html('');$("#error_recibo").html('');
});

$("#RegRecibo").click(function(){
    var fields = $("#formrecibo").serialize();
    var token = $("input[name=_token]").val();var type = "POST"; var route = "/Configuracion/Documentos";
    if($("#RegRecibo").text() == "Actualizar"){
        type="PUT";route="/Configuracion/Documentos/"+$("#codigo").val();
    }
    $.ajax({
        url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: type,
                datatype: 'json',                
                data: fields,
                success: function (data)
                {
                    mensajeRegistro(data,'formrecibo');
                    document.location.reload();
                },
                error: function (data){                    
                    if(data.status==403) activarmodal(0);
                    else {
                    $("#error_codigo").html('');$("#error_recibo").html('');$("#error-enlace").html('');
                    var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                          
                            if(index == 'codigo')$("#error_codigo").html(value);
                            else if(index == 'recibo')$("#error_recibo").html(value);
                            else if(index == 'enlace') $("#error-enlace").html(value);
                      }); 
                  }
                }
    });
});

var EditRecibo = function (idrecibo){
    $("#RegRecibo").text("Actualizar");
    var route = "/Configuracion/Documentos/"+idrecibo+"/edit";      
    $.getJSON(route,
            function(data){                
                $("#recibo").val(data.tipo_documento);
                $("#codigo").val(data.codigo);
                $("#codigo").prop('readonly',true);
                $("#enlace").val(data.enlace);
            }
   );
};

var EliRecibo = function(id,name){      
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "/Configuracion/Documentos/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success)        
            document.location.reload();
        else
            mensajeRegistro(data,'formrecibo');
      },
      error: function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
};

//  ********************************************************************************  CRUD COMPRAS  *****************************************************

    $("#nuevacompra").click(function(){
    var route = 'modalcompras';
        $.get(route,function(data){            
            $("#conten-modal").html(data);
            loadcompras();
            $("#modal-form").modal();
        });    
});

    var loadcompras = function () {

    $("#comite").select2({
        alloClear: true
    });

    $("#acopio").autocomplete({
        minLength: 1,
        autoFocus: true,
        delay: 1,
        source: "/Auxiliar/codigoSucursal",
        select: function (event, ui) {            
            $("#sucursal").val(ui.item.id);
        }
    });
    
    $("#sucursal").autocomplete({
        minLength: 1,
        autoFocus: true,
        delay: 1,
        source: "/Auxiliar/datoSucursal",
        select: function (event, ui) {            
            $("#acopio").val(ui.item.id);
        }
    });

    $("#dnin").autocomplete({
        minLength: 1,
        autoFocus: true,
        delay: 1,
        source: "/Auxiliar/nosocios",
        select: function (event, ui) {
            $("#paterno").val(ui.item.id);
            $("#materno").val(ui.item.materno);
            $("#nombres").val(ui.item.nombres);
            var valor="<option value=''>Seleccione una Condicion</option>";
            $.each(ui.item.condicions,function ( index,value){
                valor = valor + "<option value="+index+">"+value+"</option>"
            });
            $("#condicion").empty().html(valor);
        }
    });
        
    $("#codigo").autocomplete({
        minLength: 1,
        autoFocus: true,
        delay: 1,
        source: "/Auxiliar/codigoSocios",
        select: function (event, ui) {    
            
            $("#socio").val(ui.item.socio);            
            $("#local").val(ui.item.local); var valor='';
            $.each(ui.item.condicions,function ( index,value){
                valor = valor + "<option value="+index+">"+value+"</option>"
            });
            $("#condicion").empty().html(valor);
        }
    });
    $("#socio").autocomplete({
        minLength: 1,
        autoFocus: true,
        delay: 1,
        source: "/Auxiliar/datoSocios",
        select: function (event, ui) {                
            $("#codigo").val(ui.item.id);
            $("#local").val(ui.item.local);
            var valor='';
            $.each(ui.item.condicions,function ( index,value){
                valor = valor + "<option value="+index+">"+value+"</option>"
            });
            $("#condicion").empty().html(valor);
        }
    });
    
//    $("#codrecibo").autocomplete({
//        minLength: 1,
//        autoFocus: true,
//        delay: 1,
//        source: "/codrecibos",
//        select: function (event, ui) {
//            numerorecibo(ui.item.value);
//        }
//    });
    
};

$(document).ready().on('click','#RegCompras',function(){
    
        var fields = $("#formcompras").serialize();
        var route = "/Acopio/Compra-Grano";
        var token = $("input[name=_token]").val();        
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'post',
            datatype: 'json',
            data: fields,
            success: function (data)
            {                
                mensajeRegistro(data, 'formcompras');
                activarForm(10);
                if(data.success){
                    $.alertable.confirm("<span style='color:#ff0000'>Su Saldo restante es: S/. "+data.saldo+" </span><br><span style='color:#000'>¿Deseas Imprimir el Recibo?</span>").then(function(){
                        
                    });
                  }                                                      
            },
            error: function (data) {
                if (data.status == 403)
                    $("#error-modal").html(data.responseText);
                else {
                    $("#error_acopio").html('');$("#error_paterno").html(''); $("#error_socio").html(''); $("#error_materno").html('');
                    $("#error_nombres").html('');$("#error_codigo").html('');$("#error_dni").html(''); $("#error_numero").html('');
                    $("#error_comite").html('');$("#error_fecha").html(''); $("#error_condicion").html(''); $("#error_kilos").html('');
                    $("#error_precio").html('');
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (index, value) {
                        if (index == 'acopio') $("#error_acopio").html(value);
                        else if (index == 'paterno') $("#error_paterno").html(value);
                        else if (index == 'materno')$("#error_materno").html(value);
                        else if (index == 'nombres')$("#error_nombres").html(value);
                        else if (index == 'dni')$("#error_dni").html(value);
                        else if (index == 'numero')$("#error_numero").html(value);
                        else if (index == 'comite')$("#error_comite").html(value);
                        else if (index == 'codigo')$("#error_codigo").html(value);
                        else if (index == 'socio')$("#error_socio").html(value);
                        else if (index == 'condicion')$("#error_condicion").html(value);
                        else if (index == 'kilos')$("#error_kilos").html(value);
                        else if (index == 'precio')$("#error_precio").html(value);
                        else if (index == 'fecha')$("#error_fecha").html(value);
                    });
                }
            }
        });
});

    var AnulCompra = function(id,name){                 
   $.alertable.prompt('<h3>Motivo de la Anulacion ? </h3>'+"<span style='color:#ff0000'>"+name+"</span>").then(function(data){       
            var motivo = data.value;
            var route = "/Acopio/Compra-Grano/"+id+"";            
            var token = $("input[name=_token]").val();            
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: {
                motivo:motivo
            },
            success: function (data) {                    
                if (data.success)                
                    activarForm(10);                
            },
            error:function(data){                
                if(data.status==403) activarmodal(0);
            }
        });
   },function(){
       
   });    
};

// ***********************************************************************************  CRUD PERSONA JURIDICA  ******************************************
 
$("#nuevoperjuridica").click(function(){
        $("#formjuridico")[0].reset();$("#error_ruc").html('');$("#error_telefono").html('');
        $("#error_razon").html('');$("#error_direccion").html('');$("#RegPersonaJuridica").text("Registrar")
    });
    
$("#RegPersonaJuridica").click(function(){
        var route = '/Acopio/Persona-Juridica';
        var token = $("#token").val();
        var fields = $("#formjuridico").serialize();
        var tipo = 'POST';
        if($("#RegPersonaJuridica").text() == "Actualizar")
        {
            tipo = "PUT";
            route = "/Acopio/Persona-Juridica/" + $("#idjuridica").val();
        }
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type: tipo,
            dataType: 'json',
            data: fields,
            success: function (data) {
                if(data.success == true){
                    var msj = "<h4>" + data.message + "</h4>";
                        $("#info-juridica").html(msj);
                        $("#alert-juridico").fadeIn();
                    document.location.reload();
                }
                else{
                    var msj = "<h4>" + data.message + "</h4>";
                        $("#info-juridica").html(msj);
                        $("#alert-juridico").fadeOut();
                }
                    
            },
            error: function(data){
                var errors = $.parseJSON(data.responseText);
                $("#error_ruc").html('');$("#error_telefono").html('');$("#error_razon").html('');$("#error_direccion").html('');
                    $.each(errors, function (index, value) {                        
                        if(index == 'ruc') $("#error_ruc").html(value);
                        else if(index == 'telefono') $("#error_telefono").html(value);
                        else if(index == 'razon') $("#error_razon").html(value);
                        else if(index == 'direccion') $("#error_direccion").html(value);
                    });
            }
        });
    });
    
var EditJuridico = function(id){
        var route = '/Acopio/Persona-Juridica/'+id+"/edit";
        $("#idjuridica").val(id);
        $("#RegPersonaJuridica").text("Actualizar");
        $.get(route, function(data){                        
            $("#ruc").val(data.ruc);
            $("#telefono").val(data.telefono);
            $("#razon").val(data.razon_social);
            $("#direccion").val(data.direccion);
        });
    };
   
var AnulJuridico = function(id,name){
       $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"
           +name+"</span></strong></br>").then(function() {  
      var route = "/Acopio/Persona-Juridica/"+id+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == true)
        {
            document.location.reload();
        }
      }
      });          
    });
   };
   
// ********************************************************************************************  PAGOS **************************************************

$("#RegEgresos").click(function(){        
        var route = "/Acopio/Gastos";
        var type = "POST";
        var token=$("input[name=_token]").val();
        var fields=$("#formegresos").serialize();        
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:type,
            datatype: 'json',
            data: fields,            
            success:function(data){    
                    mensajeRegistro(data,'formegresos');
                    document.location.reload();                    
                
            },
            error: function(data){
                if(data.status) $("#error-modal").html(data.responseText);
                else{
                $("#error-fecha").html('');$("#error-monto").html('');$("#error-egresos").html('');$("#error-almacen").html('');
                var errors =  $.parseJSON(data.responseText);      
                $.each(errors,function(index, value) {                      
                            if(index == 'fecha')$("#error-fecha").html(value);
                            else if(index == 'monto')$("#error-monto").html(value);
                            else if(index == 'egresos')$("#error-egresos").html(value);
                            else if(index == 'almacen')$("#error-almacen").html(value);
                      });
            }
        }
        });
    });
    
var EliGasto = function(id,nombre){        
        $.alertable.prompt('<h3>Motivo de la Anulacion ? </h3>'+"<span style='color:#ff0000'>"+nombre+"</span>").then(function(data){                        
            var motivo = data.value;
            var route = "/Acopio/Gastos/"+id+"";            
            var token = $("input[name=_token]").val();            
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: { motivo:motivo },
            success: function (data) {                
               if (data.success == true) document.location.reload();
            },
            error: function(data){
                if(data.status==403) activarmodal(0);
            }
        });
    });
   };
   
   // **************************************************************************************************   ROL ******************************************
     
     var ElimRol = function (name, id) {
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el Rol ?</span>" + "<br><strong><span style='color:#ff0000'>" + name + "</span></strong></br>").then(function () {
        var route = "/Usuario/RolDelete/" + id + "";        

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                if (data.success) Roles();
                else $.alertable.alert("No se puede Eliminar el Rol "+name +"<br> Tiene Registros de Operación");                    
            },
            error: function (data) {
                if (data.status==403) activarmodal(0);
            }
        });
    });
}
     var EditRol = function(id){
         activarmodal(1);
         $.getJSON('/Usuarios/Rol/'+id,function(data){             
             $("#rol").val(data.name);
             $("#tag").val(data.display_name);
             $("#descripcion").val(data.description);
             $("#RegRol").text('Actualizar');
             $("#id").val(id);
         })
     };
     
     var Roles = function(){
         var route = '/Usuario/RolHead';
         $.ajax({
            type:'get',
            url:route,
            success:function(data){                
                $("#contenidos-box").html(data);  
                ListaRol();
            }            
        })
     }
     
    
        
    $(document).ready().on('click','#RegRol',function(event){
        var type = 'POST';        var route = '/Usuario/RolUsuario';
        if($(this).text() == "Actualizar") {type='PUT'; route = '/Usuario/RolUpdate/'+$("#id").val();}
        $.ajax({          
          url:route,
          headers:{'X-CSRF-TOKEN':$("input[name=_token]").val()},
          type:type,
          datatype:'json',
          data:$("#formrol").serialize(),
          success:function(data){
              mensajeRegistro(data,'formrol');
              Roles();
          },
          error:function(data){
              $("#error_rol").html('');$("#error_tag").html('');$("#error_descripcion").html('');              
              var errors =  $.parseJSON(data.responseText);
              $.each(errors,function(index, value) {                      
                            if(index == 'rol' )$("#error_rol").html(value);
                            else if(index == 'permiso' || index == 'cheque')$("#error_rol").html(value);
                            else if(index == 'tag' || index == 'numero')$("#error_tag").html(value);                             
                            else if(index == 'descripcion' || index == 'importe')$("#error_descripcion").html(value);                            
                      });
          }
       });
    });
    
    
   var regrol = function (id){           
       if(id==1) var route = "NewRolUsuario";
       else if(id==2) var route = "NewPermisoUser";      
       
       var type = 'POST';
       if($("#RegRol").text() == "Actualizar") type = 'PUT';
//       console.log($("#Regmodal").text());
       $.ajax({          
          url:route,
          headers:{'X-CSRF-TOKEN':$("input[name=_token]").val()},
          type:type,
          datatype:'json',
          data:$("#formrol").serialize(),
          success:function(data){
              mensajeRegistro(data,'formrol');
                if(id==3) document.location.reload();                                             
          },
          error:function(data){
              $("#error_rol").html('');$("#error_tag").html('');$("#error_descripcion").html('');              
              var errors =  $.parseJSON(data.responseText);
              $.each(errors,function(index, value) {                      
                            if(index == 'rol' )$("#error_rol").html(value);
                            else if(index == 'permiso' || index == 'cheque')$("#error_rol").html(value);
                            else if(index == 'tag' || index == 'numero')$("#error_tag").html(value);                             
                            else if(index == 'descripcion' || index == 'importe')$("#error_descripcion").html(value);                            
                      });
          }
       });
   };
   
   var asigpermiso = function(name){
       if($("#rol").val() == "") {alert('Seleccione un rol'); return;};
       var rolid = $("#rol").val();
       var permisoid = $("input[name="+name+"]").val();
       var estado = $("input[name="+name+"]").is(':checked');
       var token = $("input[name=_token]").val();
       $.ajax({
           url:'AsigPermisos',
          headers:{'X-CSRF-TOKEN':token},
          type:"POST",
          datatype:'json',
          data:{rol:rolid,permiso:permisoid,estado:estado},
          success:function(data){               
          }
       });
   };
                            
   // ******************************************************************************************************  CHEQUE *************************************
   
   var EdiCheque = function(id){     
     $.get('modalcheque',function(data){
         $("#conten-modal").html(data);
         $.getJSON("Cheques/"+id+"/edit",function(data){         
             $("#cheque").val(data.cheque);
             $("#numero").val(data.num_cuenta);
             $("#descripcion").val(data.descripcion); 
             $("#idcheque").val(data.id);
             $("#RegCheque").text("Actualizar");         
         });
         $("#modal-form").modal();
     });
     
   };
   
    var ElimCheque = function(id,nombre){  
       $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span><br><strong><span style='color:#ff0000'>"
           +nombre+"</span></strong></br>").then(function() {  
      var route = "deleteCheques/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
                activarForm(12);   
        },
        error:function(data){
            if(data.status==403) activarmodal(0);
        }
      });          
    });
   };
   
   $(document).ready().on('click','#RegCheque',function(event){
       var route = '/Tesoreria/Cheques';var type = 'POST';
       if(event.target.text == 'Actualizar'){
           route= '/Tesoreria/Cheques/' + $("#idcheque").val();
           type = 'PUT';
       }
       $.ajax({          
          url:route,
          headers:{'X-CSRF-TOKEN':$("input[name=_token]").val()},
          type:type,
          datatype:'json',
          data:$("#formCheque").serialize(),
          success:function(data){
              mensajeRegistro(data,'formCheque');
                activarForm(12);                                             
          },
          error:function(data){
              if(data.status==403) $("#error-modal").empty().html(data.responseText);
              else{
              $("#erro-cheque").html('');$("#error-numero").html('');$("#error-descripcion").html('');              
              var errors =  $.parseJSON(data.responseText);
              $.each(errors,function(index, value) {                      
                            if(index == 'cheque' )$("#error-cheque").html(value);
                            else if(index == 'numero')$("#error-numero").html(value);
                            else if(index == 'descripcion')$("#error-descripcion").html(value);                            
                      });
                  }
          }
       });
   });
   
   //***********************************************************************************************************   MOV CHEQUE ***************************
   $(document).ready().on('click','#RegMovCheque',function (){             
       var route = 'Cheques-Girados';
       var type="POST";       
       if($("#RegMovCheque").text() == "Actualizar"){
           type = 'PUT';
           route = 'Cheques-Girados/'+$("#idmovcheque").val();
       }       
      $.ajax({          
          url:route,
          headers:{'X-CSRF-TOKEN':$("input[name=_token]").val()},
          type:type,
          datatype:'json',
          data:$("#formmovcheque").serialize(),
          success:function(data){
                mensajeRegistro(data,'formmovcheque')
                activarForm(4);                                             
          },
          error:function(data) {
            if (data.status == 403)
                $("#error-modal").empty().html(data.responseText);
            else {
                $("#error_concepto").html('');
                $("#error_img").html('');
                $("#error_dni").html('');
                $("#error_tipo").html('');
                $("#error_dato").html('');
                $("#error_numero").html('');
                $("#error_cheque").html('');
                $("#error_importe").html('');
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function (index, value) {
                    if (index == 'concepto')
                        $("#error_concepto").html(value);
                    else if (index == 'idurl')
                        $("#error_img").html(value);
                    else if (index == 'dni')
                        $("#error_dni").html(value);
                    else if (index == 'tipo')
                        $("#error_tipo").html(value);
                    else if (index == 'dato')
                        $("#error_dato").html(value);
                    else if (index == 'numero')
                        $("#error_numero").html(value);
                    else if (index == 'cheque')
                        $("#error_cheque").html(value);
                    else if (index == 'importe')
                        $("#error_importe").html(value);
                });
            }
        }
       });       
   });
   
   var EdiMovCheque = function(id){
       $.get('modalmovcheque',function(data){
         $("#conten-modal").html(data);
     });
     $.getJSON("Cheques-Girados/"+id+"/edit",function(data){                  
         if(data.tipo) $("#tipos").attr('checked',true);
         else $("#tipoe").attr('checked',true);         
         $("#concepto").val(data.movcheque.concepto);
         $("#numero").val(data.movcheque.num_cheque);
         
         $("#cheque").val(data.movcheque.cheques_id); 
         $("#importe").val(data.movcheque.importe);
         $("#idurl").val(data.movcheque.url_cheque);
         $("#idmovcheque").val(data.movcheque.id);         
         $("#dato").val(data.movcheque.paterno+ ' ' + data.movcheque.materno+' '+data.movcheque.nombre);
         $("#dni").val(data.movcheque.dni);
         $("#imgcheque").attr('src',data.movcheque.url_cheque); 
         $("#RegMovCheque").text("Actualizar");
         $("#modal-form").modal({show:'false'});
     });
   }
   
   var AnulMovCheque = function(id,cheque,num){
       $.alertable.prompt('<h3>Concepto de la Anulacion del Cheque? </h3>'+"<span style='color:#ff0000'>"+cheque+" N° "+num  +"</span>").then(function(data){                        
            var motivo = data.value;
            var route = "UpdateMovCheque/"+id+"";            
            var token = $("input[name=_token]").val();
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'PUT',
            dataType: 'json',
            data: { motivo:motivo },
            success: function (data) {                                
                if(data.success) activarForm(4);
            },
            error:function(data){
                if (data.status==403) activarmodal(0);
            }
        });
    });
   }
              
   var cambiarimg = function(){       
       $("#filecheque").click();                 
   };
         
   var filechange = function (event){
       
     var formData = new FormData();
       formData.append("filecheque",event.files[0]);
       var token = $("input[name=_token]").val();
    $.ajax({   
         type:'POST',
          url:'/uploadimage',
          headers:{'X-CSRF-TOKEN':token},          
          data:formData,
            contentType:false,
            processData: false,
            cache:false,
          success:function(data){
              
              if(data.success) {
                  $("#imgcheque").attr('src',data.ruta);                   
                  $("#idurl").val(data.ruta);                  
              }              
          },
          error:function(data){
              if(!data.success) $("#error_img").html(data.tuta);
          }
       });
   };
   
   ///     ********************************************   CAJA CHICA ************************************************************************************
    
   var regCajaChica = function (){
       
       var route = 'Caja-Chica';
       var token = $("input[name=_token]").val();
       var type = 'POST';
       if($("#remcaja").text() == "Actualizar"){
           route = 'Caja-Chica/'+$("#idcaja").val();
           type = "PUT";
       }       
       var formu = $("#formcaja").serialize();       
       $.ajax({          
          url:route,
          headers:{'X-CSRF-TOKEN':token},
          type:type,
          datatype:'json',
          data:formu,
          success:function(data){
              mensajeRegistro(data,'formcaja');
              activarForm(3);                               
          },
          error:function(data){
              if(data.status==403) $("#error-modal").empty().html(data.responseText);
              else{
              $("#error_rol").html('');$("#error_tag").html('');$("#error_descripcion").html('');  $("#error-caja").html('');             
              var errors =  $.parseJSON(data.responseText);
              $.each(errors,function(index, value) {                      
                            if(index == 'lischeque' )$("#error_lischeque").html(value);
                            else if(index == 'numero' )$("#error_numero").html(value);
                            else if(index == 'importe' || index == 'numero')$("#error_importe").html(value);  
                            else if(index=='caja')$("#error-caja").html(value); 
                      });
            }
          }
       });
   };
   
   var EdiCajaChica = function(id){       
       $.get('modalCaja',function(data){
         $("#conten-modal").html(data);
     });
     $.getJSON("Caja-Chica/"+id+"/edit",function(data){                    
         $("#numero").val(data.num_cheque);
         $("#caja").val(data.num_caja);
         $("#lischeque").val(data.id); 
         $("#importe").val(data.importe);
         $("#idcaja").val(id);         
         $("#remcaja").text("Actualizar");
         $("#modal-form").modal();
     });
   };
      
   var AnulCajaChica = function (id,caja,cheque){
       $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+caja+" N° "+cheque+"</span></strong></br>").then(function() {  
      var route = "/Tesoreria/Caja-Chica/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success) activarForm(3);        
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
          else
                    activarForm(3)
      }
      });          
    });
   };
        
   //***************************************************************   ASIGNAR ROL  - USUARIO ***********************************************************
   
   var modalrol = function(name){
       var route = 'modalRolUser';
        $.get(route,function(data){
            $("#conten-modal").html(data);
            $("#title-user").html(name);
            $("#modalrol").modal({show:'false'});
        });
   };
   
  var rolUser = function(){
       var route = '';
       var token = $("input[name=_token]").val();           
       $.ajax({          
          url: 'NewRolUser',
          headers:{'X-CSRF-TOKEN':token},
          type:'POST',
          datatype:'json',
          data:{rol:$("#rol").val(),usuario:$("#title-user").html()},
          success:function(data){              
              $("#msj_rol").fadeIn();
              if(data.success){
                $("#txt_rol").html(data.message);
                activarForm(5);
                $("#modalrol").modal("hide")
              }
              else{
                  $("#msj_rol").removeClass('alert-success');
                  $("#msj_rol").addClass('alert-danger');
                  $("#txt_rol").html(data.message);                                                
              }
               $("#msj_rol").fadeOut(1000);                 
          },
          error:function(data){
              $("#error_rol").html('');            
              var errors =  $.parseJSON(data.responseText);
              $.each(errors,function(index, value) {                      
                            if(index == 'rol' )$("#error_rol").html(value);                                                      
                      });
          }
       });
   };
      
   var ActDesact = function(name,estado){
       if(estado)
           var valor = 'HABILITAR';
       else 
           var valor = 'INHABILITAR';
       $.alertable.confirm("<span style='color:#000'>¿Está seguro de "+valor+" al Usuario: ?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "estado-user"
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{usuario:name},
        success: function(data){ 
            if(data.success) 
                activarForm(5);
      }
      });          
    });
   };
   
   //****************************************************************** **********************  PLANILLA SEMANAL ****************************************
   
   $("#RegPlanilla").click(function(){
        var fields = $("#formsemanal").serialize();        
        var route = "/Acopio/Planilla-Semanal";  
        var token = $("input[name=_token]").val();
       $.ajax({
        url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                datatype: 'json',                
                data: fields,
                success: function (data)
                {
                    mensajeRegistro(data,'formsemanal');
                    if(data.success){
                        activarForm(11);
                        $.alertable.confirm("<span style='color:#000'>¿Deseas Exportar a PDF?</span></strong></br>").then(function() {                                                        
                           $("#pdfsemanal").attr('href','Planilla-Semanal/PDF/'+data.id);                           
                           document.getElementById('pdfsemanal').click();
                         });
                            $("#RegPlanilla").hide();
                            $("#nuevaplanilla").text("NUEVO");
                    }
                    
                },
                error: function(data){
                    if(data.status == 403)
                        activarmodal(0);
                    else{
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
            }
            });
    });
    
   
   $("#nuevaplanilla").click(function () {
    if ($("#nuevaplanilla").text() == "NUEVO") {
        $("#nuevaplanilla").text("LISTA")
        $("#btnexportar").show();$("#RegPlanilla").show();
        var route = 'newplanillasemanal';
        $.get(route, function (data) {
            $("#contenidos-box").html(data);// 
            $("#almacencod").autocomplete({
                minLength: 1,
                autoFocus: true,
                delay: 1,
                source: "/RRHH/Sucursalsearch",
                select: function (event, ui) {                    
                    $("#firmaacopiador").html(ui.item.acopiador);
                    $("#firmatecnico").html(ui.item.tecnico);
                    cargarplanilla(ui.item.value);
                }
            });
        });        
    } else {        
        activarForm(11);        
        $("#RegPlanilla").hide();
        $("#nuevaplanilla").text("NUEVO");
    }
});

// *******************************************************************  RECEPCION FONDOS *************************************************************

var ConforRecep = function(event,id,monto){
        var sel = event.parentNode.parentNode.getElementsByTagName('select');
        if(sel[0].value=='') $.alertable.alert("Seleccione si esta Conforme ó No Conforme");
        else if(sel[0].value=='CONFORME'){
            $.alertable.confirm("Esta Conforme la Recepcion de Fondoc de Acopio").then(function(){                
                RegistroRec(id,sel[0].value,monto);
            });
        }
        else{
            $("#valortemp").val(sel[0].value);
            $("#monto").val(monto);
            $("#id").val(id);
            $("#modal-form").modal()
        }                                
    }

 $("#RegRecepcion").click(function(){        
        RegistroRec($("#id").val(),$("#valortemp").val(),0);
    });
    
    function RegistroRec (id,estado,monto){
        if(monto == 0)
            var monto = $("#monto").val();
        var estado = estado;
        var motivo = $("#motivo").val();     
        var route = '/Acopio/Fondos-Acopio/'+id;        
        var token = $("input[name=_token]").val();           
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
                mensajeRegistro(data,'formrecepcionfondos')
                activarForm(8);
                                  
            },
            error:function(data){
                if(data.status==403) activarmodal(0);
                else{
                if ($("#estado").val() == 'CONFORME') activarmodal(0);
                else if(data.status==403) $("#error-modal").html(data.responseText);
            } 
      }
        });
    };
    
// *********************************************************************************       CAJA       ************************************************        
    $(document).ready().on('click','#RegCaja',function(event){
        $.ajax({
           url:'Caja',
           headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
           type: 'POST',
           dataType: 'json',
           data:$("#formcaja").serialize(),
           success: function(data){
               mensajeRegistro(data,'formcaja');
               document.location.reload();               
           },
           error:function(data){
               if(data.status==403) $("#error-modal").empty().html(data.responseText);
               else {
                   $("#error-monto").html('');
                   var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'monto')$("#error-monto").html(value);                            
                      });
               }
           }
        });
    });
    
    // ****************************************************************  MOV DINERO **************************************************************
   $(document).ready().on('click','#RegMovDineroE',function(event){       
       grabarSD('formDineroE');
   });
   $(document).ready().on('click','#RegMovDineroS',function(event){       
       grabarSD('formDineroS');
   });
   $(document).ready().on('click','#RegMovDineroG',function(event){       
       grabarSD('formDineroG');
   });
   $(document).ready().on('click','#RegMovDineroF',function(event){       
       grabarSD('formDineroF');
   });
   
   var GenComp = function(e,id,tipo,tabla,monto){
//       parentNode.parentNode.rowIndex         
        if(tabla == 'tablaxportacion' || tabla == 'tablagastos' || tabla == 'tablagerencia' || tabla == 'tablafactura')
            var table = tabla;
        else
            var table = tabla.id;
       if(document.getElementById('tipoE').checked || document.getElementById('tipoI').checked )
        {   
            if(table == 'tablaxportacion'){
                var total = document.getElementById('totalE').innerHTML;
                var pos = total.lastIndexOf(',');            
                var reemplazo = total.substring(0,pos) + '' + total.substring(pos+1);
                total = reemplazo - monto;
                document.getElementById('totalE').innerHTML = total;
                var tot = parseFloat(document.getElementById('totalcomprobante').innerHTML);
                document.getElementById('totalcomprobante').innerHTML = tot + monto;
            }
            else if(table == 'tablagastos'){
                var total = document.getElementById('totalG').innerHTML;
                var pos = total.lastIndexOf(',');            
                var reemplazo = total.substring(0,pos) + '' + total.substring(pos+1);
                total = reemplazo - monto;
                document.getElementById('totalG').innerHTML = total;
                var tot = parseFloat(document.getElementById('totalcomprobante').innerHTML);
                document.getElementById('totalcomprobante').innerHTML = tot + monto;
            }
            else if(table == 'tablagerencia'){
                var total = document.getElementById('totalGE').innerHTML;
                var pos = total.lastIndexOf(',');            
                var reemplazo = total.substring(0,pos) + '' + total.substring(pos+1);
                total = reemplazo - monto;
                document.getElementById('totalGE').innerHTML = total;
                var tot = parseFloat(document.getElementById('totalcomprobante').innerHTML);
                document.getElementById('totalcomprobante').innerHTML = tot + monto;
            }
            else if(table == 'tablafactura'){
                var total = document.getElementById('totalF').innerHTML;
                var pos = total.lastIndexOf(',');            
                var reemplazo = total.substring(0,pos) + '' + total.substring(pos+1);
                total = reemplazo - monto;
                document.getElementById('totalF').innerHTML = total;
                var tot = parseFloat(document.getElementById('totalcomprobante').innerHTML);
                document.getElementById('totalcomprobante').innerHTML = tot + monto;
            }                                                
                    var tds= "<tr>"
                            +"<td>"+e.parentNode.parentNode.getElementsByTagName('td')[0].innerHTML+"</td>"
                            +"<td>"+e.parentNode.parentNode.getElementsByTagName('td')[1].innerHTML+"</td>"
                            +"<td>"+e.parentNode.parentNode.getElementsByTagName('td')[2].innerHTML+"</td>"
                            +"<td><input type='text' class='form-control' name='totalC' id='totalC' value="+e.parentNode.parentNode.getElementsByTagName('td')[3].innerHTML+"></td>"
                            +"<td><a class='btn-xs' style='cursor: pointer' onclick='delegasto(this,"+table+","+monto+","+id+")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>"
                    $("#tablacomprobante").append(tds);                    
                    document.getElementById(table).deleteRow(e.parentNode.parentNode.rowIndex);                                                                    
        }
        else
            $.alertable.alert("<span>Seleccione un Ingreso o Egreso</span>");          
              
   };
   
   var tipoevent = function(event){
       if(document.getElementById('tipoI').checked){
           document.getElementById('comprobante').value = 'RECIBO'
           $("#comprobante").prop('disabled','disabled');  
           $("#divdireccion").hide();
            $("#divtelefono").hide();
            document.getElementById('lruc').innerHTML = 'D.N.I.:';
            document.getElementById('lrazon').innerHTML = 'Apellidos y Nombres:';
       }
       else   {
           document.getElementById('comprobante').value = 'FACTURA';
           document.getElementById('lruc').innerHTML = 'R.U.C.:';
            document.getElementById('lrazon').innerHTML = 'Razon Social:';
           $("#divdireccion").show();
            $("#divtelefono").show();
            $("#comprobante").prop('disabled',false);
       }        
       $("#tablacomprobante tbody").remove();
   };
    
    var delegasto = function(e,tabla,monto,id){
                
        if(document.getElementById('tipoE').checked)
            var btn = "<td><a class='btn-xs btn'  id='btnEI' onclick='GenComp(this,"+id+",0,"+tabla.id+","+monto+")'><i class='glyphicon glyphicon-export'></i></a></td>"
        else
            var btn = "<td><a class='btn-xs btn'  id='btnEI' onclick='GenComp(this,"+id+",1,"+tabla.id+","+monto+")'><i class='glyphicon glyphicon-import'></i></a></td>"        
        var tds= "<tr>"
                    +"<td>"+e.parentNode.parentNode.getElementsByTagName('td')[0].innerHTML+"</td>"
                    +"<td>"+e.parentNode.parentNode.getElementsByTagName('td')[1].innerHTML+"</td>"
                    +"<td>"+e.parentNode.parentNode.getElementsByTagName('td')[2].innerHTML+"</td>"
                    +"<td>"+monto+"</td>"
                    +btn
                    $("#"+tabla.id).append(tds);
                    var tot = parseFloat(document.getElementById('totalcomprobante').innerHTML);
                    document.getElementById('totalcomprobante').innerHTML = tot - monto;         
                    if(tabla.id == 'tablaxportacion') {                        
                        var total = document.getElementById('totalE').innerHTML;
                        var pos = total.lastIndexOf(',');
                        var reemplazo = total.substring(0, pos) + '' + total.substring(pos + 1);
                        total = parseFloat(reemplazo) + monto;
                        document.getElementById('totalE').innerHTML = total;                                                
                    }
                    else if(tabla.id == 'tablagastos') {
                        
                        var total = document.getElementById('totalG').innerHTML;
                        var pos = total.lastIndexOf(',');
                        var reemplazo = total.substring(0, pos) + '' + total.substring(pos + 1);
                        total = parseFloat(reemplazo) + monto;
                        document.getElementById('totalG').innerHTML = total;                                                
                    }
                    else if(tabla.id == 'tablagerencia') {
               
                        var total = document.getElementById('totalGE').innerHTML;
                        var pos = total.lastIndexOf(',');
                        var reemplazo = total.substring(0, pos) + '' + total.substring(pos + 1);
                        total = parseFloat(reemplazo) + monto;
                        document.getElementById('totalGE').innerHTML = total;                                                
                    }
                    else if(tabla.id == 'tablafactura') {
                        var total = document.getElementById('totalF').innerHTML;
                        var pos = total.lastIndexOf(',');
                        var reemplazo = total.substring(0, pos) + '' + total.substring(pos + 1);
                        total = parseFloat(reemplazo) + monto;
                        document.getElementById('totalF').innerHTML = total;                                                
                    }
                    document.getElementById('tablacomprobante').deleteRow(e.parentNode.parentNode.rowIndex);                    
    }
   
   var grabarSD = function(formulario){
       $.ajax({
           url:'/Tesoreria/Mov-Dinero/DineroSD',
           headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
           type: 'POST',
           dataType: 'json',
           data:$("#"+formulario+"").serialize(),
           success: function(data){
               mensajeRegistro(data,formulario);
               document.getElementById('SDdocumento').click();
           },
           error:function(data){
               if(data.status==403){}
               else{
                   $("#error-fecha").html('');$("#error-monto").html('');$("#error-dni").html('');
                   $("#error-detalle").html('');$("#error-tipo").html('');
                   var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'fecha')$("#error-fecha").html(value);
                            else if(index == 'monto')$("#error-monto").html(value);
                            else if(index == 'dni')$("#error-dni").html(value);
                            else if(index == 'detalle')$("#error-detalle").html(value);
                            else if(index == 'tipo')$("#error-tipo").html(value);
                      });
               }
           }           
       });
   }
   
   $(document).ready().on('change','#comprobante',function(event){
                          
        if(event.target.value == 'VOUCHER' || event.target.value == 'RECIBO' || event.target.value == 'TRANSFERENCIA'){
            
            $("#divdireccion").hide();
            $("#divtelefono").hide();
        }
        else{            
            $("#divdireccion").show();
            $("#divtelefono").show();
        }                                                     
   });
      
   $(document).ready().on('click','#RegmovDoc',function(event){
       $.ajax({
          url:'/Tesoreria/Mov-Dinero',
           headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
           type: 'POST',
           dataType: 'json',
           data:$("#formDinero").serialize(),
           success: function(data){
               mensajeRegistro(data,'formDinero');
                        
           },
           error:function(data){
               if(data.status==403) $("#error-modal").empty().html(data.responseText);
               else {
                   $("#error-monto").html('');$("#error-tipo").html(''); $("#error-comprobante").html(''); $("#error-fecha").html(''); 
                   $("#error-ruc").html('');$("#error-razon").html('');$("#error-direccion").html('');$("#error-telefono").html('');
                   $("#error-concepto").html('');$("#error-numero").html('');
                   var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'monto')$("#error-monto").html(value);
                            else if(index == 'numero')$("#error-numero").html(value); 
                            else if(index == 'tipo')$("#error-tipo").html(value); 
                            else if(index == 'comprobante')$("#error-comprobante").html(value); 
                            else if(index == 'fecha')$("#error-fecha").html(value); 
                            else if(index == 'ruc')$("#error-ruc").html(value); 
                            else if(index == 'razon')$("#error-razon").html(value); 
                            else if(index == 'direccion')$("#error-direccion").html(value); 
                            else if(index == 'telefono')$("#error-telefono").html(value); 
                            else if(index == 'concepto')$("#error-concepto").html(value);                                                         
                      });
               }
           }
       });
   });
//*********************************************************************** ASIGNAR DIRECTIVOS **********************************************
$("#RegAsigDirectivos").click(function(event){
    var type='POST';
    var route = 'Asignacion-Directivos';
    if(event.target.text=='Actualizar'){
        type='PUT';
        route = 'Asignacion-Directivos/'+$("#id").val();
    }
    
    $.ajax({
       url:route,
       headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
       dataType: 'json',
       type:type,
       data:$("#formAsigDirec").serialize(),
       success:function(data){
            mensajeRegistro(data,'formAsigDirec');
            activarForm(18);
       },
       error:function(data){
           if(data.status==403) $("#error-modal").html(data.responseText);
           else{
                   $("#error-dni").html(''); $("#error-estado").html(''); $("#error-inicio").html(''); 
                   $("#error-final").html('');$("#error-cargo").html('');
                   var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'dni')$("#error-dni").html(value);                            
                            else if(index == 'estado')$("#error-estado").html(value); 
                            else if(index == 'inicio')$("#error-inicio").html(value); 
                            else if(index == 'final')$("#error-final").html(value); 
                            else if(index == 'directivo')$("#error-cargo").html(value);                                                                                 
                      });
               
           }
           
       }
    });
});

var  EditAsigDirectivos = function(id){
    $.getJSON("Asignacion-Directivos/"+id+"/edit",function(data){                    
         $("#dni").val(data.dni);
         $("#datos").val(data.datos);
         $("#directivo").val(data.cargos_directivos_id);
         $("#estado").val(data.estado);
         $("#inicio").val(data.fecha_inicio);
         $("#final").val(data.fecha_final);
         $("#id").val(id);
         $("#RegAsigDirectivos").text('Actualizar');         
     });
};

var ElimAsigDirectivos = function(id,nombre){
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro del DNI: ?</span><br><strong><span style='color:#ff0000'>"
           +nombre+"</span></strong></br>").then(function() {  
      var route = "Asignacion-Directivos/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
            if(data) activarForm(18);
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
}

//**********************************************************************  ASIGNAR DELEGADOS  **********************************************
var  EditAsigDelegado = function(id){
    $.getJSON("Asignacion-Delegados/"+id+"/edit",function(data){                    
         $("#dni").val(data.dni);
         $("#datos").val(data.datos);
         $("#delegado").val(data.cargos_delegados_id);
         $("#estado").val(data.estado);
         $("#inicio").val(data.fecha_inicio);
         $("#final").val(data.fecha_final);
         $("#id").val(id);
         $("#RegAsigDelegado").text('Actualizar');         
     });
};

var ElimAsigDelegado = function(id,nombre){
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro del DNI: ?</span><br><strong><span style='color:#ff0000'>"
           +nombre+"</span></strong></br>").then(function() {  
      var route = "Asignacion-Delegados/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
            if(data) activarForm(17);
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
}

$("#RegAsigDelegado").click(function(event){    
    var type='POST';
    var route = 'Asignacion-Delegados';
    if(event.target.text=='Actualizar'){
        type='PUT';
        route='Asignacion-Delegados/'+$("#id").val();
    }
    
    $.ajax({
       url: route,
       headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
       dataType: 'json',
       type:type,
       data:$("#formAsigDele").serialize(),
       success:function(data){
            mensajeRegistro(data,'formAsigDele');
            activarForm(17);
       },
       error:function(data){
           if(data.status==403) $("#error-modal").html(data.responseText);
           else{
                   $("#error-dni").html(''); $("#error-estado").html(''); $("#error-inicio").html(''); 
                   $("#error-final").html('');$("#error-cargo").html('');
                   var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'dni')$("#error-dni").html(value);                            
                            else if(index == 'estado')$("#error-estado").html(value); 
                            else if(index == 'inicio')$("#error-inicio").html(value); 
                            else if(index == 'final')$("#error-final").html(value); 
                            else if(index == 'delegado')$("#error-cargo").html(value);                                                                                 
                      });
               
           }
           
       }
    });
});
//********************************************************  EMPRESAS *********************************************************************
var ElimEmpresa = function(ruc){
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro de RUC: </span><br><strong><span style='color:#ff0000'>"
           +ruc+"?</span></strong></br>").then(function() {  
      var route = "Empresas/"+ruc+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
            if(data.success) activarForm(19);
            else $.alertable.alert("No se puede Eliminar el Registro "+ruc+"<br> Cuenta con Registros")
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
}

var EditEmpresa = function(ruc){
    $.getJSON("Empresas/"+ruc+"/edit",function(data){         
         $("#ruc").val(data.ruc);
         $("#id").val(data.ruc);
         $("#ruc").prop('disabled',true);
         $("#empresa").val(data.empresa);
         $("#direccion").val(data.direccion);         
         $("#RegEmpresa").text('Actualizar');         
     });
};

$("#RegEmpresa").click(function(event){
    var type='POST';var route='Empresas';
    if(event.target.text=='Actualizar'){
        type='PUT';route='Empresas/'+$("#id").val();
    }
    
    $.ajax({
       url:route,
       headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
       dataType: 'json',
       type:type,
       data:$("#formempresa").serialize(),
       success:function(data){
            mensajeRegistro(data,'formempresa');            
            activarForm(19);$("#ruc").prop('disabled',false);
       },
       error:function(data){
           if(data.status==403) activarmodal(0);
           else{
                   $("#error-ruc").html(''); $("#error-empresa").html(''); $("#error-direccion").html('');                    
                   var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'ruc')$("#error-ruc").html(value);                            
                            else if(index == 'empresa')$("#error-empresa").html(value); 
                            else if(index == 'direccion')$("#error-direccion").html(value);                                                                                                            
                      });
               
           }
           
       }
    });
});

// ************************************************************************ REPORTES **********************************************

$(document).ready().on('click','#Pdfgirocheques',function(e){
    $(this).attr('href','');
    var route = '/Tesoreria/Cheques-Girados/Reporte-cheques/' + $("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();
    $(this).attr('href',route);       
});

$(document).ready().on('click','#ExcelGiroCheque',function(e){
    if($("#anio").val() ==0) { $.alertable.alert("<span style='color:#ff0000'>SELECCIONE UN AÑO PARA PODER EXPORTAR EN EXCEL</span>"); e.preventDefault(); }
    $(this).attr('href','');
    var route = '/Tesoreria/Cheques-Girados/Excel-cheques/' + $("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();
    $(this).attr('href',route);       
});

$(document).ready().on('click','#pdfdistribucion',function(e){    
    $(this).attr('href','');
    var route = '/Tesoreria/Distribucion-Fondos/Distribucion-Pdf/' + $("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();
    $(this).attr('href',route);       
});
  
  $(document).ready().on('click','#exceldelivery',function(e){
      if($("#anio").val() ==0){ $.alertable.alert("<span style='color:#ff0000'>SELECCIONE UNA FECHA PARA PODER EXPORTAR EN EXCEL</span>");e.preventDefault();}
    $(this).attr('href','');
    var route = '/Tesoreria/Distribucion-Fondos/Distribucion-Excel/' + $("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();
    $(this).attr('href',route);       
});

$(document).ready().on('click','#excelMoney',function(e){    
    if($("#anio").val() ==0){ $.alertable.alert("<span style='color:#ff0000'>SELECCIONE UNA FECHA PARA PODER EXPORTAR EN EXCEL</span>");e.preventDefault();}    
    $(this).attr('href','');
    var route = '/Acopio/Fondos-Acopio/excel-Fondos-Acopio/' + $("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();
    $(this).attr('href',route);
});

$(document).ready().on('click','#pdfMoney',function(e){
    if($("#anio").val() ==0 && $("#mes").val() ==0) 
        { $.alertable.alert("<span style='color:#ff0000'>SELECCIONE UNA FECHA PARA PODER EXPORTAR EN PDF</span>");e.preventDefault();}
    $(this).attr('href','');
    var route = '/Acopio/Fondos-Acopio/Report-Fondos-Acopio/' + $("#anio").val()+'/'+$("#mes").val()+'/'+$("#buscar").val();
    $(this).attr('href',route);
});


//*********************************************  IMPORTAR DATOS DE EXCEL ******************************************

$(document).ready().on('click','#btndatos',function(event){
   
    var ruta = '/Datos';
    var formdata = new FormData($("#formdatos")[0]);    
    $.ajax({
        url:ruta,
        type:'POST',
        data:formdata,
        cache:false,
        contentType:false,
        processData:false,
        beforeSend: function(){
            var cargar = "<i class='fa fa-refresh fa-spin'></i>";
            $("#cargar").addClass('overlay').empty().html(cargar);
        },
        success:function(data){
            $("#cargar").removeClass('overlay').empty();
            mensajeRegistro(data,'formdatos');
        },
        error:function(data){
            if(!data.success)$.alertable.alert("Se Produjo un Error");
            else{
                $("#error-datos").html(''); 
                   var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'excel')$("#error-datos").html(value);                                                                                                                                       
                      });
            }
            $("#cargar").removeClass('overlay').empty();
        }
    });
})

// ******************************************************************************************  CERTIFICACION *****************************************
$("#RegCondicion").click(function(){
    var type = 'POST';
    var ruta = '/Certificacion/AddCondicion';
    if(event.target.text == 'Actualizar'){
        type = 'PUT';
        ruta = '/Certificacion/UpdateCondicion/'+$("#id").val();
    }
    
    $.ajax({        
        url:ruta,
        type:type,
        data:$("#formcondicion").serialize(),        
        success:function(data){    
            mensajeRegistro(data,'formcondicion');
            document.location.reload();
            
        },
        error:function(data){
            if(data.status==403) activarmodal(0);
            else{
                 $("#error-datos").html(''); $("#error-descripcion").html('');
                   var errors =  $.parseJSON(data.responseText);      
                    $.each(errors,function(index, value) {                      
                            if(index == 'condicion')$("#error-condicion").html(value); 
                            else if(index == 'descripcion')$("#error-descripcion").html(value);
                      });
            }           
        }
    })
});


function EditCondicion(id){
    $.getJSON('/Certificacion/Condicion/'+id+'/edit',function(data){
        $("#condicion").val(data.condicion);
        $("#descripcion").val(data.descripcion);
        $("#id").val(id);
        $("#RegCondicion").text('Actualizar');
    })
}

function ElimCondicion(id, name){
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar la condicion: </span><br><strong><span style='color:#ff0000'>"
           +name+"?</span></strong></br>").then(function() {  
      var route = "/Certificacion/Condicion/"+id+"";
      var token = $("input[name=_token]").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
            if(data.status==403) activarmodal(0);
            else if(data.success) document.location.reload();
            else $.alertable.alert("No se puede Eliminar la condicion "+name+"<br> Cuenta con Registros")
      },
      error:function(data){
          if(data.status==403) activarmodal(0);
      }
      });          
    });
}

//******************************  



   
  
   
  