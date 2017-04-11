<title>KARDEX DE DINERO</title>
<table width="100%" border="1">
    <thead>
        <tr>    
            <th colspan="{{$dias + 5}}">                
                <h2>KARDEX DE DINERO {{ $mes}}</h2></th>
        </tr>
        <tr style="background: #00a65a">
            <th rowspan="2">ACOPIADOR</th>
            <th rowspan="2">SECTOR</th>
            <th colspan="{{$dias}}">DIAS DEL MES</th>
            <th rowspan="2">TOTAL MES</th>
            <th rowspan="2">SALDO DIST. MES</th>
            <th rowspan="2">DEVOLUCION</th>
        </tr>
        <tr style="background: #00e765">
            @for($i = 1; $i <= $dias;$i++)
            <th>{{$i}}</th>
            @endfor            
        </tr>
    </thead>
    <tbody>
        @foreach($listas as $lista)
        <tr>
            <td>{{$lista['fondos']->paterno}} {{$lista['fondos']->materno}} {{$lista['fondos']->nombre}}</td>
            <td>{{$lista['fondos']->comite_local}}</td>
            {{--*/ @$name = 0 /*--}}
            {{--*/ @$monto = 0 /*--}}            
            @foreach($lista['pagos'] as $pago)                
                @for($i = 1;$i <= $pago->fecha - $name;$i++)
                @if( ($pago->fecha - $name) == $i)
                        <td>{{$pago->monto}}</td>
                @else
                <td></td>
                @endif                                    
                @endfor
                {{--*/ @$name = $pago->fecha /*--}}
                {{--*/ @$monto =$monto + $pago->monto /*--}}
            @endforeach
            <td colspan="{{$dias - $name}}"></td>
            <td>{{$monto}}</td>
            <td>{{$monto}}</td>
            <td>0</td>
        </tr>
        @endforeach
    </tbody>
</table>