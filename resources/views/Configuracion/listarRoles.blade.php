<a onclick="activarmodal(1);" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Rol">Nuevo Rol&nbsp;<span class="glyphicon glyphicon-education">  </span></a>
<div class="box box-body">
    <table class="table table-responsive table-hover" >
        <thead>
            <tr>
                <th>ROL</th>
                <th>TAG ROL</th>
                <th colspan="2">DESCRIPCION</th>                          
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td> 
                    <a href="javascript:void(0);"  class="btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Activar Usuario"><span class="glyphicon glyphicon-ok"></span></a>
                    <a href="javascript:void(0);"  class="btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Rol"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
