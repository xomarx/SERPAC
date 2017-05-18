<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">    
      <!-- Modal content-->
      <div class="modal-content" id="error-modal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ALMACEN DE ACOPIO</h4>
        </div>
          <div class="modal-body col-md-12 form-group">
              @include('mensajes.mensaje')
              {!! Form::open(['id'=>'formsucursal']) !!}
              
              <div class="col-md-12">
              <div class="col-md-6 " >
                  {!! Form::label('area','Area:',['class' => 'control-label'])!!}      
                  {!! Form::select('area',$areas,null,['id'=>'area','class'=>'form-control','placeholder'=>'Seleccione']) !!} 
                  <div class="text-danger" id="error_area"></div>
              </div>
              <div class="col-md-3 ">
                  {!! Form::label('telefono','Telefono:',['class' => 'control-label'])!!} 
                {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Telefono','maxlength'=>'9'])!!}
                <div class="text-danger" id="error_telefono"></div>
              </div>
              <div class="col-md-3 ">
                  {!! Form::label('fax','Fax:',['class' => 'control-label '])!!} 
                {!! Form::text('fax',null,['id'=>'fax','class'=>'form-control','placeholder'=>'N° Fax','maxlength'=>'9'])!!}
                <div class="text-danger" id="error_fax"></div>
              </div>
              </div>
              <div class="col-md-12">
              <div class="col-md-3 ">
                  {!! Form::label('codigo','Codigo:',['class' => 'control-label'])!!} 
                {!! Form::text('codigoId',null,['id'=>'codigoId','class'=>'form-control','placeholder'=>'Codigo','maxlength'=>'9'])!!}
                <div class="text-danger" id="error_codigoId"></div>
              </div>
              <div class="col-md-5">
                  {!! Form::label('sucursal','Sucursal:',['class' => 'control-label'])!!} 
                {!! Form::text('sucursal',null,['id'=>'sucursal','class'=>'form-control','placeholder'=>'Nombre del Centro de Acopio'])!!}
                <div class="text-danger" id="error_sucursal"></div>
              </div>              
              <div class="col-sm-4">
                    {!! Form::label('departamento','Departamento:',['class' => 'control-label '])!!} 
                    {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','class'=>'form-control','placeholder'=>'Seleccione','onchange'=>'department(event)']) !!}
                    <div class="text-danger" id="error_departamento"></div>
                </div>
              </div>
              <div class="col-md-12">
              <div class="col-sm-4">
                  {!! Form::label('provincia','Provincia:',['class' => 'control-label'])!!} 
                  {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provincia','class'=>'form-control','onchange'=>'province()']) !!}
                  <div class="text-danger" id="error_provincia"></div>
              </div>              
                   <div class="col-sm-4">
                  {!! Form::label('distrito','Distrito: ',['class'=>'control-label']) !!}
                  {!! Form::select ('distrito',['placeholder'=>'selecciona'],null,['id'=>'distrito','class'=>'form-control','onchange'=>'district()']) !!}
                  <div class="text-danger" id="error_distrito"></div>
              </div>
              <div class="col-sm-4">  
                  {!! Form::label('central','Comite Central: ',['class'=>'control-label']) !!}
                  {!! Form::select ('comite_central',['placeholder'=>'selecciona'],null,['id'=>'comite_central','class'=>'form-control','onchange'=>'central_committe()']) !!}
                  <div class="text-danger" id="error_central"></div>
              </div>  
              </div>
              <div class="col-md-12">
              <div class="col-sm-4">
                  {!! Form::label('local','Comite Local: ',['class'=>'control-label ']) !!}
                  {!! Form::select ('comite_local',['placeholder'=>'selecciona'],null,['id'=>'comite_local','class'=>'form-control']) !!}
                  <div class="text-danger" id="error_local"></div>
              </div>     
              <div class="col-md-8">
                  {!! Form::label('direccion','Direccion:',['class' => 'control-label'])!!} 
                {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion '])!!}
                <div class="text-danger" id="error_direccion"></div>
              </div>
              </div>
              
              <div class="col-md-12">
                  <div class="col-sm-11">
                      {!! Form::label('acopiador','Acopiador:',['class' => 'control-label'])!!} 
                      {!! Form::select('acopiador',$empleados,null,['id'=>'acopiador','class'=>'select2','placeholder'=>'Seleccione un Acopiador !','style'=>'width:96%']) !!}
                      <a onclick="activarmodal(11)" class="btn-primary" data-taggle="tooltip" title="Nuevo Acopiador"><i class="glyphicon glyphicon-plus"></i></a>                                            
                      <div class="text-danger" id="error_acopiador"></div>
                  </div> 
                 
              </div>
              {!! Form::close() !!}
          </div>
            <div class="modal-footer">            
            <a class="btn btn-dropbox" id="RegAlmacen">Registrar</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>
      </div>
      
    </div>
  </div>