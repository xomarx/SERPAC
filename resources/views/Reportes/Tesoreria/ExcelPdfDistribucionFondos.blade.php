<title>DISTRIBUCION DE FONDOS</title>
@foreach($listas as $lista)
<table >
    <tr>
        <td width='40px'>
            <img src="http://acopagro.com.pe/wp-content/uploads/2015/02/logo-png-horizontal-e1423034456225.png" style="width: 120px; height: 70px;"/>
        </td>
        <th><h2>DISTRIBUCION DE FONDOS DE ACOPIO DEL {{$lista['anios']}}</h2></th>
    </tr>            
</table>
       @foreach($lista['lista2'] as $list1)
       
            @if($list1['meses'] == 1)
            {{--*/ @$name = ENERO /*--}}
            @elseif($list1['meses'] == 2)
            {{--*/ @$name = FEBRERO /*--}}
            @elseif($list1['meses'] == 3)
            {{--*/ @$name = MARZO /*--}}
            @elseif($list1['meses'] == 4)
            {{--*/ @$name = ABRIL /*--}}
            @elseif($list1['meses'] == 5)
            {{--*/ @$name = MAYO /*--}}
            @elseif($list1['meses'] == 6)
            {{--*/ @$name = JUNIO /*--}}
            @elseif($list1['meses'] == 7)
            {{--*/ @$name = JULIO /*--}}
            @elseif($list1['meses'] == 8)
            {{--*/ @$name = AGOSTO /*--}}
            @elseif($list1['meses'] == 9)
            {{--*/ @$name = SEPTIEMBRE /*--}}
            @elseif($list1['meses'] == 10)
            {{--*/ @$name = OCTUBRE /*--}}
            @elseif($list1['meses'] == 11)
            {{--*/ @$name = NOVIEMBRE /*--}}
            @elseif($list1['meses'] == 12)
            {{--*/ @$name = DICIEMBRE /*--}}
            @endif
            <table width="100%" border="1" cellspacing="0" cellpadding="2">
                <caption>MES DE {{$name}}</caption>
            @foreach($list1['lista1'] as $list)            
            <thead style="font-size: 12;">            
                <tr>
                    <th>{{$list['cheque']->cheque}}</th>
                    <th>Nro. {{$list['cheque']->num_cheque}}</th>
                    <th colspan="2">S/. {{number_format($list['cheque']->importe,2)}}</th>
                    <th>FECHA</th>
                    <th><?php $date = date_create($list['cheque']->created_at); echo date_format($date, 'd-m-Y') ?></th>
                </tr>
                <tr>
                    <th>FECHA</th>
                    <th>RECIBO</th>
                    <th colspan="2" >DISTRIBUCION DE FONDOS</th>
                    <th>IMPORTE S/.</th>
                    <th>SALDO S/.</th>
                </tr>
            </thead>      
            <tbody style="font-size: 10;">
                {{--*/ @$monto=$list['cheque']->importe  /*--}}
                {{--*/ @$sumador=0  /*--}}
                @foreach($list['listas'] as $mov)            
                <tr>
                    <td>{{$mov->fecha}}</td>
                    <td>{{$mov->enumeracion}}</td>
                    <td colspan="2">{{$mov->sucursal}}</td>
                    <td align='center'>{{number_format($mov->monto,2)}}</td>
                    {{--*/ @$monto=$monto - $mov->monto  /*--}}
                    {{--*/ @$sumador=$sumador + $mov->monto  /*--}}
                    <td align='center'>{{number_format($monto,2)}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" align='center'>TOTAL </td>
                    <td align='center'>{{number_format($sumador,2)}}</td>
                    <td align='center'>{{number_format(($list['cheque']->importe - $sumador),2)}}</td>
                </tr> 
                <tr><td style="border: none; " colspan="6">&nbsp;&nbsp;</td></tr>
                </tfoot>    
        
        @endforeach    
        </table>
            <br>
    @endforeach         
<div  style="page-break-after: always;"></div>
@endforeach