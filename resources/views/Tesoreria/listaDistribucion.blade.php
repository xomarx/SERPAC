@if(count($distribucions) > 0)
<input type="hidden" name="_token" value="{{ csrf_token() }}" >
<table class="table table-hover table-responsive tablesorter" id="tabledistribucion" >
                        <thead >
                        <th style="border-bottom-color: #0089db; ">CHEQUE</th>
                        <th style="border-bottom-color: #0089db; ">N° CHEQUE</th>
                        <th style="border-bottom-color: #0089db; " >DNI</th>
                        <th style="border-bottom-color: #0089db; ">TECNICO</th> 
                        <th style="border-bottom-color: #0089db; ">CENTRO DE ACOPIO</th>                            
                        <th style="border-bottom-color: #0089db; ">MONTO S/.</th>
                        <th style="border-bottom-color: #0089db; ">FECHA</th>
                        <th style="border-bottom-color: #0089db; ">USUARIO</th>                                                           
                        <th style="border-bottom-color: #0089db; ">ACCION</th>
                               
                        </thead>
                        <tbody>
                            @foreach($distribucions as $distribucion)
                            {{--*/ @$name = str_replace(' ','&nbsp;', $distribucion->sucursal) /*--}}
                            <tr>   
                                <td>{{$distribucion->cheque}}</td>
                                <td>{{$distribucion->num_cheque}}</td>
                                <td>{{$distribucion->personas_dni}}</td>
                                <td>{{$distribucion->paterno}} {{$distribucion->materno}} {{$distribucion->nombre}}</td>
                                <td>{{$distribucion->sucursal}}</td>
                                <td>S/. {{$distribucion->monto}}</td>
                                <td>{{$distribucion->fecha}}</td>                                    
                                <td>{{$distribucion->name}}</td>
                                <td>                                    
                                    <a href="{{url('Tesoreria/Distribucion/ReciboAcopio') }}/{{$distribucion->id}}" class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Imprimir Recibo Acopio" target="_blank" ><span class="glyphicon glyphicon-print"></span></a>                                    
                                    @permission('eliminar distribucion')
                                    <a href="javascript:void(0);" onclick="AnulDistribucion('{{$distribucion->id}}','{{$name}}')" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Anular Distribucion" ><span class="glyphicon glyphicon-remove"></span></a>
                                    @endpermission
                                </td>                    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
<div class="text-center">
    {!! $distribucions->links()!!}
</div>
@else
<p class="text-info text-center">-->NO se encontro ningun registro ... </p>
@endif