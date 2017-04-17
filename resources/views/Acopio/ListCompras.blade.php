
@if(count($compras) > 0)
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token" >
<table class="table table-hover table-responsive tablesorter" id="tablecompras" >
            <thead>
            <th style="border-bottom-color: #0089db; ">FECHA</th>
            <th style="border-bottom-color: #0089db; ">N° REC</th>
            <th style="border-bottom-color: #0089db; ">CONDICION</th> 
            <th style="border-bottom-color: #0089db; ">KG</th>                            
            <th style="border-bottom-color: #0089db; ">COSTO</th>
            <th style="border-bottom-color: #0089db; ">TOTAL</th>
            <th style="border-bottom-color: #0089db; ">SOCIOS/NO SOCIOS</th>                        
            <th style="border-bottom-color: #0089db; ">ALMACEN</th>
            <th style="border-bottom-color: #0089db; ">USUARIO</th>
            <th style="border-bottom-color: #0089db; ">ACCION</th>
            </thead>
            <tbody>
                @foreach ($compras as $compra )
                {{--*/ @$nombre = str_replace(' ','&nbsp;', $compra->socios_codigo) /*--}}
                {{--*/ @$total = str_replace(' ','&nbsp;', round( ($compra->kilos*$compra->precio),2)) /*--}}
                <tr>
                    <td>{{$compra->fecha }}</td>
                    <td>{{$compra->enumeracion }}</td>
                    <td>{{$compra->condicion }}</td>
                    <td>{{number_format($compra->kilos,3) }}</td>
                    <td>{{number_format($compra->precio,2) }}</td>
                    <td>S/. {{number_format($total,2)}}</td>
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
                        
                        <a href="{{url('Acopio/Compra-Grano/Recibo-Compra')}}/{{$compra->id}}" target="_blank" class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Imprimir Recibo"><span class="glyphicon glyphicon-print" ></span></a>
                        
                        @permission('eliminar compras')
                        <a href="javascript:void(0)" onclick="AnulCompra('{{$compra->id}}','{{$nombre}}')" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Anular"><span  class="glyphicon glyphicon-remove"></span></a>
                        @endpermission
                    </td>
                </tr>                            
                @endforeach
            </tbody>
        </table>
<div class="text-center">    
    <p class="text-left">N° de Registros: 1 de {{count($compras)}}</p>
    {!! $compras->links()!!}
</div>
@else 
<p class="text-info text-center">-->NO se encontro ningun registro ... </p>
@endif