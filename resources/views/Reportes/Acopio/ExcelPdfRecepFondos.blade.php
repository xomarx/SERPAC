<title>KARDEX DE DINERO </title>
@foreach($listas as $lista)
<table width="100%" border="1" cellpadding="1" cellspacing="0">
    <!--<table width="100%" border="1" cellspacing="0" cellpadding="2">-->
    <thead>
        <tr>    
            <th colspan="{{$lista['dias'] + 5}}">                
                <h2>KARDEX DE DINERO {{ $lista['meses']}}</h2></th>
        </tr>
        <tr style="background: #00a65a">
            <th rowspan="2">ACOPIADOR</th>
            <th rowspan="2">SECTOR</th>
            <th colspan="{{$lista['dias']}}">DIAS DEL MES</th>
            <th rowspan="2">TOTAL MES</th>
            <th rowspan="2">SALDO DIST. MES</th>
            <th rowspan="2">DEVOLUCION</th>
        </tr>
        <tr style="background: #00e765">
            @for($i = 1; $i <= $lista['dias'];$i++)
            <th>{{$i}}</th>
            @endfor            
        </tr>
    </thead>
    <tbody>
        {{--*/ @$total = [] /*--}}
        {{--*/ @$indice = [] /*--}}
        @foreach($lista['acopiadores'] as $acopiador)
        <tr>            
            <td>{{$acopiador['acopiador']->nombre}} {{$acopiador['acopiador']->paterno}} {{$acopiador['acopiador']->materno}}</td>
            <td>{{$acopiador['acopiador']->comite_local}}</td>
            {{--*/ @$name = 1 /*--}}
            {{--*/ @$monto = 0 /*--}} 
            {{--*/ @$espacio = 0 /*--}}
            @foreach($acopiador['dias'] as $montodias)
                {{--*/ @$contador = 0 /*--}}
                @for($i = $name;$i <= $montodias['dias'];$i++)
                    @if($i == $montodias['dias'])
                        @if($contador != 0)
                            <td colspan="{{$contador}}"></td>
                        @endif
                        <td>{{number_format($montodias['monto'],2)}}</td>
                        {{--*/ @$monto = $monto + $montodias['monto'] /*--}}
                        {{--*/ @$name = $montodias['dias']+1 /*--}}
                        {{--*/ @$espacio = $montodias['dias'] /*--}}
                        <?php  if(!in_array($i, $indice)){
                            $indice[] = $i; } ?>                                               
                        {{--*/ @$total[$i] = $total[$i] + $montodias['monto'] /*--}}
                        
                        @break;   
                    @else
                        {{--*/ @$contador = $contador + 1 /*--}}
                    @endif
                @endfor
            @endforeach
            @if(($lista['dias'] - $espacio) != 0)
                <td colspan="{{$lista['dias'] - $espacio}}"></td>
                @endif
            <td>
                {{number_format($monto,2)}}
                {{--*/ @$total[34] = $total[34] + $monto /*--}}
            </td>
            <td>{{number_format($monto,2)}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" align='center'>TOTAL</td>
            {{--*/ @$spaciofooter = 0 /*--}}
            <?php natsort($indice) ?>
           @foreach($indice as $index)
                @if($index - $spaciofooter != 1 )
                    <td colspan="{{ $index - $spaciofooter -1 }}"></td>
                @endif
                      
                <td>{{number_format($total[$index],2)}}</td>
                {{--*/ @$spaciofooter = $index /*--}}
                <!--{{$spaciofooter}}-->
           @endforeach
           @if(($lista['dias'] -  $spaciofooter) != 0)
           <td colspan="{{$lista['dias'] -  $spaciofooter}}"></td>
           @endif
           <td>{{number_format($total[34],2)}}</td>
           <td>{{number_format($total[34],2)}}</td>
           <td></td>
        </tr>
    </tfoot>
</table>
<div  style="page-break-after: always;"></div>
@endforeach



