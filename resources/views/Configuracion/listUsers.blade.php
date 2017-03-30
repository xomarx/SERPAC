<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table class="table table-hover table-borderless" >
    <thead>
    <th>USUARIO</th>
    <th>ROL</th>
    <th>CORREO</th>
    <th>EMPLEADO</th>
    <th>FECHA</th>
    <th>ESTADO</th>
    <th>ACCIONES</th>
</thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->rol}}</td>
                    <td ><a href="mailto:acopagro@acopagro.com.pe?subject=Feedback&body=Message">{{$usuario->email}}</a> </td>
                    <td>{{$usuario->paterno}} {{$usuario->materno}} {{$usuario->nombre}}</td>
                    <td>{{$usuario->created_at}}</td>
                    <td >
                        @if( $usuario->estado)
                            <i class="bg-red-gradient">INACTIVO</i>                      
                        @else
                            <i class="bg-green-active ">ACTIVO </i>                          
                        @endif                        
                    </td>
                    <td>
                        <a onclick="modalrol('{{$usuario->name}}')" class="btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Asignar Rol" style="cursor: pointer" ><span class="glyphicon glyphicon-user"></span></a>
                        <a onclick="ActDesact('{{$usuario->name}}')" style="cursor: pointer" class="btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Activar o Desactivar Usuario"><span class="glyphicon glyphicon-check"></span></a>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
