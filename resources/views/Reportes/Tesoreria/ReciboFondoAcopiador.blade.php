<title>RECIBO DE ACOPIADOR</title>
<!--<img src="{{asset('img/avatar.png')}}" alt=""/>-->
<table  width='100%'>
    <thead>
        <tr>
            <td colspan="2"><img src="http://acopagro.com.pe/wp-content/uploads/2015/02/logo-png-horizontal-e1423034456225.png" style=" height: 80px; width: 500px;" />
    <br>Jr. Arica N° 284 - Juanjui - Mcal Caceres - San Martin                
                Telefono N° 051 - 42545190 Email: acopagro@acopagro.com.pe
            </td>
            <th rowspan="2">
                <table border='1' width='100%' height='100%' style="border: #007fff solid; padding: 2px;">
                    <thead>
                        <tr style=" background: #007fff;">
                            <th style="font-size: 18; border: #007fff solid;">DIA</th>
                            <th style="font-size: 18; border: #007fff solid;">MES</th>
                            <th style="font-size: 18; border: #007fff solid;">AÑO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 16; border: #007fff solid;" align="center"><?php $date=date_create($distribucion->fecha);
                            echo date_format($date,"d")  ?></td>
                            <td style="font-size: 16; border: #007fff solid;" align="center"><?php echo date_format($date,"m")  ?>  </td>
                            <td style="font-size: 16; border: #007fff solid;" align="center"><?php echo date_format($date,"Y")  ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="font-size: 16; border: #007fff solid; border-radius: 10px;" align="center">S/ {{number_format($distribucion->monto,2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </th>            
        </tr>
    </thead>
    <tbody>
          <tr>
            <td colspan="1" style="font-size: 12;">{{$distribucion->tipo_documento}}</td>
            <td align="center" style="color: red" >N° {{$distribucion->enumeracion}}</td>
        </tr>                  
    </tbody>       
</table> 
<table width='100%'  style="border-radius: 20px; border: #007fff solid;" cellpadding="5">
                <thead>
                    <tr style="border-top: hidden;">
                        <th colspan="3" align="rigth" style="font-size: 12;">He recibido de la Cooperativa Agraria Cacaotera "ACOPAGRO" Ltda.</th>
                    </tr>
                </thead>
                <tbody style="font-size: 10;">
                    <tr>
                        <td width="20%"><b>Cantidad de: </b>&nbsp;&nbsp;</td>
                        <td colspan="2" style="border: #007fff solid; border-radius: 10px;" width='50%'  >{{$monto}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"  ><b>Para acopiar cacao y entregar al Amacen de Acopagro</b></td>
                        <td rowspan="3" align="center"  style="border: #007fff solid; border-radius: 10px; " >               
                        </td>
                    </tr>
                    <tr>
                        <td><b>Lugar: </b></td>
                        <td width="100%" style="border: #007fff solid; border-radius: 10px;"  >{{$distribucion->sucursal}} - {{$distribucion->comite_local }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><br><br><br></td>
                    </tr>   
                    <tr>
                        <td colspan="3">
                            <table width="100%" >
                                <tbody style="font-size: 10;">
                                    <tr >
                                        <td align='center' style="border-top: hidden;" width="70%">
                                            <hr width='100%'>
                                            LUZMILA DEL AGUILA CARRION
                                            <br><b style="font-size: 12">Tesoreria</b>
                                        </td>
                                        <td align='center' style=" border-left: hidden; border-top: hidden;" width="100%">
                                            <hr width='50%'>
                                            FIRMA ACOPIADOR
                                        </td>
                                        <td align="center" width="40%">HUELLA</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NOMBRE: &nbsp;&nbsp;</b>{{$distribucion->paterno }} {{$distribucion->materno }} {{$distribucion->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; D.N.I.: &nbsp;&nbsp;</b>{{$distribucion->dni }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>                        
                    </tr>
                </tbody>
            </table>
<br>






