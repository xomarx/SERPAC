@permission('ver asig delegados')
@if(count($asignaciones) > 0)
{{ csrf_field() }}
<table class="table table-hover table-responsive table-condensed">
    <thead>
        <tr>
            <th style="border-bottom-color: #0089db; ">DNI</th>
            <th style="border-bottom-color: #0089db; ">APELLIDOS Y NOMBRES</th>
            <th style="border-bottom-color: #0089db; ">INICIO</th>
            <th style="border-bottom-color: #0089db; ">FINAL</th>
            <th style="border-bottom-color: #0089db; ">CARGO</th>
            <th style="border-bottom-color: #0089db; ">ESTADO</th>            
            <th style="border-bottom-color: #0089db; ">ACCION</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asignaciones as $asignacion)
        <tr>
            <td>{{$asignacion->dni}}</td>
            <td>{{$asignacion->datos}}</td>
            <td>{{$asignacion->fecha_inicio}}</td>
            <td>{{$asignacion->fecha_final}}</td>
            <td>{{$asignacion->cargo_delegado}}</td>
            <td>{{$asignacion->estado}}</td>
            <td>
                @permission('editar asig delegados')
                <a class="btn-xs btn-primary"  data-toggle='modal'  data-target='#modal-form' style="cursor: pointer" onclick="EditAsigDelegado({{$asignacion->id}})"><i class="glyphicon glyphicon-pencil"></i></a>
                @endpermission
                @permission('eliminar asig delegados')
                <a class="btn-xs btn-danger"  data-toggle='tooltip' title="Eliminar" style="cursor: pointer" onclick="ElimAsigDelegado({{$asignacion->id}},{{$asignacion->dni}})"><i class="glyphicon glyphicon-remove"></i></a>
                @endpermission
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="text-center">            
            {!! $asignaciones->links()!!}
        </div>
        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif
        @endpermission