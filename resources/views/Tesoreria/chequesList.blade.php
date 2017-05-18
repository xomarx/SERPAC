@permission('ver cheques')
        @if(count($cheques) > 0)
        {{ csrf_field() }}
        <table class="table table-hover table-responsive tablesorter" id="tablacheque">
            <thead>
                <tr>
                    <th style="border-bottom-color: #0089db; ">N°</th>
                    <th style="border-bottom-color: #0089db; ">CHEQUE</th>
                    <th style="border-bottom-color: #0089db; ">N° CUENTA</th>
                    <th style="border-bottom-color: #0089db; ">DESCRIPCION</th>
                    <th style="border-bottom-color: #0089db; ">ACCION</th>                    
                </tr>
            </thead>
            <tbody>
                {{--*/ @$name = 0 /*--}}
                @foreach($cheques as $cheque)
                {{--*/ @$name =$name + 1 /*--}}
                <tr>
                    <td>{{$name}}</td>
                    <td>{{$cheque->cheque}}</td>
                    <td>{{$cheque->num_cuenta}}</td>
                    <td>{{$cheque->descripcion}}</td>
                    <td>
                        @permission('editar cheques')
                        <a onclick="EdiCheque('{{$cheque->id}}')" href="javascript:void(0);" class=" btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar Cheque"><i class="glyphicon glyphicon-pencil" ></i></a>
                        @endpermission
                        @permission('eliminar cheques')
                        <a onclick="ElimCheque('{{$cheque->id}}','{{$cheque->cheque}}')" href="javascript:void(0);" class=" btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Cheque"><i class="glyphicon glyphicon-remove" ></i></a>
                        @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            <!--<p class="text-left">N° de Registros: 1 de {{count($cheques)}}</p>-->
            {!! $cheques->links()!!}
        </div>
        
        @else
        <p class="text-info text-center">-->NO se encontro ningun registro ... </p>
        @endif
    @endpermission