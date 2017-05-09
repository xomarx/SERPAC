<title>FICHA DE TITULARIDAD</title>
<table width='100%'>
    <thead>
        <tr>
            
            <th width='25%'>
                <img src="http://acopagro.com.pe/wp-content/uploads/2015/02/logo-png-horizontal-e1423034456225.png" style=" height: 70px; width: 180px;" />
            </th>
            <th colspan="1">FICHA DE CAMBIO DE TITULAR</th>
            <th width='25%'>&nbsp;</th>        
        </tr>
    </thead>
</table>

<table border="1" cellspacing="0" cellpadding="5"  style="width: 100%">
    <thead>            
    </thead>
    <tbody>
        <tr style="font-size: 13">
            <th>TITULAR</th><th>BENEFICIARIO</th>
        </tr>
        <tr style="font-size: 10">
            <td><b >NOMBRES: &nbsp; </b>{{$socioa->nombre}}</td>
            <td><b >NOMBRES: &nbsp;</b>{{$beneficiarioa->nombre}}</td>
        </tr>
        <tr style="font-size: 10">
            <td><b >APELLIDOS: &nbsp;</b>{{$socioa->paterno}} {{$socio->materno}}</td>
            <td><b >APELLIDOS: &nbsp;</b>{{$beneficiarioa->paterno}} {{$beneficiarioa->materno}}</td>
        </tr>
        <tr style="font-size: 10">
            <td><b >D.N.I.:&nbsp;</b>{{$socioa->dni}}</td>
            <td><b >D.N.I.:&nbsp;</b>{{$beneficiarioa->dni}}</td>
        </tr>
        <tr style="font-size: 10">
            <td><b >FECHA NACIMIENTO:&nbsp;</b>{{$socioa->fec_nac}}</td>
            <td><b >FECHA NACIMIENTO: &nbsp;</b>{{$beneficiarioa->fec_nac}}</td>
        </tr>
        <tr style="font-size: 10">
            <td><b >NOMBRE DE LA PARCELA (S):&nbsp;</b>{{$fundos[0]->fundo}}</td>
            <td><b >PARENTESCO: &nbsp;</b>{{$beneficiario->tipo_pariente}}</td>
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b >AREA TOTAL:&nbsp;</b>      
                
                {{--*/ @$valor = 0 /*--}}
             @foreach ($fundos as $fundo)                   
                   {{--*/$valor = $valor + $fundo->hectarea/*--}}                  
                @endforeach
                {{$valor}}  Ha.   
            </td>            
        </tr>
        <tr style="font-size: 10">
            <td><b >AREA CACAO EN PRODUCCION:&nbsp;</b>
                @foreach ($fundos as $fundo)
                    @if ($fundo->flora == "CACAO EN PRODUCCION" )
                    {{$fundo->hectarea}} Ha. 
                    @endif
                @endforeach
            </td>
            <td><b >AREA CACAO EN CRECIMIENTO:&nbsp;</b>
                @foreach ($fundos as $fundo)
                    @if ($fundo->flora == "CACAO EN CRECIMIENTO" )
                    {{$fundo->hectarea}} Ha. 
                    @endif
                @endforeach
            </td>
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b >ESTATUS/CONDICION: &nbsp;</b> SOCIO(A)</td>           
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b >SECTOR: &nbsp;</b>{{$socioa->comite_local}}</td>            
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b >COMITE CENTRAL: &nbsp;</b>{{$socioa->comite_central}}</td>            
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b >MOTIVO DE LA TRANSFERENCIA DE LA TITULARIDAD DE LA PARCELA: &nbsp;</b><?php echo strtoupper($transferencia->motivo) ?></td>
        </tr>
        <tr style="font-size: 13">
            <th>NUEVO TITULAR</th>
            <th>BENEFICIARIO</th>
        </tr>

<tr style="font-size: 10">
    <td><b >NOMBRES: &nbsp;</b>{{$socio->nombre}}</td>
    <td><b >NOMBRES: &nbsp;</b>{{$beneficiario->nombre}}</td>
        </tr>
        <tr style="font-size: 10">
            <td><b > APELLIDOS: &nbsp;</b>{{$socio->paterno}} {{$socio->materno}}</td>
            <td><b >APELLIDOS: &nbsp;</b>{{$beneficiario->paterno}} {{$beneficiario->materno}}</td>
        </tr>
        <tr style="font-size: 10">
            <td><b >D.N.I.: &nbsp;</b>{{$socio->dni}}</td>
            <td><b >D.N.I.: &nbsp;</b>{{$beneficiario->dni}}</td>
        </tr>
        <tr style="font-size: 10">
            <td><b >FECHA NACIMIENTO: &nbsp;</b>{{$socio->fec_nac}}</td>
            <td><b >FECHA NACIMIENTO: &nbsp;</b>{{$beneficiario->fec_nac}}</td>
        </tr>
        <tr style="font-size: 10">
            <td><b>NOMBRE DE LA PARCELA (S): &nbsp;</b>{{$fundos[0]->fundo}}</td>
            <td><b>PARENTESCO: </b>{{$beneficiario->tipo_pariente}}</td>
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b>AREA TOTAL: &nbsp;</b>{{$valor}}</td>            
        </tr>        
        <tr style="font-size: 10">
            <td colspan="2"><b>ESTATUS/CONDICION: &nbsp;</b> SOCIO(A)</td>           
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b>SECTOR: &nbsp;</b>{{$socio->comite_local}}</td>            
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b>COMITE CENTRAL: &nbsp;</b>{{$socio->comite_central}}</td>            
        </tr>
        <tr style="font-size: 10">
            <td colspan="2"><b>OBSERVACIONES: &nbsp;</b></td>            
        </tr>        
    </tbody>
    <tfoot >
        
        <tr style="font-size: 11">
            <td colspan="2">
                <p align='center'>JUANJUI, 12 DE FEBRERO DEL 2017</p> <br>
            </td>                                                                       
        </tr>
        <tr style="font-size: 11">
           <td align='center' style="border-top: hidden;">
                <hr width='50%'>
                    FIRMA DEL TITULAR
            </td>
            <td align='center' style=" border-left: hidden; border-top: hidden;">
                <hr width='60%'>
                FIRMA DEL BENEFICIARIO
            </td>
        </tr>
        <tr style="font-size: 11">
            <td colspan="2" align='center' style="border-top: hidden "><br><br>
                <hr width='40%'>
                FIRMA RESPONSABLE - ACOPAGRO
            </td>                                                                       
        </tr>
    </tfoot>
</table>
