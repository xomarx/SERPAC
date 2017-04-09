<input type="hidden" name="_token" value="{{ csrf_token() }}" >
<table class="table table-hover table-responsive" id="myTable" >
                        <thead>
                        <th>DNI</th>
                        <th>TECNICO</th> 
                        <th>CENTRO DE ACOPIO</th>                            
                        <th>MONTO</th>
                        <th>FECHA</th>
                        <th>USUARIO</th>                                                           
                        <th>ACCION</th>            
                        </thead>
                        <tbody>
                            @foreach($distribucions as $distribucion)
                            {{--*/ @$name = str_replace(' ','&nbsp;', $distribucion->sucursal) /*--}}
                            <tr>                                                                                
                                <td>{{$distribucion->personas_dni}}</td>
                                <td>{{$distribucion->paterno}} {{$distribucion->materno}} {{$distribucion->nombre}}</td>
                                <td>{{$distribucion->sucursal}}</td>
                                <td>{{$distribucion->monto}}</td>
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