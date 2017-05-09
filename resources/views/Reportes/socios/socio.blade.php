<table width='100%'>
    <thead>
        <tr>
            <th align='left' width='25%'>
                <img src="http://acopagro.com.pe/wp-content/uploads/2015/02/logo-png-horizontal-e1423034456225.png" style=" height: 70px; width: 180px;" />
            </th>
            <th >
                <h3>REGISTRO DE SOCIOS Y SOCIAS</h3>
            </th>
            <th>&nbsp;</th>
        </tr>
    </thead>
</table>    
    <table border="1" cellspacing="0" cellpadding="5">
        <caption>{{$socio->codigo}}</caption>
        <thead>
            <tr>            
                <th colspan="2">TITULAR</th>
                <th colspan="2">CONYUGUE O CONVIVIENTE</th>            
            </tr>
        </thead>
        <tbody>
            <tr style="font-size: 10pt">
                <td colspan="2">
                    Nombres: {{$socio->paterno}} {{$socio->materno}} {{$socio->nombre}}<br>
                    Estado Civil:  {{$socio->estado_civil}} <br>
                    Fecha de Nacimiento: {{$socio->fec_nac}}<br>
                    Lugar o Distrito: {{$socio->distrito}}<br>
                    Provincia: {{$socio->provincia}}<br>
                    Departamento: {{$socio->departamento}}<br>
                    D.N.I.: {{$socio->dni}}<br>
                    R.U.C.: <br>
                    Grado de Instruccion: {{$socio->grado_inst}}<br>
                    Profesion o Actividad: {{$socio->ocupacion}}<br>
                    Cargo: 
                </td>
                <td colspan="2">
                    Nombres: 
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->paterno }} {{$pariente->materno }} {{$pariente->nombre }}
                    @endif
                    @endforeach
            <br>
                    Estado Civil:
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->estado_civil }} 
                    @endif
                    @endforeach
                    <br>
                    Fecha de Nacimiento: 
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->fec_nac }} 
                    @endif
                    @endforeach
                    <br>
                    Lugar o Distrito: 
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->distrito }} 
                    @endif
                    @endforeach
                    <br>
                    Provincia: 
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->provincia }} 
                    @endif
                    @endforeach
                    <br>
                    Departamento: 
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->departamento }} 
                    @endif
                    @endforeach
                    <br>
                    D.N.I.:
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->dni }} 
                    @endif
                    @endforeach
                    <br>
                    R.U.C.: <br>
                    Grado de Instruccion: 
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->grado_inst }} 
                    @endif
                    @endforeach
                    <br>
                    Profesion o Actividad: <br>
                    Fecha de Inscripcion: 
                </td>            
            </tr>
            <tr>
                <th >NOMBRE DE LOS HIJOS</th>
                <th >FECHA NACIMIENTO</th> 
                <th >D.N.I.</th>
                <th >GRADO DE INSTRUCCION</th>                                
            </tr>   
            <!--se crea un for para llenar los datos de los hijos-->
            <tr style="font-size: 10pt">                                        
                <td>
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'HIJO(A)')
                    {{$pariente->paterno }} {{$pariente->materno}} {{$pariente->nombre }}
                    @endif
                    @endforeach
                </td>   
                <td align='center'>
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'HIJO(A)')
                    {{$pariente->fec_nac }}
                    @endif
                    @endforeach
                </td>
                <td align='center'>
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'HIJO(A)')
                    {{$pariente->dni }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach($parientes as $pariente)
                    @if ( $pariente->tipo_pariente == 'HIJO(A)')
                    {{$pariente->grado_inst }}
                    @endif
                    @endforeach
                </td>                        
            </tr>
            <tr style="font-size: 11pt">
                <td colspan="2">
                    Fundo:   
                    @foreach($fundos as $fundo)                    
                        {{$fundo->fundo }} .                   
                    @endforeach
                    <br>
                    Direccion:  
                    @foreach($fundos as $fundo)                    
                        {{$fundo->direccion }} .                   
                    @endforeach
                    <br>
                    Tipo de Tenencia:   @foreach($fundos as $fundo)                    
                        {{$fundo->estadofundo }} .                   
                    @endforeach      
                </td>
                <td colspan="2" >
                    Comite Base: @foreach($fundos as $fundo)                    
                        {{$fundo->comite_local }} .                   
                    @endforeach<br>
                    Desde:   @foreach($fundos as $fundo)                    
                        {{$fundo->fecha }} .                   
                    @endforeach   Año: 
                </td>
            </tr>
            <tr>
                <th colspan="2">CULTIVOS</th>
                <th>HECTAREA</th>
                <th>RENDIMIENTO/AÑO</th>
            </tr>
              
            
            <tr style="font-size: 10pt">
                <td colspan="2">
                    @foreach($cultivos as $cultivo)
                    {{$cultivo->flora }}<br>
                    @endforeach
                </td>
                <td align="center">
                    @foreach($cultivos as $cultivo)
                    
                    {{$cultivo->hectarea }}<br>
                     @endforeach
                </td>
                <td>
                    @foreach($cultivos as $cultivo)
                    {{$cultivo->rendimiento }}<br>
                    @endforeach
                </td>
            </tr>                       
            
            <!--FOR PARA LAS HECTAREAS-->
            <tr style="font-size: 10pt">
                <td colspan="2">AREAS TOTAL</td>
                <td align="center">    
                    {{--*/ @$name = 0 /*--}}
                    @foreach($cultivos as $cultivo)
                    {{--*/ @$name =$name + $cultivo->hectarea /*--}}                    
                     @endforeach
                     {{$name }} Ha.
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
            <tr>
                <th colspan="2">CRIANZAS</th>
                <th>CANTIDAD</th>
                <th>RENDIMIENTO/AÑO</th>
            </tr>
                          
            <tr style="font-size: 10pt">
                <td colspan="2">
                    @foreach($faunas as $fauna)
                    {{$fauna->fauna }}<br>
                    @endforeach
                </td>
                <td align="center">
                    @foreach($faunas as $fauna)
                    {{$fauna->cantidad }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($faunas as $fauna)
                    {{$fauna->rendimiento }}<br>
                    @endforeach
                </td>
            </tr>                                   
        </tbody>        
    </table>
    <p>DECLARO CONOCER LOS ESTATUTOS DE LA COOPERATIVA SOMETIENDOME A ELLO A ENTERA VOLUNTAD</p>            
    <p  align="right" >Juenjui, 7 de Marzo Del 2012</p>
    <br><br><br>
    <footer>
        <table border='0px' style="width: 100%;" >
        <tr>
            <td align='center'><hr width='70%'> Comite de Educacion</td>
            <td align='center'><hr width='75%'>Firma del Titular</td>
            <td align='center'><hr width='70%'>Firma del Conyugue</td>
        </tr>
    </table>  
    </footer>
                    
      
