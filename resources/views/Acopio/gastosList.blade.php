<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th style="border-bottom-color: #0089db; ">FECHA</th>
                    <th style="border-bottom-color: #0089db; ">COMPROBANTE</th>
                    <th style="border-bottom-color: #0089db; ">N° </th>
                    <th style="border-bottom-color: #0089db; ">CONCEPTO</th>
                    <th style="border-bottom-color: #0089db; ">MONTO</th>
                    <th style="border-bottom-color: #0089db; ">ALMACEN</th>                    
                    <th style="border-bottom-color: #0089db; ">USUARIO</th>
                    <th style="border-bottom-color: #0089db; ">ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($egresos as $egreso)
                <tr>
                    <td>{{$egreso->fecha }}</td>
                    <td>{{$egreso->comprobante }}</td>
                    <td>{{$egreso->sucursal }}</td>
                    <td>{{$egreso->name }}</td>
                    <td>
                        <a class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-print"></span></a>
                        @permission('eliminar pagos')
                        <a class="btn btn-xs btn-danger" onclick="EliGasto('{{$egreso->id}}','{{$egreso->comprobante }}');" ><span class="glyphicon glyphicon-remove"></span></a>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>