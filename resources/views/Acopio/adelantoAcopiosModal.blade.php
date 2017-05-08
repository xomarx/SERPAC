<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">
        <div class="modal-content" id="error-modal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">ADELANTOS DE ACOPIO</h4></center>
        </div>
        <div class="modal-body form-group-sm">
            {!! Form::open(['id'=>'formcompras']) !!}
            @include('mensajes.mensaje')
            <input type="hidden" id="id">            
                <div class="col-md-8">
                    {!! Form::label('Almacen','Almacen:',['class' => 'control-label'])!!}
                    {!! Form::text('datos',null,['id'=>'datos','class'=>'form-control','placeholder'=>'Centro de Acopio','disabled'])!!}                    
                </div>    
                <div class="col-md-4">
                    {!! Form::label('fecha','Fecha de Compra:',['class' => 'control-label'])!!}                    
                    {!! Form::date('fecha',date('m/d/Y'),['id'=>'fecha','class'=>'form-control'])!!}
                    <div class="text-danger" id="error_fecha"></div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('DNI','DNI:',['class' => 'control-label'])!!}                    
                    {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'Codigo Almacen','autofocus'])!!}
                    <div class="text-danger" id="error_acopio"></div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('datos','Apellidos y Nombres:',['class' => 'control-label'])!!}
                    {!! Form::text('datos',null,['id'=>'datos','class'=>'form-control','placeholder'=>'Centro de Acopio','disabled'])!!}                    
                </div>
                <div class="col-md-3">
                    {!! Form::label('monto','Monto:',['class' => 'control-label'])!!}                    
                    {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'Codigo Almacen','autofocus'])!!}
                    <div class="text-danger" id="error_acopio"></div>
                </div>
            <div class="col-md-12" style="padding-bottom: 10px;">
                    {!! Form::label('concepto','Concepto:',['class' => 'control-label'])!!}                    
                    {!! Form::text('concepto',null,['id'=>'concepto','class'=>'form-control','placeholder'=>'Codigo Almacen','autofocus'])!!}
                    <div class="text-danger" id="error_acopio"></div>
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


