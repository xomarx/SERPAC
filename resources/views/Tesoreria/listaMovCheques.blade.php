       
@if(count($cheques) > 0)
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th style="border-bottom-color: #0089db; ">FECHA</th>
                        <th style="border-bottom-color: #0089db; ">CHEQUE</th>
                        <th style="border-bottom-color: #0089db; ">N° CHEQUE</th>
                        <th style="border-bottom-color: #0089db; ">IMPORTE S/.</th>
                        <th style="border-bottom-color: #0089db; ">APELLIDOS Y NOMBRES</th>
                        <th style="border-bottom-color: #0089db; ">CONCEPTO</th>
                        <th style="border-bottom-color: #0089db; ">USUARIO</th>
                        <th style="border-bottom-color: #0089db; ">ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cheques as $cheque)
                    {{--*/ @$name = '' /*--}}{{--*/ @$estado = '' /*--}}
                    @if($cheque->estado == 'ANULADO')
                    {{--*/ @$name ='text-red' /*--}}
                    {{--*/ @$estado ='disabled' /*--}}

                    @endif
                    <tr class="{{$name}}" >
                        <td>{{$cheque->created_at}}</td>
                        <td>{{$cheque->cheque}}</td>
                        <td>{{$cheque->num_cheque}} </td>
                        <td>{{$cheque->importe }}</td>
                        <td>{{$cheque->paterno}} {{$cheque->materno}} {{$cheque->nombre}}</td>
                        <td>{{$cheque->concepto}}</td>
                        <td>{{$cheque->name}}</td>
                        <td>
                            @if($estado != 'disabled')
                            {{--*/ @$evento =$cheque->id /*--}} {{--*/ @$numcheque =$cheque->num_cheque /*--}}
                            @else
                            {{--*/ @$evento =rand(1,100) /*--}} {{--*/ @$numcheque =rand(100,1000) /*--}}
                            @endif
                            @permission('editar movimientos')
                            <a onclick="EdiMovCheque('{{$evento}}')" class="btn btn-xs btn-primary {{$estado}}" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil" ></span></a>
                            @endpermission                            
                            @permission('eliminar movimientos')
                            <a onclick="AnulMovCheque('{{$evento}}','{{$cheque->cheque}}','{{$numcheque}}')" class= "btn btn-xs btn-danger {{$estado}}" data-toggle="tooltip" data-placement="top" title="Anular Cheque"><span  class="glyphicon glyphicon-remove"></span></a>
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {!! $cheques->links()!!}
            </div>        
@else
<p class="text-info text-center">-->NO se encontro ningun registro ... </p>
@endif
