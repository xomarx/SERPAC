@permission('ver empresas')
@if(count($empresas) > 0)
{{ csrf_field() }}
<table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="border-bottom-color: #0089db; ">EMPRESA</th>
                        <th style="border-bottom-color: #0089db; ">RUC</th>
                        <th style="border-bottom-color: #0089db; ">DIRECCION</th>            
                        <th style="border-bottom-color: #0089db; ">ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresas as $empresa)
                    <tr>
                        <td>{{$empresa->empresa}}</td>
                        <td>{{$empresa->ruc}}</td>
                        <td>{{$empresa->direccion}}</td>
                        <td>
                            @permission('editar empresas')
                            <a class="btn-xs btn-primary" onclick="EditEmpresa({{$empresa->ruc}})" style="cursor: pointer;"><i class="glyphicon glyphicon-pencil"></i></a>                            
                            @endpermission
                            @permission('eliminar empresas')
                            <a class="btn-xs btn-danger" onclick="ElimEmpresa({{$empresa->ruc}})" style="cursor: pointer;"><i class="glyphicon glyphicon-remove"></i></a>
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
<div class="text-center">            
            {!! $empresas->links()!!}
        </div>
        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif
        @endpermission