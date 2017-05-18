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
              
    function AgreFlora (){        
        var tds = '<tr>'
        tds += '<td>'+$("#flora option:selected").text()+'</td>'+
        '<td><input type="number" name="hectarea" id="hectarea" class="form-control" min="1" max="100000"><div class="text-danger"></div></td>'+
        '<td><input type="text" name="rendimiento" class="form-group-sm form-control"><div class="text-danger"></div></td>'
        +'<td id="tdcultivo"><a href="#" onclick="Eliminarcultivo(this.parentNode.parentNode.rowIndex,'+$("#flora").val()+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>'+
        '</tr>';
        $("#tablacultivos").append(tds);
        $("#flora option:selected").remove();        
    };
    
    function AgregFauna(){
        
        var tds = '<tr>';
        tds += '<td>'+$("#fauna option:selected").text()+'</td>'+
        '<td><input type="number" class="form-control bfh-number" min="1" max="500"><div class="text-danger"></div></td>'
        +'<td><input type="text" name="rendimiento" class="form-group-sm form-control"><div class="text-danger"></div></td>'
        +'<td id="tdcultivo"><a href="#" onclick="Eliminarfauna(this.parentNode.parentNode.rowIndex,'+$("#fauna").val()+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>'
        + '</tr>';
        $("#tablafauna").append(tds);
        $("#fauna option:selected").remove();
    };
    
    
function AgregInmueble(){        
        
        var tds = '<tr>';       
        tds += '<td>'+$("#inmueble option:selected").text()+'</td>';
        tds += '<td>SI</td>';            
        tds += '<td id="tdcultivo"><a href="#" onclick="Eliminarinmueble(this.parentNode.parentNode.rowIndex,'+$("#inmueble").val()+')"><span class="glyphicon glyphicon-remove btn-danger"></span></a></td>';
        tds += '</tr>';
        $("#tablainmueble").append(tds);
        $("#inmueble option:selected").remove();
    };
    
    function fundosocio(codigo,nombre,paterno,materno){
        var route = '/Socios/modalfundo';
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
        
    function ParSocio(codigo,nombre,paterno,materno){       
        var route = '/Socios/modalparientes';        
        $.get(route,function(data){            
            $("#conten-modal").empty().html(data);
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