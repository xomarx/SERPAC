<title>RECIBO DE COMPRAS</title>
<table width='100%' >
    <thead>
        <tr>
            <td colspan="3" rowspan="2" width='480px'><img src="http://acopagro.com.pe/wp-content/uploads/2015/02/logo-png-horizontal-e1423034456225.png" style=" height: 70px; width: 480px;" />
                <br>COMERCIALIZACION DE CACAO Y PRODUCTOS AGRICOLAS
                <br>Jr. Arica N° 284 - Juanjui - Mcal Caceres - San Martin                
                Telefono N° 051 - 42545190 Email: acopagro@acopagro.com.pe
            </td>
            <th rowspan="2" >
                <table border='1' width='100%' height='100%' style="border: #007fff solid; padding: 2px;">
                    <thead>
                        <tr style=" background: #007fff;">
                            <th  style="font-size: 14; border: #007fff solid;">RUC: 20404057805</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td  style="font-size: 12; border: #007fff solid;" align="center">{{$compras->tipo_documento}}</td>                            
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th  style="font-size: 12; border: #007fff solid; border-radius: 10px; color: #E13E00" align="center">Nro {{$compras->enumeracion}}</th>
                        </tr>
                    </tfoot>
                </table>
            </th>            
        </tr>
    </thead>    
</table>
<table width='100%' >
    <tbody>
        <tr>
            <td width="10px">Comite: </td>
            <td colspan="3" width="100%"  style="border: #000000 solid; border-radius: 10px;">{{$compras->comitenosocio}}{{$compras->comitesocio}}</td>
            <td colspan="1" width="108px" >Lugar de Venta: </td>
            <td colspan="2"  style="border: #000000 solid; border-radius: 10px;">{{$compras->sucursal}}</td>
        </tr>
         <tr>
            <td width="10px">Nombre: </td>
            <td colspan="4" style="border: #000000 solid; border-radius: 10px;">{{$compras->socio}}{{$compras->nosocio}}</td>
            <th  rowspan="2"  colspan="2">
                <table border='1' width='100%' height='100%' style="border: #007fff solid; padding: 2px;">
                    <thead>
                        <tr style=" background: #007fff;">
                            <th style="font-size: 14; border: #007fff solid;">DIA</th>
                            <th style="font-size: 14; border: #007fff solid;">MES</th>
                            <th style="font-size: 14; border: #007fff solid;">ANO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 12; border: #007fff solid;" align="center">                                
                                <?php $date=date_create($compras->fecha);
                            echo date_format($date,"d")  ?>                                                                
                            </td>
                            <td style="font-size: 12; border: #007fff solid;" align="center"><?php echo date_format($date, "m"); ?></td>
                            <td style="font-size: 12; border: #007fff solid;" align="center"><?php echo date_format($date, "Y"); ?></td>
                        </tr>
                    </tbody>                    
                </table>
            </th>
        </tr>
          <tr>
              <td width="100px" colspan="2" >Codigo Socio: </td>
            <td  style="border: #000000 solid; border-radius: 10px;" align='center'>{{$compras->codigo}}</td>
            <td width="108px" >Codigo Acopio: </td>
            <td  style="border: #000000 solid; border-radius: 10px;" align='center'>{{$compras->sucursalId}}</td>
        </tr>
        <tr>
            <td colspan="2">KILOS</td>
            <td width='100px'  style="border: #000000 solid; border-radius: 10px;" align="center">{{number_format($compras->kilos,2)}}</td>
            <td >PRECIO S/. </td>
            <td  style="border: #000000 solid; border-radius: 10px;" align="center">{{number_format($compras->precio,2)}}</td>
            <td>A PAGAR S/. </td>
            <td  style="border: #000000 solid; border-radius: 10px;" align="center">{{number_format($compras->total,2)}}</td>
        </tr>
    </tbody>
       <tfoot>
        <tr>
            <td >
                Observacion:
            </td>
            <td colspan="6" style="border-bottom: #000000 solid;"></td>
        </tr>
    </tfoot>
</table>
<table width='100%' >
    <tbody>
        <tr>
            <td width="20px" colspan="1">ORGANICO IMO</td>
            <td width='20px' align="center">
                @if($compras->condicion=='ORGANICO IMO')
                <input type="checkbox" name="grado" checked="checked"/>
                @else
                <input type="checkbox" name="grado"/>
                @endif
            </td>
            <td width="50px">RFA</td>
            <td width='20px' align="center">
                @if($compras->condicion=='RFA')
                <input type="checkbox" name="grado" checked="checked"/>
                @else
                <input type="checkbox" name="grado"/>
                @endif
            </td>
            <th style="font-size: 12; border: #007fff solid; border-radius: 5px; border-bottom: none; background: #007fff;" colspan="2" width="100px">TIPO DE CACAO</th>
            <th style="font-size: 12; border: #007fff solid; border-bottom: none;" width="10px" colspan="1">CANCELADO</th>
        </tr>
        
        <tr>
            <td>ORGANICO CERES</td>
            <td width='20px' align="center">
                @if($compras->condicion=='ORGANICO CERES')
                <input type="checkbox" name="grado" checked="checked"/>
                @else
                <input type="checkbox" name="grado"/>
                @endif
            </td>
            <td>UTZ</td>
            <td width='20px' align="center">
                @if($compras->condicion=='UTZ')
                <input type="checkbox" name="grado" checked="checked"/>
                @else
                <input type="checkbox" name="grado"/>
                @endif
            </td>
            <td width="20px" style="border-left: #007fff solid;">GRADO I</td>
            <td width='10px' align="center" style="border-right: #007fff solid;">
                @if($compras->tipocacao == 'GRADO I')
                <input type="checkbox" name="grado" checked="cheked"/>
                @else
                <input type="checkbox" name="grado"/>
                @endif
            </td>
            <td width='10px' align="center" style="border-left: #007fff solid; border-right: #007fff solid;"></td>
        </tr>
       <tr>
            <td width="20px">CONVENCIONAL</td>
            <td width='20px' align="center">
                @if($compras->nosocio=='')
                <input type="checkbox" name="grado"/>
                @else
                    @if($compras->condicion == 'CONVENCIONAL')
                <input type="checkbox" name="grado" checked="cheked"/>
                @else
                <input type="checkbox" name="grado"/>
                @endif
                @endif
            </td>
            <td>NO SOCIO</td>
            <td width='20px' align="center">
                @if($compras->socio=='')
                <input type="checkbox" name="grado" checked="cheked"/>
                @else
                <input type="checkbox" name="grado"/>
                @endif
            </td>
            <td width="20px" style="border-left: #007fff solid; border-bottom: #007fff solid;">GRADO II</td>
            <td width='10px' align="center" style="border-bottom: #007fff solid; border-right: #007fff solid;">
                @if($compras->tipocacao == 'GRADO II')
                <input type="checkbox" name="grado" checked="cheked"/>
                @else
                <input type="checkbox" name="grado"/>
                @endif
            </td>
            <td width='10px' align="center" style="border-left: #007fff solid; border-right: #007fff solid; border-bottom: #007fff solid; background: #007fff;">P. ACOPAGRO</td>
        </tr>
        
    </tbody>
</table>
    
    