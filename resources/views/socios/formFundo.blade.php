<div class="modal fade" id="fundomodal" role="dialog">
    <div class="modal-dialog modal-primary modal-lg">    
        Modal content
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center> <h3 id="titulof" class="modal-title"></h3></center>
            </div>
            <div class="modal-body">
                <div id="msj-infofundo" class="alert alert-success" role='alert' style="display: none">
                    <strong id='succesfundo'></strong>
                </div> 
                {!! Form::open(['id'=>'formfundo']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="codigo_socios" name="codigo_socios">
                <input type="hidden" id="idfundo" name="idfundo">
                <div class="col-md-12 col-md-offset-0 row" >
                    <div class="form-group col-sm-4">
                        {!! Form::label('fundo','Fundo ',['class'=>'form-label']) !!}                        
                        {!! Form::text('fundo',null,['id'=>'fundo','class'=>'form-control','placeholder'=>'Nombre del Fundo'])!!}
                        <div class="text-danger" id="error_fundo"></div>
                    </div> 
                    <div class="form-group col-sm-3">
                        {!! Form::label('estado','Estado: ',['class'=>'control-label']) !!}                        
                        {!! Form::select('estadofundo',['PROPIETARIO'=>'Propietario','POSESIONARIO'=>'Posesionario','OTROS'=>'Otros'],null,['id'=>'estadofundo','class' =>'form-control','placeholder'=>'Seleccione']) !!}
                        <div class="text-danger" id="error_estadofundo"></div>
                    </div>
                    <div class="form-group col-sm-2">                                
                        {!! Form::label('fecnaci','Fecha Nacimiento',['class'=>'control-label']) !!}
                        {!! Form::text('fecha',null,['id'=>'fecha','class'=>'form-control datepicker','placeholder'=>'mm/dd/yyyy']) !!} 
                        <div class="text-danger" id="error_fecha"></div>
                    </div>                                    
                    <div class="form-group col-sm-3">
                        {!! Form::label('departamento','Departamento',['class'=>'control-label']) !!}
                        {!! Form::select('departamento',$departamentos,null,['id'=>'departamentof','class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-0 row" >
                    <div class="form-group col-sm-3">
                        {!! Form::label('Provincia','Provincia',['class'=>'control-label']) !!}
                        {!! Form::select ('provincia',['placeholder'=>'selecciona'],null,['id'=>'provinciaf','class'=>'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-3">
                        {!! Form::label('distrito','Distrito',['class'=>'control-label']) !!}
                        {!! Form::select ('distrito',['placeholder'=>'selecciona'],null,['id'=>'distritof','class'=>'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-3">
                        {!! Form::label('Comite ','Comite Central',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_central',['placeholder'=>'selecciona'],null,['id'=>'comite_centralf','class'=>'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-3">
                        {!! Form::label('local','Comite Local',['class'=>'control-label']) !!}
                        {!! Form::select ('comite_local_id',['placeholder'=>'selecciona'],null,['id'=>'comite_local_id','class'=>'form-control']) !!}
                        <div class="text-danger" id="error_comite_local_id"></div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class=" form-group col-sm-6">
                        {!! Form::label('direccion','Direccion',['class'=>'form-label']) !!}
                        {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion de la vivienda'])!!}
                        <div class="text-danger" id="error_direccionf"></div>
                    </div>
                    <div class=" form-group col-sm-5">
                        {!! Form::label('observacion','Observacion',['class'=>'form-label']) !!}
                        {!! Form::textarea('observacion',null,['id'=>'observaciones','placeholder'=>'Observaciones del Fundo','rows'=>'2'])!!}
                    </div>
                </div>                                    
                <div class="col-md-12 col-md-offset-0 row" >
                    <div class="col-sm-4">
                        {!! Form::label('cultivos','CULTIVOS',['class'=>'form-label']) !!}
                        {!! Form::select('flora',$floras,null,['id'=>'flora','class'=>'form-control','multiple']) !!}
                    </div>
                    <div class="col-sm-8">
                        
                        <table id="tablacultivos" class="table table-responsive">
                        <thead>
                            <th>CULTIVOS</th>
                            <th>HECTAREAS</th>
                            <th>RENDIMIENTO/AÑO</th>
                        </thead>
                        <tbody>                            
                        </tbody>
                        </table>
                        <div class="text-danger" id="error_cultivos"></div>
                    </div>                    
                </div>
                <div class="col-md-12 col-md-offset-0 row" >
                    <div class="col-md-4">
                        {!! Form::label('crianzas','CRIANZAS',['class'=>'form-label']) !!}
                        {!! Form::select('fauna',$faunas,null,['id'=>'fauna','class'=>'form-control','multiple']) !!}
                    </div>  
                    <div class="col-sm-8">
                        <table id="tablafauna" class="table table-responsive">
                        <thead>
                            <th>CRIANZAS</th>
                            <th>CANTIDAD</th>
                            <th>RENDIMIENTO/AÑO</th>
                        </thead>
                        <tbody>                            
                        </tbody>
                    </table>
                        <div class="text-danger" id="error_crianzas"></div>
                    </div>
                </div>
                
                <div class="col-md-12 col-md-offset-0 row" >
                    <div class="col-md-4">
                        {!! Form::label('inmuebles','INMUEBLES',['class'=>'form-label']) !!}
                        {!! Form::select('inmueble',$inmuebles,null,['id'=>'inmueble','class'=>'form-control','multiple']) !!}
                    </div> 
                    <div class="col-sm-8">
                        <table id="tablainmueble" class="table table-responsive">
                        <thead>
                            <th>INMUEBLES</th>
                            <th>TENENCIA</th>                            
                        </thead>
                        <tbody>                            
                        </tbody>
                    </table>
                        <div class="text-danger" id="error_inmuebles"></div>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="modal-footer">                    
                    {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegFundo', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                </div>
            </div>        
        </div>

    </div>
</div>





