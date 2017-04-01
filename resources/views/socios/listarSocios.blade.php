@if( count($socios) > 0)
<table class="table table-responsive table-bordered table-hover  dataTable" role="grid">
            <thead>            
                <tr role='row'>
                    <th class="sorting">FEC ASOCIADO</th>  
                    <th class="sorting">CODIGO</th> 
                    <th class="sorting" >DNI</th>    
                    <th class="sorting">SOCIOS</th>  
                    <th class="sorting">COMITE LOCAL</th>
                    <th class="sorting">COMITE CENTRAL</th>
                    <th class="sorting">USUARIO</th>
                    <th>ACCION</th> 
                </tr>           
            </thead>
            <tbody>
                @foreach($socios as $socio)
                {{--*/ @$name = str_replace(' ','&nbsp;', $socio->codigo) /*--}}
                {{--*/ @$nombre = str_replace(' ','&nbsp;', $socio->nombre) /*--}}
                {{--*/ @$paterno = str_replace(' ','&nbsp;', $socio->paterno) /*--}}
                {{--*/ @$materno = str_replace(' ','&nbsp;', $socio->materno) /*--}}
                <tr>         
                    <td >{{$socio->fec_asociado}}</td>
                    <td>{{$socio->codigo}}</td>
                    <td>{{$socio->dni}}</td>
                    <td>{{$socio->paterno}} {{$socio->materno}} {{$socio->nombre}}</td>
                    <td>{{$socio->comite_local}}</td>
                    <td>{{$socio->comite_central}}</td>
                    <td>{{$socio->name}}</td>                    
                    <td>                                    
                        <a href="{{url('PadronSocio')}}/{{$socio->codigo}}" data-toggle="tooltip" data-placement="top" title="Ver" class="btn-sm btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>                        
                        @permission('crear parientes')
                            <a href="javascript:void(0)" onclick="ParSocio('{{$socio->codigo}}','{{$nombre }}','{{ $paterno }}','{{$materno }}')" data-toggle="modal" data-target="#pariente" class="btn-sm btn-info"><span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Parientes"></span></a>
                        @endpermission
                        @permission('crear fundos')
                        <a href="#" onclick="fundosocio('{{$socio->codigo}}','{{$nombre }}','{{ $paterno }}','{{$materno }}')" data-toggle='modal' data-target='#fundomodal' class="btn-sm btn-success" ><span data-toggle="tooltip" data-placement="top" title="Fundos" class="glyphicon glyphicon-home"></span></a>
                        @endpermission
                        @permission('editar socios')
                            <a  href="javascript:void(0)" onclick="EditSocio('{{$socio->codigo}}')"  class="btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar Socio"><span  class="glyphicon glyphicon-pencil"></span></a>
                        @endpermission
                        @permission ('eliminar socios')
                            <a href="javascript:void(0)" onclick="EliSocio('{{$socio->codigo}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar Socio" class="glyphicon glyphicon-remove"></span></a>
                        @endpermission
                    </td>                
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            {!! $socios->links() !!}
        </div>
@else
<br> 
<div class="text-bold">
    <label>...No se ha encontrado ningun registro de Socios</label>
</div>
@endif