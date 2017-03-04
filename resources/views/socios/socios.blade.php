@extends('socios.mastersocio')
@section('contentheader_title')
    SOCIOS
@stop
@section('main-content')

<div class="box box-solid box-primary">
    <div class="box-header">        
        <center> <h3 class="box-title">LISTA DE SOCIOS</h3></center>
    </div>
    <div class="box-body">
        <a id="nuevosocio" data-toggle='modal' data-target='#editarsocios' class="btn btn-primary btn-sm m-t-10" ><span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nuevo Socio"> NUEVO</span></a>
        <table class="table table-responsive" id="myTable">
            <thead>            
            <th>FEC ASOCIADO</th>  
            <th>CODIGO</th> 
            <th>DNI</th>    
            <th>SOCIOS</th>  
            <th>COMITE LOCAL</th>
            <th>COMITE CENTRAL</th>
            <th>USUARIO</th>
            <th>ACCIONES</th>            
            </thead>
            <tbody>
                @foreach($socios as $socio)
                {{--*/ @$name = str_replace(' ','&nbsp;', $socio->codigo) /*--}}
                {{--*/ @$nombre = str_replace(' ','&nbsp;', $socio->nombre) /*--}}
                {{--*/ @$paterno = str_replace(' ','&nbsp;', $socio->paterno) /*--}}
                {{--*/ @$materno = str_replace(' ','&nbsp;', $socio->materno) /*--}}
                <tr>         
                    <td>{{$socio->fec_asociado}}</td>
                    <td>{{$socio->codigo}}</td>
                    <td>{{$socio->dni}}</td>
                    <td>{{$socio->paterno}} {{$socio->materno}} {{$socio->nombre}}</td>
                    <td>{{$socio->comite_local}}</td>
                    <td>{{$socio->comite_central}}</td>
                    <td>{{$socio->name}}</td>                    
                    <td>                                    
                        <a href="{{url('PadronSocio')}}/{{$socio->codigo}}" data-toggle="tooltip" data-placement="top" title="Ver"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a  href="#" onclick="EditSocio('{{$socio->codigo}}')" data-toggle='modal' data-target='#editarsocios' ><span data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#" onclick="EliSocio('{{$socio->codigo}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
                        <a href="#" onclick="ParSocio('{{$socio->codigo}}','{{$nombre }}','{{ $paterno }}','{{$materno }}')" data-toggle="modal" data-target="#pariente"><span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Parientes"></span></a>
                        <a href="#" onclick="fundosocio('{{$socio->codigo}}','{{$nombre }}','{{ $paterno }}','{{$materno }}')" data-toggle='modal' data-target='#fundomodal' ><span data-toggle="tooltip" data-placement="top" title="Fundos" class="glyphicon glyphicon-home"></span></a>
                    </td>                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
    </div>
</div>

<!--formulario de socios-->       
@include('socios.formsocio')       
<!--formulario de parientes-->
@include('socios.formParientes')

@include('socios.formFundo')


@stop
@section('script')
<script>       
    $("#flora").dblclick(function(event){        
        var tds = "<tr>";
        var tds = '<tr>';var idcul = $("#flora").val();
        tds += "{{--*/ @$idcultivo = str_replace(' ','&nbsp;',"idcul") /*--}}"
        tds += '<td>'+$("#flora option:selected").text()+'</td>';
        tds += '<td><input type="text" name="hectarea" id="hectarea" class="form-group-sm form-control"><div class="text-danger"></div></td>';
        tds += '<td><input type="text" name="rendimiento" class="form-group-sm form-control"><div class="text-danger"></div></td>';
        tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarcultivo(this.parentNode.parentNode.rowIndex,'+{{$idcultivo}}+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
        tds += '</tr>';
        $("#tablacultivos").append(tds);
        $("#flora option:selected").remove();
    });
    
     $("#fauna").dblclick(function(event){
        var tds = "<tr>";
        var tds = '<tr>';var idcul = $("#fauna").val();
        tds += "{{--*/ @$idfauna = str_replace(' ','&nbsp;',"idcul") /*--}}"
        tds += '<td>'+$("#fauna option:selected").text()+'</td>';
        tds += '<td><input type="number" class="form-control bfh-number" min="1" max="500"><div class="text-danger"></div></td>';
        tds += '<td><input type="text" name="rendimiento" class="form-group-sm form-control"><div class="text-danger"></div></td>';
        tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarfauna(this.parentNode.parentNode.rowIndex,'+{{$idfauna}}+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
        tds += '</tr>';
        $("#tablafauna").append(tds);
        $("#fauna option:selected").remove();
    });
    
     $("#inmueble").dblclick(function(event){
        var tds = "<tr>";
        var tds = '<tr>';var idcul = $("#inmueble").val();
        tds += "{{--*/ @$idinmueble = str_replace(' ','&nbsp;',"idcul") /*--}}"
        tds += '<td>'+$("#inmueble option:selected").text()+'</td>';
        tds += '<td>SI</td>';            
        tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarinmueble(this.parentNode.parentNode.rowIndex,'+{{$idinmueble}}+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
        tds += '</tr>';
        $("#tablainmueble").append(tds);
        $("#inmueble option:selected").remove();
    });
    
    
    var fundosocio = function(codigo,nombre,paterno,materno)
    {
        $("#tablainmueble tbody").remove();
        $("#tablacultivos tbody").remove();
        $("#tablafauna tbody").remove();
        $("#titulof").empty();
        $("#titulof").append('REGISTRO DE FUNDO DEL SOCIO: '+paterno + ' ' + materno + ' ' + nombre + ' CODIGO: '+codigo);
        $("#codigo_socios").val(codigo);
    }
            
$("#nuevosocio").click(function(event){
    $("#ActSocio").text('Registrar');
    $("#titulosocio").empty().append('<center>NUEVO SOCIO</center>');   
    $("#codigo").prop( "disabled", false );
        $("#dni").prop( "disabled", false );
   $("#formsocios")[0].reset();
});

   // ************  FECHAS DATETIME
    
    $("#fec_asociado").datepicker({
        autoclose: true,
        language: "es"
    });
    $("#fec_empadron").datepicker({
        autoclose: true,
        language: "es"
    });  
    $("#fec_nac").datepicker({
        autoclose: true,
        language: "es"
    });
    $("#fec_nac_1").datepicker({
        autoclose: true,
        language: "es"
    });
    $("#fecha").datepicker({
        autoclose: true,
        language: "es"
    });
             
    
    var ParSocio = function (codigo,nombre,paterno,materno)
    {
        $("#titulo").empty();
        $("#titulo").append('PARIENTES DE '+ paterno + ' ' + materno + ' '+nombre + ' ('+codigo+')');
        $("#socios_codigo").val(codigo);
    };   
    
//  lista ubigeo fundo
 $("#comite_centralf").change(function(event){          
     cargarComitelocal(event.target.value,"comite_local_id");     
 });
// 
 $("#distritof").change(function(event){     
     cargarcomite_central(event.target.value,"comite_centralf");
 });
  
 $("#provinciaf").change(function(event){     
      cargardistrito(event.target.value,"distritof");
 });

 $("#departamentof").change(function(event){     
     cargarprovincia(event.target.value,"provinciaf");
 });
                  
// ****************   lista ubigeo
  $("#comite_central").change(function(event){          
     cargarComitelocal(event.target.value,"comite_local");
 });
// 
 $("#distrito").change(function(event){     
     cargarcomite_central(event.target.value,"comite_central");
 });
  
 $("#provincia").change(function(event){     
     cargardistrito(event.target.value,"distrito");
 });

 $("#departamento").change(function(event){     
     cargarprovincia(event.target.value,"provincia");
 });
 
 // ****************   lista ubigeo
  $("#comite_central_1").change(function(event){   
      cargarComitelocal(event.target.value,"comites_locales_id");     
 });
// 
 $("#distrito_1").change(function(event){     
     cargarcomite_central(event.target.value,"comite_central_1");
 });
  
 $("#provincia_1").change(function(event){     
     cargardistrito(event.target.value,"distrito_1"); 
 });

 $("#departamento_1").change(function(event){     
     cargarprovincia(event.target.value,"provincia_1");
    
 });
 
</script>
@endsection