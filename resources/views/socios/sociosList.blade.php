@if(count($socios) > 0)
{{ csrf_field() }}

<table class="table table-hover table-responsive" id="tablesocio" >
            <thead>            
                <tr >
                    <th style="border-bottom-color: #0089db; ">FEC ASOCIADO</th>  
                    <th style="border-bottom-color: #0089db; ">CODIGO</th> 
                    <th style="border-bottom-color: #0089db; ">DNI</th>    
                    <th style="border-bottom-color: #0089db; ">SOCIOS</th>  
                    <th style="border-bottom-color: #0089db; ">COMITE LOCAL</th>
                    <th style="border-bottom-color: #0089db; ">COMITE CENTRAL</th>
                    <th style="border-bottom-color: #0089db; ">ESTADO</th>
                    <th style="border-bottom-color: #0089db; ">USUARIO</th>
                    <th style="border-bottom-color: #0089db; ">ACCION</th> 
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
                    <td>
                    @if($socio->estado == 'ACTIVO' || $socio->estado == 'REINSCRITO')
                            <i class="bg-green-active">{{$socio->estado}}</i>                        
                    @elseif($socio->estado == 'RETIRADO')
                    <i class="bg-orange-active">{{$socio->estado}}</i>
                    @else
                    <i class="bg-red-active">{{$socio->estado}}</i>
                    @endif
                    </td>
                    <td>{{$socio->name}}</td>
                    <td>                                    
                        <a href="{{url('PadronSocio')}}/{{$socio->codigo}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver" class="btn-xs btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>                        
                        @permission('crear parientes')
                            <a href="javascript:void(0)" onclick="ParSocio('{{$socio->codigo}}','{{$nombre }}','{{ $paterno }}','{{$materno }}')"  class="btn-info btn-xs"><span class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Parientes"></span></a>
                        @endpermission
                        @permission('crear fundos')
                        <a href="#" onclick="fundosocio('{{$socio->codigo}}','{{$nombre }}','{{ $paterno }}','{{$materno }}')" data-toggle='modal' data-target='#fundomodal' class="btn-success btn-xs" ><span data-toggle="tooltip" data-placement="top" title="Fundos" class="glyphicon glyphicon-home"></span></a>
                        @endpermission
                        @permission('editar socios')
                            <a  href="javascript:void(0)" onclick="EditSocio('{{$socio->codigo}}')"  class="btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar Socio"><span  class="glyphicon glyphicon-pencil"></span></a>
                        @endpermission
                        @permission ('eliminar socios')
                            <a href="javascript:void(0)" onclick="EliSocio('{{$socio->codigo}}','{{$name}}')" class="btn-xs btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar Socio" class="glyphicon glyphicon-remove"></span></a>
                        @endpermission
                    </td>                
                </tr>
                @endforeach
            </tbody>
        </table>
<div class="text-center">            
            {!! $socios->links()!!}
        </div>
        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif