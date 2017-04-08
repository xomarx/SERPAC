<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


@foreach($listas as $lista)
<table>
    <thead>
    <th><img src="http://acopagro.com.pe/wp-content/uploads/2015/02/logo-png-horizontal-e1423034456225.png" style="width: 28%"/></th>
    <th><center><h3>REGISTRO DE SOCIOS Y SOCIAS</h3></center></th>
    </thead>
</table>   
<table border="1" cellspacing="0" cellpadding="5">
        <caption>{{$lista['socio']->codigo}}</caption>
        <thead>
            <tr>            
                <th colspan="2">TITULAR</th>
                <th colspan="2">CONYUGUE O CONVIVIENTE</th>            
            </tr>
        </thead>
        <tbody>
            <tr style="font-size: 10pt">
                <td colspan="2">
                    Nombres: {{$lista['socio']->paterno}} {{$lista['socio']->materno}} {{$lista['socio']->nombre}}<br>
                    Estado Civil:  {{$lista['socio']->estado_civil}} <br>
                    Fecha de Nacimiento: {{$lista['socio']->fec_nac}}<br>
                    Lugar o Distrito: {{$lista['socio']->distrito}}<br>
                    Provincia: {{$lista['socio']->provincia}}<br>
                    Departamento: {{$lista['socio']->departamento}}<br>
                    D.N.I.: {{$lista['socio']->dni}}<br>
                    R.U.C.: <br>
                    Grado de Instruccion: {{$lista['socio']->grado_inst}}<br>
                    Profesion o Actividad: {{$lista['socio']->ocupacion}}<br>
                    Cargo: 
                </td>
                <td colspan="2">
                    Nombres: 
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->paterno }} {{$pariente->materno }} {{$pariente->nombre }}
                    @endif
                    @endforeach
            <br>
                    Estado Civil:
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->estado_civil }} 
                    @endif
                    @endforeach
                    <br>
                    Fecha de Nacimiento: 
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->fec_nac }} 
                    @endif
                    @endforeach
                    <br>
                    Lugar o Distrito: 
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->distrito }} 
                    @endif
                    @endforeach
                    <br>
                    Provincia: 
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->provincia }} 
                    @endif
                    @endforeach
                    <br>
                    Departamento: 
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->departamento }} 
                    @endif
                    @endforeach
                    <br>
                    D.N.I.:
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'CONVIVIENTE' || $pariente->tipo_pariente == 'ESPOSO(A)' )
                        {{$pariente->dni }} 
                    @endif
                    @endforeach
                    <br>
                    R.U.C.: <br>
                    Grado de Instruccion: 
                    @foreach($lista['parientes'] as $pariente)
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
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'HIJO(A)')
                    {{$pariente->paterno }} {{$pariente->materno}} {{$pariente->nombre }}
                    @endif
                    @endforeach
                </td>   
                <td align='center'>
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'HIJO(A)')
                    {{$pariente->fec_nac }}
                    @endif
                    @endforeach
                </td>
                <td align='center'>
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'HIJO(A)')
                    {{$pariente->dni }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach($lista['parientes'] as $pariente)
                    @if ( $pariente->tipo_pariente == 'HIJO(A)')
                    {{$pariente->grado_inst }}
                    @endif
                    @endforeach
                </td>                        
            </tr>   
            <tr style="font-size: 11pt">
                <td colspan="2">
                    Fundo:   
                    @foreach($lista['fundos'] as $fundo)                    
                        {{$fundo->fundo }} .                   
                    @endforeach
                    <br>
                    Direccion:  
                    @foreach($lista['fundos'] as $fundo)                    
                        {{$fundo->direccion }} .                   
                    @endforeach
                    <br>
                    Tipo de Tenencia:   @foreach($lista['fundos'] as $fundo)                    
                        {{$fundo->estadofundo }} .                   
                    @endforeach      
                </td>
                <td colspan="2" >
                    Comite Base: @foreach($lista['fundos'] as $fundo)                    
                        {{$fundo->comite_local }} .                   
                    @endforeach<br>
                    Desde:   @foreach($lista['fundos'] as $fundo)                    
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
                    @foreach($lista['cultivos'] as $cultivo)
                    {{$cultivo->flora }}<br>
                    @endforeach
                </td>
                <td align="center">
                    @foreach($lista['cultivos'] as $cultivo)
                    
                    {{$cultivo->hectarea }}<br>
                     @endforeach
                </td>
                <td>
                    @foreach($lista['cultivos'] as $cultivo)
                    {{$cultivo->rendimiento }}<br>
                    @endforeach
                </td>
            </tr>                                   
            <!--FOR PARA LAS HECTAREAS-->
            <tr style="font-size: 10pt">
                <td colspan="2">AREAS TOTAL</td>
                <td align="center">    
                    {{--*/ @$name = 0 /*--}}
                    @foreach($lista['cultivos'] as $cultivo)
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
                    @foreach($lista['faunas'] as $fauna)
                    {{$fauna->fauna }}<br>
                    @endforeach
                </td>
                <td align="center">
                    @foreach($lista['faunas'] as $fauna)
                    {{$fauna->cantidad }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($lista['faunas'] as $fauna)
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
    
    <div  style="page-break-after: always;"></div>    
@endforeach

