<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-lg modal-primary">
        <div class="modal-content" id="error-modal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">COMPRA DE GRANO DE CACAO</h4></center>
        </div>
        <div class="modal-body form-group-sm">
            {!! Form::open(['id'=>'formcompras']) !!}
            @include('mensajes.mensaje')
            <input type="hidden" id="id">
            <div class="col-md-12">
                <div class="col-md-2">
                    <label class="radio">
                        <input type="radio" name="estado" value="NOSOCIO" id="estadon" onclick="desabilita()">NO SOCIO
                    </label>   
                    <label class="radio">
                        <input type="radio" name="estado" value="SOCIO" id="estados" checked="true" onclick="habilita()" > SOCIO
                    </label>
                </div>
                <div class="col-md-2">
                    {!! Form::label('codigo','Codigo Almacen:',['class' => 'control-label'])!!}                    
                    {!! Form::text('acopio',null,['id'=>'acopio','class'=>'form-control','placeholder'=>'Codigo Almacen','autofocus'])!!}
                    <div class="text-danger" id="error_acopio"></div>
                </div>
                <div class="col-md-5">
                    {!! Form::label('codigo','Centro de Acopio:',['class' => 'control-label'])!!}
                    {!! Form::text('sucursal',null,['id'=>'sucursal','class'=>'form-control','placeholder'=>'Centro de Acopio','disabled'])!!}                    
                </div>
                
                <div class="col-md-2">
                    {!! Form::label('numero','N° Recibo:',['class' => 'control-label'])!!}                    
                    {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'N° de Recibo','style'=>"text-align: center;"])!!}
                    <div class="text-danger" id="error_numero" ></div>
                </div>
            </div>
            <div class="col-md-12" id="nosocio" style="display: none">
                <div class="col-md-2 ">
                    {!! Form::label('paterno','Paterno:',['class' => 'control-label'])!!}                    
                    {!! Form::text('paterno',null,['id'=>'paterno','class'=>'form-control autocomplete-suggestion','placeholder'=>'Apellido Paterno'])!!}
                    <div class="text-danger" id="error_paterno"></div>
                </div>
                <div class="col-md-2 ">
                    {!! Form::label('materno','Materno:',['class' => 'control-label'])!!}                    
                    {!! Form::text('materno',null,['id'=>'materno','class'=>'form-control autocomplete-suggestion','placeholder'=>'Apellido Materno'])!!}
                    <div class="text-danger" id="error_materno"></div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('nombre','Nombres:',['class' => 'control-label'])!!}                    
                    {!! Form::text('nombres',null,['id'=>'nombres','class'=>'form-control autocomplete-suggestion','placeholder'=>'Nombre completo'])!!}
                    <div class="text-danger" id="error_nombres"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('codigo','D.N.I.:',['class' => 'control-label'])!!}                    
                    {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° D.N.I.','maxlength'=>8])!!}
                    <div class="text-danger" id="error_dni"></div>
                </div>
                <div class="col-md-3 ">
                    {!! Form::label('comite','Comite Local:',['class' => 'control-label'])!!}                                        
                    {!! Form::select('comite',$comite,null,['id'=>'comite','placeholder'=>'selecciona']) !!}
                    <div class="text-danger" id="error_comite"></div>
                </div>
            </div>
            <div class="col-md-12" id="sisocio">
                <div class="col-md-6 ">
                    {!! Form::label('socio','Socio:',['class' => 'control-label'])!!}                    
                    {!! Form::text('socio',null,['id'=>'socio','class'=>'form-control autocomplete-suggestion','placeholder'=>'Apellido y Nombre del Socio'])!!}
                    <div class="text-danger" id="error_socio"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('codigo','Codigo Socio:',['class' => 'control-label'])!!}                    
                    {!! Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'Codigo Socio'])!!}
                    <div class="text-danger" id="error_codigo"></div>
                </div>
                <div class="col-md-4 ">
                    {!! Form::label('comite','Comite Local:',['class' => 'control-label'])!!}                    
                    {!! Form::text('local',null,['id'=>'local','class'=>'form-control','placeholder'=>'Comite Local','disabled'])!!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-5">
                    {!! Form::label('condicio','Condicio:',['class' => 'control-label'])!!}                    
                    {!! Form::select('condicion',$condicions,null,['id'=>'condicion','class'=>'form-control','placeholder'=>'Seleccione una Condicion'])!!}
                    <div class="text-danger" id="error_condicion"></div>
                </div>
                <div class="col-md-2 ">
                    {!! Form::label('kg','Kilos:',['class' => 'control-label'])!!}                    
                    {!! Form::text('kilos',null,['id'=>'kilos','class'=>'form-control','placeholder'=>'0 Kg'])!!}
                    <div class="text-danger" id="error_kilos"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('precio','precio:',['class' => 'control-label'])!!}                    
                    {!! Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'S/. 0.00'])!!}
                    <div class="text-danger" id="error_precio"></div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('total','Total a Pagar:',['class' => 'control-label'])!!}                    
                    {!! Form::text('total',null,['id'=>'total','class'=>'form-control','placeholder'=>'S/. 0.00','disabled','style'=>"text-align: center"])!!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    {!! Form::label('observacion','Observaciones:',['class' => 'control-label'])!!}                    
                    {!! Form::textarea('observacion',null,['id'=>'observacion','class'=>'form-control','placeholder'=>'Descripcion','rows'=>'2'])!!}
                </div>
                <div class="col-md-2 ">
                    {!! Form::label('tipo','Tipo de CACAO:',['class' => 'control-label'])!!}
                    <label class="radio col-md-offset-1">
                        <input type="radio" name="tipo" value="GRADO I" id="tipo" checked="true"> GRADO I
                    </label>   
                    <label class="radio col-md-offset-1">
                        <input type="radio" name="tipo" value="GRADO II" id="tipo">GRADO II
                    </label>
                </div>
                <div class="col-md-3">
                    {!! Form::label('fecha','Fecha de Compra:',['class' => 'control-label'])!!}                    
                    {!! Form::date('fecha',date('m/d/Y'),['id'=>'fecha','class'=>'form-control'])!!}
                    <div class="text-danger" id="error_fecha"></div>
                </div>                             
            </div>
            <div class="modal-footer">
            <div class="col-md-12">
             {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCompras', 'class'=>'btn btn-dropbox'])!!}
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          </div>
        </div>
            {!! Form::close() !!}
        </div>          
      </div>
    </div>
  </div>
