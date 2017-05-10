@extends('socios.mastersocio')
@section('contentheader_title')
    SOCIOS
@stop
@section('main-content')
@permission('ver socios')
<div class="box box-solid box-primary">
    <div class="box-header">  
        @permission('crear socios')
        <a id="nuevosocio" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Socio">NUEVO SOCIO  <span class="glyphicon glyphicon-plus"></span></a>
        @endpermission
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>        
    </div>
    <div class="box-body box-content" id="contenidos-box">
        @include('socios.sociosList')
    </div>   
</div>
<section id="conten-modal" >
</section>

@endpermission


@stop
@section('script')
<script>       
              
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
    
    var fundosocio = function(codigo,nombre,paterno,materno){
        var route = '/socios/modalfundo';        
        $.get(route,function(data){            
            $("#conten-modal").html(data);
            $("#tablainmueble tbody").remove();
            $("#tablacultivos tbody").remove();
            $("#tablafauna tbody").remove();
            $("#titulof").empty();
            $("#titulof").append('FUNDO DEL SOCIO: '+paterno + ' ' + materno + ' ' + nombre + ' CODIGO: '+codigo);
            $("#codigo_socios").val(codigo);
            $("#modal-form").modal();
        });        
    };
        
    var ParSocio = function (codigo,nombre,paterno,materno){       
        var route = '/socios/modalparientes';        
        $.get(route,function(data){            
            $("#conten-modal").html(data);
            $("#titulo").empty();
            $("#titulo").append('PARIENTES DE '+ paterno + ' ' + materno + ' '+nombre + ' ('+codigo+')');
            
            $("#modal-form").modal();
            $("#socios_codigo").val(codigo);
        });        
    };   
    
    $(document).ready(function(){
       $("#subsocios").addClass('active');
       $("#menusocios").addClass('active');
       activarForm(15);
    });
    $(document).ready().on('blur','#codigo',function(event){
        $("#codigo").empty();
        var num = event.target.value.length;var valor=''
        for(var i=0;i < 5 - num ; i++)
            valor = valor + '0';             
        $("#codigo").val('ACO-'+valor+event.target.value);
    });
    $("#buscar").keyup(function(event){
        activarForm(15);
    });
    
</script>
@endsection