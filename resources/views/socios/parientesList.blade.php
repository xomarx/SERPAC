@if(count($parientes) > 0)
{{ csrf_field() }}
<table class="table table-responsive" id="tablaparientes">
            <thead>   
                <tr>
                    <th style="border-bottom-color: #0089db; ">COD SOCIO</th>
                    <th style="border-bottom-color: #0089db; ">DNI</th>                                                   
                    <th style="border-bottom-color: #0089db; ">PARIENTE</th>
                    <th style="border-bottom-color: #0089db; ">APELLIDOS Y NOMBRES</th>
                    <th style="border-bottom-color: #0089db; ">ESTADO CIVIL</th>  
                    <th style="border-bottom-color: #0089db; ">DIRECCION</th>
                    <th style="border-bottom-color: #0089db; ">COMITE LOCAL</th>
                    <th style="border-bottom-color: #0089db; ">COMITE CENTRAL</th>
                    <th style="border-bottom-color: #0089db; ">USUARIO</th>
                    <th style="border-bottom-color: #0089db; ">ACCIONES</th>
                </tr>
            
            </thead>
            <tbody>
                @foreach($parientes as $pariente)
                <tr>                                         
                    <td>{{$pariente->socios_codigo}}</td>                                                        
                    <td>{{$pariente->dni}}</td>
                    <td>{{$pariente->tipo_pariente}}</td>
                    <td>{{$pariente->paterno}} {{$pariente->materno}} {{$pariente->nombre}}</td>
                    <td>{{$pariente->estado_civil}}</td>
                    <td>{{$pariente->direccion}}</td>
                    <td>{{ $pariente->comite_local }}</td>
                    <td>{{ $pariente->comite_central }}</td>
                    <td>{{ $pariente->name }}</td>
                    <td>      
                        @permission('editar parientes')
                            <a style="cursor: pointer;" onclick="editPariente('{{$pariente->socios_codigo}}','{{$pariente->dni}}')" class="btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                        @endpermission
                        @permission('eliminar parientes')
                        <a style="cursor: pointer;" onclick="ElimPariente('{{$pariente->dni}}','{{$pariente->socios_codigo}}')" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                        @endpermission
<!--<a data-toggle="modal" data-target="#pariente"><span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Parientes"></span></a>-->
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
<div class="text-center">            
            {!! $parientes->links()!!}
        </div>
        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif