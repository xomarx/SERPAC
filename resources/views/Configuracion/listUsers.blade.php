<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table class="table table-hover table-borderless" >
    <thead>
        <tr>
            <th style="border-bottom-color: #0089db; ">USUARIO</th>
            <th style="border-bottom-color: #0089db; ">ROL</th>
            <th style="border-bottom-color: #0089db; ">CORREO</th>
            <th style="border-bottom-color: #0089db; ">EMPLEADO</th>
            <th style="border-bottom-color: #0089db; ">FECHA</th>
            <th style="border-bottom-color: #0089db; ">ESTADO</th>
            <th style="border-bottom-color: #0089db; ">ACCIONES</th>
        </tr>    
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
                        @if( $usuario->estado)
                            <a onclick="ActDesact('{{$usuario->name}}',{{$usuario->estado}})" style="cursor: pointer" class="btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Activar Usuario"><span class="fa fa-square-o"></span></a>                            
                        @else                        
                            <a onclick="ActDesact('{{$usuario->name}}',{{$usuario->estado}})" style="cursor: pointer" class="btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Inactivar Usuario"><span class="fa fa-check-square-o"></span></a>                                                                    
                        @endif 
                        <a onclick="modalrol('{{$usuario->name}}')" class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Asignar Rol" style="cursor: pointer" ><span class="glyphicon glyphicon-user"></span></a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
