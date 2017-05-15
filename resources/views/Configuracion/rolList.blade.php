
    @if(count($roles) > 0)
{{ csrf_field() }}
    <table class="table table-responsive table-hover" >
        <thead>
            <tr>
                <th style="border-bottom-color: #0089db; ">ROL</th>
                <th style="border-bottom-color: #0089db; ">TAG ROL</th>
                <th colspan="2" style="border-bottom-color: #0089db; ">DESCRIPCION</th>                          
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td> 
                    @permission('editar rol')
                    <a href="javascript:void(0);"  class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="EditRol({{$role->id}})"><span class="glyphicon glyphicon-ok"></span></a>
                    @endpermission
                    @permission('eliminar rol')
                    <a href="javascript:void(0);"  class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="ElimRol('{{$role->name}}',{{$role->id}})"><span class="glyphicon glyphicon-remove"></span></a>
                   @endpermission
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif
