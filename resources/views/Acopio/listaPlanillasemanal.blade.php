<table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>N° PLANILLA</th>
                    <th>COD ALMACEN</th>
                    <th>ALMACEN</th>
                    <th>USUARIO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planillas as $planilla)
                <tr>
                    <td>{{$planilla->fecha}}</td>
                    <td>{{$planilla->numero}}</td>
                    <td>{{$planilla->sucursalId }}</td>
                    <td>{{$planilla->sucursal}}</td>
                    <td>{{$planilla->name}}</td>
                    <td>
                        <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Excel"><span class="fa fa-file-excel-o" ></span></a>
                        <a class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Pdf"><span class="fa fa-file-pdf-o" ></span></a>
                        <a class="btn btn-sm btn-danger" onclick="EliPlanilla('{{$planilla->id}}','{{$planilla->numero }}')" ><span data-toggle="tooltip" data-placement="top" title="Anular" class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

