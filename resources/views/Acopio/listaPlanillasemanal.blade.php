
@if(count($planillas) > 0)
<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
<table class="table table-hover" id="tablaplanilla">
            <thead>
                <tr>
                    <th style="border-bottom-color: #0089db; ">FECHA</th>
                    <th style="border-bottom-color: #0089db; ">N° PLANILLA</th>
                    <th style="border-bottom-color: #0089db; ">COD ALMACEN</th>
                    <th style="border-bottom-color: #0089db; ">ALMACEN</th>
                    <th style="border-bottom-color: #0089db; ">USUARIO</th>
                    <th style="border-bottom-color: #0089db; ">ACCION</th>
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
                        <a class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Excel"><span class="fa fa-file-excel-o" ></span></a>
                        <a class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Pdf"><span class="fa fa-file-pdf-o" ></span></a>
                        @permission('eliminar semanal')
                        <a class="btn btn-xs btn-danger" onclick="EliPlanilla('{{$planilla->id}}','{{$planilla->numero }}')" ><span data-toggle="tooltip" data-placement="top" title="Anular" class="glyphicon glyphicon-remove"></span></a>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
<div class="text-center">
    {!! $planillas->links()!!}
</div>
@else
<p class="text-info text-center">-->NO se encontro ningun registro ... </p>
@endif
