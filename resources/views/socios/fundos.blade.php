@extends('socios.mastersocio')
@section('contentheader_title')
    FUNDOS
@stop
@section('main-content')

@permission('ver fundos')
<div class="box box-primary box-solid">
    <div class="box-header">
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>  
    </div>
    <div class="box-body" id="contenidos-box">
        @include('socios.fundosList')
    </div>
</div>
<section id="conten-modal"></section>

@endpermission

@endsection

@section('script')
<script>
    
var EditarFundo = function(id){
    
    var route = '/Socios/modalfundo';        
        $.get(route,function(data){            
            $("#conten-modal").html(data);                                         
        });                    
    route = "{{url('Socios/fundos')}}/"+id+"/edit";   
    $.get(route,function(data){
                
        $("#idfundo").val(id);
        $("#codigo_socios").val(data.fundo.codigo);
        $("#titulof").empty();
        $("#titulof").append("FUNDO DEL SOCIO: "+data.fundo.paterno + " " +data.fundo.materno + " " + data.fundo.nombre+ " CODIGO: " + data.fundo.codigo);
        $("#fundo").val(data.fundo.fundo);        
        $("#estadofundo").val(data.fundo.estadofundo);
        $("#fecha").val(data.fundo.fecha);
        $("#direccion").val(data.fundo.direccion);
        $("#observaciones").val(data.fundo.observaciones);
        $("#departamento").val(data.fundo.departamentos_id);
        $("#provincia").empty();
        $("#provincia").append("<option value='" + data.fundo.provincias_id+"'>"+data.fundo.provincia+"</option>");
        $("#distrito").empty();
        $("#distrito").append("<option value='" + data.fundo.distritos_id+"'>"+data.fundo.distrito+"</option>");
        $("#comite_central").empty();
        $("#comite_central").append("<option value='" + data.fundo.comites_centrales_id+"'>"+data.fundo.comite_central+"</option>");
        $("#comite_local").empty();        
        $("#comite_local").append("<option value='" + data.fundo.comite_local_id+"'>"+data.fundo.comite_local+"</option>");
        $("#tablainmueble tbody").remove()
        
        $.each(data.inmuebles, function( index,value ){
            var tds = "<tr>";
            var tds = '<tr>';var idcul = value.id;
            tds += "{{--*/ @$idinmueble = str_replace(' ','&nbsp;',"idcul") /*--}}"
            tds += '<td>'+value.inmueble+'</td>';
            tds += '<td>SI</td>';            
            tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarinmueble(this.parentNode.parentNode.rowIndex,'+{{$idinmueble}}+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
            tds += '</tr>';
            $("#tablainmueble").append(tds);
            $("#inmueble").val(value.id);
            $("#inmueble option:selected").remove();
        });
        $("#tablacultivos tbody").remove();
        $.each(data.floras, function ( index, value){
            var tds = "<tr>";
            var tds = '<tr>';var idcul = value.id;
            tds += "{{--*/ @$idcultivo = str_replace(' ','&nbsp;',"idcul") /*--}}"
            tds += '<td>'+value.flora+'</td>';
            tds += '<td><input type="text" name="hectarea" id="hectarea" class="form-group-sm form-control" value="'+value.hectarea +'"><div class="text-danger"></div></td>';
            tds += '<td><input type="text" name="rendimiento" class="form-group-sm form-control" value="'+value.rendimiento +'"><div class="text-danger"></div></td>';
            tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarcultivo(this.parentNode.parentNode.rowIndex,'+{{$idcultivo}}+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
            tds += '</tr>';
            $("#tablacultivos").append(tds);
            $("#flora").val(value.id);
            $("#flora option:selected").remove();
        });
        $("#tablafauna tbody").remove();
        $.each(data.faunas, function ( index, value){
            var tds = "<tr>";
            var tds = '<tr>';var idcul = value.id;
            tds += "{{--*/ @$idfauna = str_replace(' ','&nbsp;',"idcul") /*--}}"
            tds += '<td>'+value.fauna+'</td>';
            tds += '<td><input type="number" class="form-control bfh-number" min="1" max="500" value="'+value.cantidad +'"><div class="text-danger"></div></td>';
            tds += '<td><input type="text" name="rendimiento" class="form-group-sm form-control" value="'+value.rendimiento +'"><div class="text-danger"></div></td>';
            tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarfauna(this.parentNode.parentNode.rowIndex,'+{{$idfauna}}+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
            tds += '</tr>';
            $("#tablafauna").append(tds);
            $("#fauna").val(value.id);
            $("#fauna option:selected").remove();
        });
            $("#Regfundo").text("ACTUALIZAR");
          $("#modal-form").modal();     
    });
};

var AgreFlora = function(){
        var tds = "<tr>";
        var tds = '<tr>';var idcul = $("#flora").val();
        tds += "{{--*/ @$idcultivo = str_replace(' ','&nbsp;',"idcul") /*--}}"
        tds += '<td>'+$("#flora option:selected").text()+'</td>';
        tds += '<td><input type="number" name="hectarea" id="hectarea" class="form-control" min="1" max="100000"><div class="text-danger"></div></td>';
        tds += '<td><input type="text" name="rendimiento" class="form-group-sm form-control"><div class="text-danger"></div></td>';
        tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarcultivo(this.parentNode.parentNode.rowIndex,'+{{$idcultivo}}+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
        tds += '</tr>';
        $("#tablacultivos").append(tds);
        $("#flora option:selected").remove();
    };
    
var AgregFauna = function(){
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
    };
    
var AgregInmueble = function(){        
        var tds = "<tr>";
        var tds = '<tr>';var idcul = $("#inmueble").val();
        tds += "{{--*/ @$idinmueble = str_replace(' ','&nbsp;',"idcul") /*--}}"
        tds += '<td>'+$("#inmueble option:selected").text()+'</td>';
        tds += '<td>SI</td>';            
        tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarinmueble(this.parentNode.parentNode.rowIndex,'+{{$idinmueble}}+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
        tds += '</tr>';
        $("#tablainmueble").append(tds);
        $("#inmueble option:selected").remove();
    };
    
    $(document).ready(function(){
        $("#subfundos").addClass('active');
        $("#menusocios").addClass('active');
        activarForm(6);
    });
     
     $(document).ready().on('keyup','#buscar',function(){
         activarForm(6);
     })
     
</script>
@stop

