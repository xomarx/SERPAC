@permission('ver almacen')
@if(count($sucursales) > 0)

<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table table-responsive" id="tablaSucursal" >
                <thead>
                <th style="border-bottom-color: #0089db; ">AREA</th>
                <th style="border-bottom-color: #0089db; ">CODIGO</th> 
                <th style="border-bottom-color: #0089db; ">CENTRO DE ACOPIO</th>
                <th style="border-bottom-color: #0089db; ">ACOPIADOR</th>                
                <th style="border-bottom-color: #0089db; ">COMITE LOCAL</th>
                <th style="border-bottom-color: #0089db; ">COMITE CENTRAL</th>
                <th style="border-bottom-color: #0089db; ">DISTRITO</th>
                <th style="border-bottom-color: #0089db; ">PROVINCIA</th>                            
                <th style="border-bottom-color: #0089db; ">ACCIONES</th>            
                </thead>
                <tbody>
                    @foreach($sucursales as $sucursal)
                    {{--*/ @$name = str_replace(' ','&nbsp;', $sucursal->sucursal) /*--}}
                    <tr>                                                                                
                        <td>{{$sucursal->area}}</td>
                        <td>{{$sucursal->sucursalId}}</td>
                        <td>{{$sucursal->sucursal}}</td>
                        <td>{{$sucursal->acopiador}}</td>                        
                        <td>{{$sucursal->comite_local}}</td>
                        <td>{{$sucursal->comite_central}}</td>
                        <td>{{$sucursal->distrito}}</td>
                        <td>{{$sucursal->provincia}}</td>
                        <td>
                            @permission('editar almacen')
                            <a style="cursor: pointer" onclick="Editsucur('{{$sucursal->sucursalId}}')" class="btn-primary btn-xs" data-toggle="tooltip" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>                                                        
                            @endpermission
                            @permission('eliminar almacen')
                            <a style="cursor: pointer" onclick="EliSucursal('{{$sucursal->sucursalId}}','{{$name}}')" class="btn-danger btn-xs"  title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                            @endpermission
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
<div class="text-center">            
            {!! $sucursales->links()!!}
        </div>
        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif
        @endpermission