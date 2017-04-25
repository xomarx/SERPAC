<html>
    <title>PLANILLA SEMANAL</title>
    <head>
        <table width="100%" >
            <thead>
                <tr>
                    <th rowspan="2"><img src="http://acopagro.com.pe/wp-content/uploads/2015/02/logo-png-horizontal-e1423034456225.png" style=" height: 70px; width: 80px;" />
                    </th>
                    <th colspan="12" style="font-size: 20">COOPERATIVA AGRARIA CACAOTERA ACOPAGRO Ltda.</th>
                    <th style="color: red;" width="100px">Nro. {{$planillas->numero}}</th>
                </tr>
                <tr>
                    <th colspan="12"  style="font-size: 16">PLANILLA DE ACOPIO Y BENEFICIO CENTRALIZADO DE CACAO</th>
                    <td></td>
                </tr>
            </thead>  
            <tbody>
                <tr style="font-size: 10">
                    <td colspan="3">CODIGO DE CENTRO DE ACOPIO: </td>
                    <td colspan="3" align="center" style="border-bottom: #000000 solid;">{{$planillas->sucursales_sucursalId}}</td>
                    <td colspan="2" align="center">Nro. SUB LOTE: </td>
                    <td colspan="3" align="center" style="border-bottom: #000000 solid;">16/105</td>
                    <td align="center">FECHA: </td>
                    <td colspan="2" align="center" style="border-bottom: #000000 solid;"><?php $date = date_create($planillas->fecha); setlocale(LC_TIME, 'spanish'); echo strtoupper(strftime("%B del %Y", strtotime($planillas->fecha))); ?></td>            
                </tr>        
            </tbody>
        </table>
        <table width="100%" >
            <thead>
                <tr style="font-size: 10">
                    <td colspan="1">ORGANICO IMO: </td>
                    <td align="center" width="30px">
                        @if($planillas->condicion == 'ORGANICO IMO')
                        <input type="checkbox" name="planilla" checked="checked"/>
                        @else
                            <input type="checkbox" name="planilla"/>
                        @endif
                    </td>
                    <td colspan="1">ORGANICO CERES: </td>
                    <td align="center" width="30px">
                        @if($planillas->condicion == 'ORGANICO CERES')
                        <input type="checkbox" name="planilla" checked="checked"/>
                        @else
                            <input type="checkbox" name="planilla"/>
                        @endif
                    </td>
                    <td colspan="1">CONVENCIONAL SOCIO:</td>
                    <td align="center" width="30px">
                        @if($planillas->condicion == 'CONVENCIONAL SOCIO')
                        <input type="checkbox" name="planilla" checked="checked"/>
                        @else
                            <input type="checkbox" name="planilla"/>
                        @endif
                    </td>
                    <td colspan="2">CONVENCIONAL NO SOCIO: </td>
                    <td align="left" width="100px">
                        @if($planillas->condicion == 'CONVENCIONAL NO SOCIO')
                        <input type="checkbox" name="planilla" checked="checked"/>
                        @else
                            <input type="checkbox" name="planilla"/>
                        @endif
                    </td>
                    <td width="40px">RFA: </td>
                    <td align="center" width="30px">
                        @if($planillas->condicion == 'RFA')
                        <input type="checkbox" name="planilla" checked="checked"/>
                        @else
                            <input type="checkbox" name="planilla"/>
                        @endif
                    </td>
                    <td width="40px">UTZ: </td>
                    <td align="center" width="30px">
                        @if($planillas->condicion == 'UTZ')
                        <input type="checkbox" name="planilla" checked="checked"/>
                        @else
                            <input type="checkbox" name="planilla"/>
                        @endif
                    </td>
                </tr>
            </thead>
        </table>
    </head>
    <body>
        <table border="1" cellspacing="0" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size: 12">
                    <th width='70px'>FECHA</th>
                <th width='70px'>CODIGO SOCIO</th>
                <th width='380px'>APELLIDOS Y NOMBRES</th>
                <th>GRADO I</th>
                <th>GRADO II</th>
                <th>KG.</th>
                <th>P.U. S/.</th>
                <th>TOTAL S/. </th>
                <th>FIRMA</th>
                </tr>       
            </thead>
            <tbody>
                {{--*/ @$total = 0 /*--}}
                {{--*/ @$kilos = 0 /*--}}        
                @foreach($compras as $compra)
                <tr style="font-size: 9">
                    <td>{{$compra->fecha}}</td>
                    <td>{{$compra->socios_codigo}}{{$compra->dni}}</td>
                    <td>{{$compra->socio}} {{$compra->nosocio}}</td>
                    @if($compra->tipocacao == 'GRADO I')
                    <td align='center'>{{$compra->tipocacao}}</td>
                    @else
                    <td></td>
                    @endif
                    @if($compra->tipocacao == 'GRADO II')
                    <td align='center'>{{$compra->tipocacao}}</td>
                    @else
                    <td></td>            
                    @endif            
                    <td align='center'>{{number_format($compra->kilos,2)}}</td>
                    <td align='center'>{{number_format($compra->precio,2)}}</td>
                    <td align='center'>{{number_format($compra->total,2)}}</td>
                    <td align='center'></td>
                    {{--*/ @$total = $total + $compra->total /*--}}
                {{--*/ @$kilos = $kilos + $compra->kilos /*--}}
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th align="center" colspan="5">TOTAL</th>
                    <td align="center">{{number_format($kilos,2)}}</td>
                    <td></td>
                    <td align="center">{{number_format($total,2)}}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <br>
        <footer>
            <table width="100%">
                <tbody>
                    <tr>
                        <td width="25%" ></td>
                        <td rowspan="4" style="border: #000000 solid;"></td>
                        <td width="35%" rowspan="4"></td>
                        <td width="25%" ></td>
                        <td rowspan="4" style="border: #000000 solid;"></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: #000000 solid;">&nbsp;</td>
                        <td style="border-bottom: #000000 solid;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>                
                            <center> {!!Form::label('firma','Firma del Acopiador' )!!}</center>
                        </td>                        
                        <td>                
                            <center> {!!Form::label('firma','Firma Responsable Acopio' )!!}</center>
                        </td>            
                    </tr>
                    <tr style="font-size: 9">
                        <td><b>NOMBRE: </b> {{$planillas->acopiador}}</td>
                        <td><b>NOMBRE: </b> {{$planillas->tecnico}}</td>
                    </tr>
                </tbody>
            </table>
        </footer>
    </body>        
</html>
