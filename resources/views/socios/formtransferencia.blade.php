
<div class="box-header">
    <button id="cerrartransferencia" type="button" class="close fa fa-close btn-sm" data-toggle="tooltip" data-placement="top" title="Salir del Registro">&times;</button>
    <center> <h3 class="box-title">REGISTRO DE TRANSFERENCIA - SOCIO</h3></center>
</div> 
<div class="box-body">    
    {!! Form::open(['id'=>'formtransferencia'])!!}
    @include('mensajes.mensaje')
    <div class="col-lg-5">
        <div class="box box-solid box-primary content">
            <div class="box-header">
                <center> <h3 class="box-title">DATOS DEL SOCIO</h3></center>
            </div>
            <div class="box-body">
                <div class="col-lg-12 ">                       
                    <div class=" col-sm-6 form-group">       
                        {!! Form::label('codigo','Codigo',['class'=>'control-label']) !!}
                        {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control col-sm-2','placeholder'=>'ACO-00000'])!!}
                        <div class="text-danger" id="error-codigo"></div>
                    </div>                     
                    <div class=" col-sm-6 form-group">
                        {!!Form::label('dni','D.N.I.',['class'=>'control-label'])!!}
                        {!! Form::text('dni_socio',null,['id'=>'dni_socio','class'=>'form-control','placeholder'=>'N° DNI'])!!}
                        <div class="text-danger" id="error-dni_socio"></div>
                    </div>                                       
                </div>
                <div class=" col-sm-12 form-group">
                    {!!Form::label('socio','SOCIO',['class'=>'control-label'])!!}
                    {!! Form::text('socio',null,['id'=>'socio','class'=>'form-control','placeholder'=>'Apellidos y Nombres'])!!}
                    <div class="text-danger" id="error-socio"></div>
                </div>                
                <div class="col-lg-12" id="motivo" style="display: none">
                    {!!Form::label('motivo','Motivo de la Transferencia',['class'=>'control-label'])!!}
                    {!! Form::textarea('motivo',null,['id'=>'motivo','class'=>'form-control','rows'=>'3','placeholder'=>'Motivo de la Transferencia de la Titularidad de la Parcela'])!!}
                    <div class="text-danger" id="error-motivo"></div>
                </div>

                <table class="table table-responsive table-hover table-striped" style="display: none" id="tablasocio">
                    <thead>
                    <th colspan="2">TITULAR</th>
                    <th colspan="2">BENEFICIARIO</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>NOMBRES: </b></td>
                            <td id="nombresocio"></td>
                            <td><b>NOMBRES:</b></td>
                            <td id="nombrebeneficiario"></td>
                        </tr>
                        <tr>
                            <td><b>APELLIDOS:</b></td>
                            <td id="apellidossocio"></td>
                            <td><b>APELLIDOS:</b></td>
                            <td id="apellidosbeneficiario"> </td>
                        </tr>
                        <tr>
                            <td><b>D.N.I.:</b></td>
                            <td id="dnisocio"> </td>
                            <td><b>D.N.I.:</b> </td>
                            <td id="dnibeneficiario"></td>
                        </tr>
                        <tr>
                            <td><b>FECHA NACIMIENTO:</b></td>
                            <td id="fechasocio"> </td>
                            <td><b>FECHA NACIMIENTO:</b></td>
                            <td id="fechabeneficiario"> </td>
                        </tr>
                        <tr>
                            <td><b>PARCELA: </b></td>
                            <td id="parcela"></td>
                            <td><b>PARENTESCO:</b></td>
                            <td id="parentesco"> </td>
                        </tr>
                        <tr>
                            <td ><b>SECTOR:</b></td>
                            <td id="sector"> </td>   
                            <td ><b>AREA TOTAL: </b></td>
                            <td  id="areatotal"></td> 
                        </tr>                
                        <tr>
                            <td><b>COMITE CENTRAL: </b></td>
                            <td colspan="3" id="comite"></td>
                        </tr>

                    </tbody>
                </table>

            </div> 
        </div>
    </div>

    <div class="col-lg-1">
        <a href="javascrip:void(0)" onclick="RegTransferencia()" class="btn btn-primary btn-lg m-t-10" ><span class="fa fa-exchange"data-toggle="tooltip" data-placement="top" title="Transferir a Nuevo Socio"></span></a>
    </div>
    <div class="col-lg-3">    
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">NUEVO SOCIO</h3>                        
            </div>
            <div class="box-body">
                <div class=" col-sm-12 form-group" id="divnuevosocio">
                    {!!Form::label('dni','D.N.I.',['class'=>'control-label'])!!}
                    {!! Form::text('dni_nuevo_socio',null,['id'=>'dni_nuevo_socio','class'=>'form-control','placeholder'=>'N° DNI Nuevo Socio','disabled'=>'true','maxlength'=>'8'])!!}
                    <div class="text-danger" id="error-dni_nuevo_socio"></div>
                </div>
                <table class="table table-responsive table-hover table-striped" id="tablanuevosocio" style="display: none" >
                    <thead>
                    <th colspan="2" >DATOS</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>NOMBRE:</b></td>
                            <td id="nombrenuevo"></td>
                        </tr>
                        <tr>
                            <td><b>APELLIDOS:</b></td>
                            <td id="apellidosnuevo"></td>
                        </tr>                    
                        <tr>
                            <td><b>DNI:</b></td>
                            <td id="dninuevo"></td>
                        </tr>
                        <tr>
                            <td><b>FECHA:</b></td>
                            <td id="fechanuevo"></td>
                        </tr>                    
                        <tr>
                            <td><b>SECTOR:</b></td>
                            <td id="sectornuevo"></td>
                        </tr>                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-3">    
        <div class="box box-solid box-primary">
            <div class="box-header">                    
                <h3 class="box-title">NUEVO BENEFICIARIO</h3>
            </div>
            <div class="box-body">        
                <div class=" col-sm-12 form-group">
                    {!!Form::label('dni','D.N.I.',['class'=>'control-label'])!!}
                    {!! Form::text('dni_beneficiario',null,['id'=>'dni_beneficiario','class'=>'form-control','placeholder'=>'N° DNI Nuevo Beneficiario','disabled'=>'true'])!!}
                    <div class="text-danger" id="error-dni_beneficiario"></div>                    
                </div>    
                <table class="table table-responsive table-hover table-striped" id="tablabeneficiario" style="display: none">
                    <thead>
                    <th colspan="2" >DATOS</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>NOMBRE:</b></td>
                            <td id="nombrebeneficiarionuevo"></td>                        
                        </tr>
                        <tr>
                            <td><b>APELLIDOS:</b></td>
                            <td id="apellidosbeneficiarionuevo"></td>                        
                        </tr>                    
                        <tr>
                            <td><b>DNI:</b></td>
                            <td id="dnibeneficiarionuevo"></td>
                        </tr>
                        <tr>
                            <td><b>FECHA:</b></td>
                            <td id="fechabeneficiarionuevo"></td>
                        </tr>                    
                        <tr>
                            <td><b>PARENTESCO:</b></td>
                            <td id="parientebeneficiarionuevo"></td>
                        </tr>                    
                    </tbody>
                </table>
            </div>                               
        </div>
    </div>
    {!!Form::close()!!}
</div>