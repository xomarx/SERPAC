@if(count($recepcions) > 0)
<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >

<table class="table table-hover table-responsive tablesorter" id="tableRecepcion" >    
            <thead>
                <th style="border-bottom-color: #0089db; ">RECEPCION</th>
                <th style="border-bottom-color: #0089db; ">MONTO S/.</th>
            <th style="border-bottom-color: #0089db; ">DNI</th>
            <th style="border-bottom-color: #0089db; ">TECNICO</th> 
            <th style="border-bottom-color: #0089db; ">CENTRO DE ACOPIO</th>                            
            <th style="border-bottom-color: #0089db; ">COMITE LOCAL</th>
            <th style="border-bottom-color: #0089db; ">ESTADO</th>
            @permission('crear fondos')
            <th style="border-bottom-color: #0089db; ">ACCION</th>
            @endpermission
            </thead>
            <tbody>
                @foreach($recepcions as $recepcion)
                <tr>
                    <td>{{$recepcion->fecha }}</td>
                    <td>S/. {{number_format($recepcion->monto,2) }}</td>
                    <td >{{$recepcion->personas_dni }}</td>
                    <td>{{$recepcion->paterno }} {{$recepcion->materno }} {{ $recepcion->nombre }}</td>
                    <td>{{ $recepcion->sucursal }}</td>
                    <td>{{ $recepcion->comite_local }}</td>
                    
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
                        <a OnClick='ConforRecep(this,{{$recepcion->id}},{{$recepcion->monto}});' class="btn-xs btn-primary" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Grabar" ><span class="glyphicon glyphicon-saved"></span></a>
                        @else
                            <a class="btn-xs btn-primary"  data-toggle="tooltip" data-placement="top" title="Grabar"><span class="glyphicon glyphicon-saved"></span></a>
                        @endif
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
<div class="text-center">
    {!! $recepcions->links()!!}
</div>
@else
<p class="text-info text-center">-->NO se encontro ningun registro ... </p>
@endif