@permission('ver asigDirectivos')
@if(count($asigdirectivos) > 0)
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
        @foreach($asigdirectivos as $directivo)
        <tr>
            <td>{{$directivo->dni}}</td>
            <td>{{$directivo->datos}}</td>
            <td>{{$directivo->fecha_inicio}}</td>
            <td>{{$directivo->fecha_final}}</td>
            <td>{{$directivo->cargo_directivo}}</td>
            <td>{{$directivo->estado}}</td>
            <td>
                @permission('editar asigDirectivos')
                <a class="btn-xs btn-primary"  data-toggle='modal'  data-target='#modal-form' style="cursor: pointer" onclick="EditAsigDirectivos({{$directivo->id}})"><i class="glyphicon glyphicon-pencil"></i></a>
                @endpermission
                @permission('eliminar asigDirectivos')
                <a class="btn-xs btn-danger"  data-toggle='tooltip' title="Eliminar" style="cursor: pointer" onclick="ElimAsigDirectivos({{$directivo->id}},{{$directivo->dni}})"><i class="glyphicon glyphicon-remove"></i></a>
                @endpermission
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="text-center">            
            {!! $asigdirectivos->links()!!}
        </div>
        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif
        @endpermission