@if(count($fundos) > 0)
{{ csrf_field() }}
<table class="table table-responsive" id="fundotable" >
            <thead>  
                <tr>
                    <th style="border-bottom-color: #0089db; ">CODIGO</th> 
            <th style="border-bottom-color: #0089db; ">FUNDO</th>
            <th style="border-bottom-color: #0089db; ">ESTADO</th>                              
            <th style="border-bottom-color: #0089db; ">HECTAREAS</th>
            <th style="border-bottom-color: #0089db; ">COMITE LOCAL</th>
            <th style="border-bottom-color: #0089db; ">COMITE CENTRAL</th>
            <th style="border-bottom-color: #0089db; ">FECHA</th>
            <th style="border-bottom-color: #0089db; ">ACCIONES</th>  
                </tr>
                      
            </thead>
            <tbody>
                @foreach($fundos as $fundo)
                {{--*/ @$name = str_replace(' ','&nbsp;', $fundo->fundo) /*--}}
                <tr>                                            
                    <td>{{$fundo->codigo_socios}}</td>
                    <td>{{$fundo->fundo}}</td>
                    <td>{{$fundo->estadofundo}}</td>
                    <td>{{$fundo->hectareas}}</td>
                    <td>{{$fundo->comite_local}}</td>
                    <td>{{$fundo->comite_central}}</td>
                    <td>{{$fundo->fecha}}</td>                                                        
                    <td>       
                        @permission('editar fundos')
                        <a href="#"  OnClick='EditarFundo({{$fundo->id}});' class="btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar Fundo"><span class="glyphicon glyphicon-pencil"></span></a>
                        @endpermission
                        @permission('eliminar fundos')
                        <a href="#" onclick="EliminarFundo('{{$fundo->id}}','{{$name}}')" class="btn-xs btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
                        @endpermission
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>

<div class="text-center">            
            {!! $fundos->links()!!}
        </div>
        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif