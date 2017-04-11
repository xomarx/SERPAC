
@foreach($listas as $lista)
<title> CHEQUE {{$lista['cheques']->cheque}}</title>
@foreach($lista['listas'] as $list1)
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
<table width='100%' border="1" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <td colspan="6" align='center' style="color: #00a65a; font-size: 12">CHEQUES GIRADOS DE LA CUENTA {{$lista['cheques']->cheque}} Nro {{$lista['cheques']->num_cuenta}}</td>
        </tr>
        <tr>                
            <th colspan="6">MES DE {{$name}}</th>
        </tr>
        <tr style="font-size: 11">
            <th>FECHA</th>
            <th>CHEQUE</th>
            <th>PAGADO A LA ORDEN</th>
            <th>C/P</th>
            <th>CONCEPTO</th>
            <th>IMPORTE S/.</th>
        </tr>
    </thead>
    <tbody>
        {{--*/ @$total = 0 /*--}}
        @foreach($list1['movcheques'] as $list)
        {{--*/ @$total = $total + $list->importe /*--}}
        <tr style="font-size: 10">
            <td><?php $date = date_create($list->fecha);
echo date_format($date, "d-m") ?></td>
            <td align='center'>{{$list->num_cheque}}</td>
            <td>{{$list->nombre}} {{$list->paterno}} {{$list->materno }}</td>
            <td>{{$list->estado}}</td>
            <td>{{$list->concepto}}</td>
            <td>S/. {{$list->importe}}</td>
        </tr>           
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right">Total </td>
            <th>S/. {{$total}}</th>
        </tr>
    </tfoot>
</table><br>

@endforeach
@endforeach