<table border="1" cellspacing="0" cellpadding="5"  style="width: 100%">
    <thead>
        <tr>
            <th colspan="2">FICHA DE CAMBIO DE TITULAR</th>
        </tr>    
    </thead>
    <tbody>
        <tr>
            <th>TITULAR</th><th>BENEFICIARIO</th>
        </tr>
        <tr>
            <td><b>NOMBRES:</b>{{$socioa->nombre}}</td>
            <td><b>NOMBRES:</b>{{$beneficiarioa->nombre}}</td>
        </tr>
        <tr>
            <td><b>APELLIDOS:</b>{{$socioa->paterno}} {{$socio->materno}}</td>
            <td><b>APELLIDOS:</b>{{$beneficiarioa->paterno}} {{$beneficiarioa->materno}}</td>
        </tr>
        <tr>
            <td><b>D.N.I.:</b>{{$socioa->dni}}</td>
            <td><b>D.N.I.:</b>{{$beneficiarioa->dni}}</td>
        </tr>
        <tr>
            <td><b>FECHA NACIMIENTO:</b>{{$socioa->fec_nac}}</td>
            <td><b>FECHA NACIMIENTO:</b>{{$beneficiarioa->fec_nac}}</td>
        </tr>
        <tr>
            <td><b>NOMBRE DE LA PARCELA (S):</b></td>
            <td><b>PARENTESCO:</b></td>
        </tr>
        <tr>
            <td colspan="2"><b>AREA TOTAL:</b>      
                
                {{--*/ @$valor = 0 /*--}}
             @foreach ($fundos as $fundo)                   
                   {{--*/$valor = $valor + $fundo->hectarea/*--}}                  
                @endforeach
                {{$valor}}  Ha.   
            </td>            
        </tr>
        <tr>
            <td><b>AREA CACAO EN PRODUCCION:</b>
                @foreach ($fundos as $fundo)
                    @if ($fundo->flora == "CACAO EN PRODUCCION" )
                    {{$fundo->hectarea}} Ha. 
                    @endif
                @endforeach
            </td>
            <td><b>AREA CACAO EN CRECIMIENTO:</b>
                @foreach ($fundos as $fundo)
                    @if ($fundo->flora == "CACAO EN CRECIMIENTO" )
                    {{$fundo->hectarea}} Ha. 
                    @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>ESTATUS/CONDICION: </b> SOCIO(A)</td>           
        </tr>
        <tr>
            <td colspan="2"><b>SECTOR: </b>{{$socioa->comite_local}}</td>            
        </tr>
        <tr>
            <td colspan="2"><b>COMITE CENTRAL:</b>{{$socioa->comite_central}}</td>            
        </tr>
        <tr>
            <td colspan="2"><b>MOTIVO DE LA TRANSFERENCIA DE LA TITULARIDAD DE LA PARCELA:</b></td>            
        </tr>
        <tr>
            <th>NUEVO TITULAR</th>
            <th>BENEFICIARIO</th>
        </tr>

<tr>
            <td><b>NOMBRES:</b>{{$socio->nombre}}</td>
            <td><b>NOMBRES:</b>{{$beneficiario->nombre}}</td>
        </tr>
        <tr>
            <td><b>APELLIDOS:</b>{{$socio->paterno}} {{$socio->materno}}</td>
            <td><b>APELLIDOS:</b>{{$beneficiario->paterno}} {{$beneficiario->materno}}</td>
        </tr>
        <tr>
            <td><b>D.N.I.:</b>{{$socio->dni}}</td>
            <td><b>D.N.I.:</b>{{$beneficiario->dni}}</td>
        </tr>
        <tr>
            <td><b>FECHA NACIMIENTO:</b>{{$socio->fec_nac}}</td>
            <td><b>FECHA NACIMIENTO:</b>{{$beneficiario->fec_nac}}</td>
        </tr>
        <tr>
            <td><b>NOMBRE DE LA PARCELA (S):</b></td>
            <td><b>PARENTESCO: </b>{{$beneficiario->tipo_pariente}}</td>
        </tr>
        <tr>
            <td colspan="2"><b>AREA TOTAL:</b>{{$valor}}</td>            
        </tr>        
        <tr>
            <td colspan="2"><b>ESTATUS/CONDICION: </b> SOCIO(A)</td>           
        </tr>
        <tr>
            <td colspan="2"><b>SECTOR:</b>{{$socio->comite_local}}</td>            
        </tr>
        <tr>
            <td colspan="2"><b>COMITE CENTRAL:</b>{{$socio->comite_central}}</td>            
        </tr>
        <tr>
            <td colspan="2"><b>OBSERVACIONES:</b></td>            
        </tr>        
    </tbody>
    <tfoot >
        
        <tr>
            <td colspan="2">
                <p align='center'>JUANJUI, 12 DE FEBRERO DEL 2017</p> <br>
            </td>                                                                       
        </tr>
        <tr >
           <td align='center' style="border-top: hidden;">
                <hr width='50%'>
                    FIRMA DEL TITULAR
            </td>
            <td align='center' style=" border-left: hidden; border-top: hidden;">
                <hr width='60%'>
                FIRMA DEL BENEFICIARIO
            </td>
        </tr>
        <tr>
            <td colspan="2" align='center' style="border-top: hidden "><br><br>
                <hr width='40%'>
                FIRMA RESPONSABLE - ACOPAGRO
            </td>                                                                       
        </tr>
    </tfoot>
</table>
