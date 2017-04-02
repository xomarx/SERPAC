@extends('socios.mastersocio')
@section('contentheader_title')
    SOCIOS
@stop
@section('main-content')
@permission('ver socios')
<div class="box box-solid box-primary">
    <div class="box-header">  
        @permission('crear socios')
        <a id="nuevosocio" class="btn btn-dropbox btn-sm m-t-10" data-toggle="tooltip" data-placement="top" title="Nuevo Socio">NUEVO  <span class="glyphicon glyphicon-plus"></span></a>
        @endpermission
    </div>
    <div class="box-body box-content" id="contenidos-box">
        <table class="table table-hover table-responsive" id="myTable" >
            <thead>            
                <tr >
                    <th >FEC ASOCIADO</th>  
                    <th >CODIGO</th> 
                    <th >DNI</th>    
                    <th >SOCIOS</th>  
                    <th >COMITE LOCAL</th>
                    <th >COMITE CENTRAL</th>
                    <th >USUARIO</th>
                    <th>ACCION</th> 
                </tr>           
            </thead>
            <tbody>
                @foreach($socios as $socio)
                {{--*/ @$name = str_replace(' ','&nbsp;', $socio->codigo) /*--}}
                {{--*/ @$nombre = str_replace(' ','&nbsp;', $socio->nombre) /*--}}
                {{--*/ @$paterno = str_replace(' ','&nbsp;', $socio->paterno) /*--}}
                {{--*/ @$materno = str_replace(' ','&nbsp;', $socio->materno) /*--}}
                <tr>         
                    <td >{{$socio->fec_asociado}}</td>
                    <td>{{$socio->codigo}}</td>
                    <td>{{$socio->dni}}</td>
                    <td>{{$socio->paterno}} {{$socio->materno}} {{$socio->nombre}}</td>
                    <td>{{$socio->comite_local}}</td>
                    <td>{{$socio->comite_central}}</td>
                    <td>{{$socio->name}}</td>                    
                    <td>                                    
                        <a href="{{url('PadronSocio')}}/{{$socio->codigo}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver" class="btn-xs btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>                        
                        @permission('crear parientes')
                            <a href="javascript:void(0)" onclick="ParSocio('{{$socio->codigo}}','{{$nombre }}','{{ $paterno }}','{{$materno }}')" data-toggle="modal" data-target="#pariente" class="btn-info btn-xs"><span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Parientes"></span></a>
                        @endpermission
                        @permission('crear fundos')
                        <a href="#" onclick="fundosocio('{{$socio->codigo}}','{{$nombre }}','{{ $paterno }}','{{$materno }}')" data-toggle='modal' data-target='#fundomodal' class="btn-success btn-xs" ><span data-toggle="tooltip" data-placement="top" title="Fundos" class="glyphicon glyphicon-home"></span></a>
                        @endpermission
                        @permission('editar socios')
                            <a  href="javascript:void(0)" onclick="EditSocio('{{$socio->codigo}}')"  class="btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar Socio"><span  class="glyphicon glyphicon-pencil"></span></a>
                        @endpermission
                        @permission ('eliminar socios')
                            <a href="javascript:void(0)" onclick="EliSocio('{{$socio->codigo}}','{{$name}}')" class="btn-xs btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar Socio" class="glyphicon glyphicon-remove"></span></a>
                        @endpermission
                    </td>                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>   
</div>
<section id="conten-modal">    
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
        console.log('hola mundo');
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
            $("#socios_codigo").val(codigo);
            $("#modal-form").modal();
        });        
    };   
    
    
</script>
@endsection