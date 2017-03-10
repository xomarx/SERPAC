<title>RECIBO DE ACOPIADOR</title>
{{asset('img/avatar.png')}}

<!--<img src="{{asset('img/avatar.png')}}" alt=""/>-->
<table  width='100%'>
    <thead>
        <tr>
            <th colspan="2"><img src="/img/avatar.png" alt=""/></th>
            <th rowspan="3">
                <table border='1' width='100%' height='100%' style="border: #007fff solid; padding: 2px;">
                    <thead>
                        <tr style=" background: #007fff;">
                            <th style="font-size: 20; border: #007fff solid;">DIA</th>
                            <th style="font-size: 20; border: #007fff solid;">MES</th>
                            <th style="font-size: 20; border: #007fff solid;">AÑO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 16; border: #007fff solid;" align="center">{{date($distribucion->fecha)}}</td>
                            <td style="font-size: 16; border: #007fff solid;" align="center">02</td>
                            <td style="font-size: 16; border: #007fff solid;" align="center">2017</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="font-size: 16; border: #007fff solid; border-radius: 10px;" align="center">S/ {{$distribucion->monto }}</th>
                        </tr>
                    </tfoot>
                </table>
            </th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">Jr. Arica N° 284 - Juanjui - Mcal Caceres - San Martin
                <br>
                Telefono N° 051 - 42545190 Email: acopagro@acopagro.com.pe
            </td>
        </tr>                
    </tbody>
    <tfoot>
        <tr>
            <td colspan="1" width="65%">RECIBO DE DISTRIBUCION DE FONDOS PARA ACOPIO</td>
            <td align="center" >N° 030116</td>
        </tr>
    </tfoot>
</table> 

<table width='100%'  style="border-radius: 20px; border: #007fff solid;" cellpadding="5">
    <thead>
        <tr style="border-top: hidden;">
            <th colspan="3" align="rigth">He recibido de la Cooperativa Agraria Cacaotera "ACOPAGRO" Ltda.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><b>Cantidad de: </b>&nbsp;&nbsp;</td>
            <td style="border: #007fff solid; border-radius: 10px;" width="63%" colspan="2">{{$monto}}</td>
        </tr>
        <tr>
            <td colspan="2"><b>Para acopiar cacao y entregar al Amacen de Acopagro</b></td>
            <td rowspan="3" align="center" width='20%' style="border: #007fff solid; border-radius: 10px;" >               
            </td>
        </tr>
        <tr>
            <td><b>Lugar: </b></td>
            <td style="border: #007fff solid; border-radius: 10px;" width="63%">{{$distribucion->sucursal}} - {{$distribucion->comite_local }}</td>
        </tr>
        <tr>
            <td colspan="2"><br><br><br></td>
        </tr>   
        <tr >
           <td align='center' style="border-top: hidden; font-size: 7" width="25%">
                <hr width='100%'>
                LUZMILA DEL AGUILA CARRION
                <br><b style="font-size: 12">Tesoreria</b>
            </td>
            <td align='center' style=" border-left: hidden; border-top: hidden;" width="50%">
                <hr width='70%'>
                FIRMA ACOPIADOR
            </td>
            <td align="center">HUELLA</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><b>NOMBRE: </b>{{$distribucion->paterno }} {{$distribucion->materno }} {{$distribucion->nombre }}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><b>D.N.I.: </b>{{$distribucion->dni }}</td>
        </tr>
    </tbody>
</table>




