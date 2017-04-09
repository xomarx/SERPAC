<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
<table class="table table-responsive" id="myTable" >
            <thead>
            <th>DNI</th>
            <th>TECNICO</th> 
            <th>CENTRO DE ACOPIO</th>                            
            <th>MONTO</th>
            <th>RECEPCION</th>
            <th>ESTADO</th>                                                      
            <th>ACCION</th>            
            </thead>
            <tbody>
                @foreach($recepcions as $recepcion)
                <tr>
                    <td>{{$recepcion->personas_dni }}</td>
                    <td>{{$recepcion->paterno }} {{$recepcion->materno }} {{ $recepcion->nombre }}</td>
                    <td>{{ $recepcion->sucursal }}</td>
                    <td>{{ $recepcion->monto }}</td>
                    <td>{{$recepcion->fecha }}</td>
                    <td>
                        @if($recepcion->estado == null)
                        {!! Form::select('estado',['CONFORME'=>'Conforme','NO CONFORME'=>'No Conforme'],null,['id'=>'estado','placeholder'=>'Seleccione']) !!}
                        @else
                        {!! Form::select('estado',['CONFORME'=>'Conforme','NO CONFORME'=>'No Conforme'],null,['id'=>'estado','placeholder'=>$recepcion->estado,'disabled']) !!}
                        @endif
                    </td>
                    <td>                        
                        @permission('crear fondos')
                        @if($recepcion->estado == null)
                            <a OnClick='RecepConform({{$recepcion->id}});' class="btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Grabar" ><span class="glyphicon glyphicon-saved"></span></a>
                        @else
                            <a class="btn-xs btn-primary"  data-toggle="tooltip" data-placement="top" title="Grabar"><span class="glyphicon glyphicon-saved"></span></a>
                        @endif
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>