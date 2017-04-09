@extends('Acopio.masteracopio')
@section('contentheader_title')
    COMPRA DE GRANOS
@stop
@section('main-content')

@permission('ver compras')
<div class="box box-solid box-primary">
    <div class="box-header">
        @permission('crear compras')
        <a id="nuevacompra"  class="btn btn-dropbox btn-sm" data-toggle="tooltip" data-placement="top" title="COMPRAR GRANO"><span class="glyphicon glyphicon-plus"> COMPRAR</span></a>
        @endpermission
    </div>
    <div class="box-body">
        <table class="table table-responsive" id="myTable" >
            <thead>
            <th>FECHA</th>
            <th>CONDICION</th> 
            <th>KG</th>                            
            <th>COSTO</th>
            <th>TOTAL</th>
            <th>SOCIOS/NO SOCIOS</th>                        
            <th>ALMACEN</th>
            <th>USUARIO</th>
            <th>ACCIONES</th>
            </thead>
            <tbody>
                @foreach ($compras as $compra )
                {{--*/ @$nombre = str_replace(' ','&nbsp;', $compra->socios_codigo) /*--}}
                {{--*/ @$total = str_replace(' ','&nbsp;', round( ($compra->kilos*$compra->precio),2)) /*--}}
                <tr>
                    <td>{{$compra->fecha }}</td>
                    <td>{{$compra->condicion }}</td>
                    <td>{{$compra->kilos }}</td>
                    <td>{{$compra->precio }}</td>
                    <td>{{$total}}</td>
                    <td>
                        @if ( $compra->socios_codigo == '')
                        {{$compra->npaterno}} {{$compra->nmaterno}} {{$compra->nnombres}}
                        @else
                        {{$compra->paterno}} {{$compra->materno}} {{$compra->nombre}}
                        @endif
                    </td>                                
                    <td>{{$compra->sucursal }}</td>
                    <td>{{$compra->name }}</td>  
                    <td>
                        <a href="" target="_blank" class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Imprimir Recibo"><span class="glyphicon glyphicon-print" ></span></a>
                        <a href="javascript:void(0)" onclick="AnulCompra('{{$compra->id}}','{{$nombre}}')" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Anular"><span  class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>                            
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<section id="conten-modal"></section>
@endpermission

@stop

@section('script')
<script>   
    

   var habilita = function(){
       $("#sisocio").show();
       $("#nosocio").hide();
       $("#paterno").val('');$("#materno").val('');$("#nombres").val('');$("#dni").val('');
   };
   
   var desabilita = function(){
       $("#nosocio").show();
       $("#sisocio").hide();
       
       $("#socio").val('');               
       $("#codigo").val('');
       $("#comite").val('');
   }; 
    
 
   var numerorecibo = function(idrecibo){
       var route = "{{url('codrecibos')}}/"+idrecibo;       
       $.getJSON(route,function(data){           
           $("#numero").val(data);
       })
   }
   
            
   $(document).ready(function (){
      $("#menuacopio").addClass('active');
      $("#subcompras").addClass('active');
   });

</script>

@stop