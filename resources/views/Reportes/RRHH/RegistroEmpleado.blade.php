<title>FICHA PERSONAL - ACOPAGRO</title>
<center><h2>FICHA PERSONAL - ACOPAGRO</h2></center>
<table border="1" width='100%' cellspacing="0" cellpadding="5">
    <caption>{{$empleado->empleadoId}}</caption>
    <thead>
        <tr>
            <th colspan="4" align='left'>DATOS PERSONALES</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><b>PATERNO:</b> </td>
            <td style=" border-left: hidden; ">{{$empleado->paterno}}</td>
            <td><b>FECHA NACIMIENTO:</b> </td>
            <td style=" border-left: hidden; ">{{$empleado->fec_nac}}</td>
        </tr>
        <tr>
            <td style=" border-top: hidden;"><b>MATERNO:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->materno}}</td>
            <td style=" border-top: hidden;"><b>ESTADO CIVIL:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->estadocivil}}</td>
        </tr>
        <tr>
            <td style=" border-top: hidden;"><b>NOMBRES:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->nombre}}</td>
            <td style=" border-top: hidden;"><b>SEXO:</b></td>
            <td style=" border-left: hidden; border-top: hidden;">
                @if ($empleado->sexo == 'M' ) 
                    MASCULINO
                @else 
                    FEMENINO
                @endif
            </td>
        </tr>
        <tr>
            <td style=" border-top: hidden;"><b>D.N.I:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->personas_dni}}</td>
            <td style=" border-top: hidden;"><b>ESTADO:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->estado}}</td>
        </tr>
        <tr>
            <td style=" border-top: hidden;"><b>R.U.C.:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->ruc}}</td>
            <td style=" border-top: hidden;"><b>E-MAIL:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->email}}</td>
        </tr>
        <tr>
            <td ><b>AREA:</b> </td>            
            <td><b>CARGO:</b> </td>
            <td colspan="2"><b>PROFESION:</b></td>
        </tr>
        <tr>
            <td>{{$empleado->area }}</td>            
            <td>{{$empleado->cargo }}</td>
            <td colspan="2">{{$empleado->profesion }}</td>
        </tr>
        <tr>
            <td colspan="4">UBIGEO</td>
        </tr>
        <tr>
            <td ><b>DEPARTAMENTO:</b> </td>
            <td style=" border-left: hidden;">{{$empleado->departamento}}</td>
            <td ><b>COMITE CENTRAL:</b> </td>
            <td style=" border-left: hidden;">{{$empleado->comite_central}}</td>
        </tr>
        <tr>
            <td style=" border-top: hidden;"><b>PROVINCIA:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->provincia}}</td>
            <td style=" border-top: hidden;"><b>COMITE LOCAL:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->comite_local}}</td>
        </tr>
        <tr>
            <td style=" border-top: hidden;"><b>DISTRITO:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->distrito}}</td>
            <td style=" border-top: hidden;"><b>DOMICILIO:</b> </td>
            <td style=" border-left: hidden; border-top: hidden;">{{$empleado->direccion}}</td>
        </tr>
    </tbody>
</table>

